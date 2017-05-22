<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;
use App\Exporter\ExporterFactory;
use App\Importer\ImporterFactory;
use Cake\Datasource\ConnectionManager;

/**
 * TranslationMemories Controller.
 *
 * @property \App\Model\Table\TranslationMemoriesTable $TranslationMemories
 */
class TranslationMemoriesController extends AppController
{
    private function _restrictAccess($translationMemory)
    {
        if ($this->Auth->user()['role_id'] != 1 && $this->Auth->user()['id'] != $translationMemory->user_id) {
            $this->redirect('/');
        }
    }

    /**
     * Index method.
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'SourceLanguage', 'TargetLanguage', 'TmTypes', 'Domains'],
        ];
        $translationMemories = $this->paginate($this->TranslationMemories->find('all')->where(['TranslationMemories.user_id' => $this->Auth->user()['id']]));

        $unitsTable = TableRegistry::get('Units');
        $query = $unitsTable->find();
        $countsRaw = $query->select(['translation_memory_id', 'unit_count' => $query->func()->count('id')])->group('translation_memory_id');
        $unitCounts = array();
        foreach ($countsRaw as $count) {
            $unitCounts[$count->translation_memory_id] = $count->unit_count;
        }
        $this->set(compact('translationMemories'));
        $this->set(compact('unitCounts'));
        $this->set('_serialize', ['translationMemories']);
    }

    private static function compare_users($user1, $user2)
    {
        return ($user2['unit_count']+$user2['review_points']) - ($user1['unit_count']+$user1['review_points']);
    }


    public function ranking()
    {
        $conn = ConnectionManager::get('default');
        $ranking = $conn->execute('select users.id, users.username, group_concat(distinct translation_memories.title separator \', \') as titles, count(units.id) as unit_count from users inner join translation_memories on users.id = translation_memories.user_id and translation_memories.tm_type_id != 5 inner join units on translation_memories.id = units.translation_memory_id group by users.id;')->fetchAll('assoc');

        $reviewPointsArray = $conn->execute('select users.id, sum(reviews.units_checked) as units_checked from users inner join reviews on users.id = reviews.user_id group by users.id')->fetchAll('assoc');

        $reviewPoints = array();
        foreach($reviewPointsArray as $row) {
            $reviewPoints[$row['id']] = $row['units_checked'];
        }

        for($i = 0;$i<count($ranking);$i++) {

            if (array_key_exists($ranking[$i]['id'],$reviewPoints)) {
                $ranking[$i]['review_points'] = 10*$reviewPoints[$ranking[$i]['id']];
            } else {
                $ranking[$i]['review_points'] = 0;
            }
        }
        usort($ranking, 'self::compare_users');

        $this->set('ranking', $ranking);
    }

    public function adminindex()
    {
        if ($this->Auth->user()['role_id'] != 1)
        {
            $this->redirect('/');
        }
        $this->paginate = [
            'contain' => ['Users', 'SourceLanguage', 'TargetLanguage', 'TmTypes', 'Domains'],
        ];
        $translationMemories = $this->paginate($this->TranslationMemories->find('all'));

        $unitsTable = TableRegistry::get('Units');
        $query = $unitsTable->find();
        $totalCount = $query->count();
        $countsRaw = $query->select(['translation_memory_id', 'unit_count' => $query->func()->count('id')])->group('translation_memory_id');
        $unitCounts = array();
        foreach ($countsRaw as $count) {
            $unitCounts[$count->translation_memory_id] = $count->unit_count;
        }

        $this->set(compact('translationMemories','unitCounts', 'totalCount'));
        $this->set('_serialize', ['translationMemories']);
    }


    /**
     * View method.
     *
     * @param string|null $id Translation Memory id
     *
     * @return \Cake\Network\Response|null
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found
     */
    public function view($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id);
        $this->_restrictAccess($translationMemory);
        $unitsTable = TableRegistry::get('Units');
        $units = $this->paginate($unitsTable->find('all')->where(['Units.translation_memory_id' => $id]));

        $conn = ConnectionManager::get('default');
        $quality = $conn->execute('select count(*) as review_count, sum(review) as accepted_count from units where translation_memory_id = '.$id.' and review is not null')->fetchAll('assoc');
        $reviewCount = $quality[0]['review_count'];
        $acceptedCount = $quality[0]['accepted_count'];

        $this->set(compact('translationMemory', 'units', 'reviewCount', 'acceptedCount'));
        $this->set('_serialize', ['translationMemory, units']);
    }

    public function massexport()
    {
        if ($this->Auth->user()['role_id'] != 1)
        {
            $this->redirect('/');
        }

        $languagesList = $this->TranslationMemories->SourceLanguage->find('list', ['keyField' => 'id', 'valueField' => 'code'])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $exporter = ExporterFactory::createForFormat($this->request->data['export_format']);

            $exporter->init('exported_tm', $languagesList[$this->request->data['source_language_id']], $languagesList[$this->request->data['target_language_id']]);

            $tms = $this->TranslationMemories->find('all')->where(
                function ($exp, $q) {
                    return $exp->in('tm_type_id', $this->request->data['tm_types']);
                }
            )->where(
                function ($exp, $q) {
                    return $exp->in('domain_id', $this->request->data['domains']);
                }
            )->where([
                'source_language_id' => $this->request->data['source_language_id'],
                'target_language_id' => $this->request->data['target_language_id']
            ]);

            if ($this->request->data['reversed'])
            {
                $tms = $tms->orWhere([
                    'source_language_id' => $this->request->data['target_language_id'],
                    'target_language_id' => $this->request->data['source_language_id']
                ]);
            }

            foreach($tms as $tm)
            {
                $exporter->writeTm($tm->id, $tm->source_language_id != $this->request->data['source_language_id']);
            }

            $exporter->close();

            $this->response->file(
                $exporter->getExportedFilePath(),
                ['download' => true]
            );

            return $this->response;
        }
        $languages = $this->TranslationMemories->SourceLanguage->find('list');
        $tmTypes = $this->TranslationMemories->TmTypes->find('list', ['limit' => 200]);
        $domains = $this->TranslationMemories->Domains->find('list', ['limit' => 200]);
        $this->set(compact('languages', 'tmTypes', 'domains'));
        $this->set('_serialize', ['languages', 'tmTypes', 'domains']);

    }


    public function export($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id, [
            'contain' => ['SourceLanguage', 'TargetLanguage', 'TmTypes'],
        ]);
        $this->_restrictAccess($translationMemory);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $exporter = ExporterFactory::createForFormat($this->request->data['export_format']);
            $exporter->init('tm_'.$translationMemory->id, $translationMemory->source_language->code, $translationMemory->target_language->code);
            $exporter->writeTm($translationMemory->id);
            $exporter->close();

            $this->response->file(
                $exporter->getExportedFilePath(),
                ['download' => true]
            );

            return $this->response;
        }
        $this->set(compact('translationMemory'));
        $this->set('_serialize', ['translationMemory']);
    }

    private function _lineCount($file_name)
    {
        $linecount = 0;
        $handle = fopen($file_name, 'r');
        while (!feof($handle)) {
            $line = fgets($handle);
            ++$linecount;
        }

        fclose($handle);

        return $linecount;
    }

    /**
     * Add method.
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise
     */
    public function add()
    {
        $translationMemory = $this->TranslationMemories->newEntity();
        if ($this->request->is('post')) {
            $translationMemory = $this->TranslationMemories->patchEntity($translationMemory, $this->request->data);
            $translationMemory->user_id = $this->Auth->user()['id'];
            if ($this->TranslationMemories->save($translationMemory)) {
				try {
					$importer = ImporterFactory::createForFormat($this->request->data['import_format']);
					$importer->importUnits($translationMemory,
                                           $_FILES['source_file']['tmp_name'],
                                           $this->request->data['source_language_id'],
                                           $_FILES['target_file']['tmp_name'],
                                           $this->request->data['target_language_id']);
					$this->Flash->success(__('The translation memory has been uploaded.'));
		            return $this->redirect(['action' => 'view', $translationMemory->id]);
				} catch (Exception $e) {
					$this->Flash->error('The following error occured: "'.$e->getMessage().'". Please try again.');
                    $this->TranslationMemories->delete($translationMemory);
                    return $this->redirect(['action' => 'add']);
				}

            } else {
                $this->Flash->error(__('The translation memory could not be uploaded. Please try again.'));
                $this->TranslationMemories->delete($translationMemory);
                return $this->redirect(['action' => 'add']);
            }
        }
        $languages = $this->TranslationMemories->SourceLanguage->find('list', ['limit' => 200]);
        $tmTypes = $this->TranslationMemories->TmTypes->find('list', ['limit' => 200]);
        $domains = $this->TranslationMemories->Domains->find('list', ['limit' => 200]);
        $this->set(compact('translationMemory', 'languages', 'tmTypes', 'domains'));
        $this->set('_serialize', ['translationMemory']);
    }

    /**
     * Edit method.
     *
     * @param string|null $id Translation Memory id
     *
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise
     *
     * @throws \Cake\Network\Exception\NotFoundException When record not found
     */
    public function edit($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id, [
            'contain' => ['SourceLanguage', 'TargetLanguage', 'TmTypes', 'Domains'],
        ]);
        $this->_restrictAccess($translationMemory);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $translationMemory = $this->TranslationMemories->patchEntity($translationMemory, $this->request->data);
            if ($this->TranslationMemories->save($translationMemory)) {
                $this->Flash->success(__('The translation memory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The translation memory could not be saved. Please, try again.'));
            }
        }
        $languages = $this->TranslationMemories->SourceLanguage->find('list', ['limit' => 200]);
        $tmTypes = $this->TranslationMemories->TmTypes->find('list', ['limit' => 200]);
        $domains = $this->TranslationMemories->Domains->find('list', ['limit' => 200]);
        $this->set(compact('translationMemory', 'languages', 'tmTypes', 'domains'));
        $this->set('_serialize', ['translationMemory']);
    }


    public function expand($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id);
        $this->_restrictAccess($translationMemory);
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                $importer = ImporterFactory::createForFormat($this->request->data['import_format']);
                $importer->importUnits($translationMemory,
                                       $_FILES['source_file']['tmp_name'],
                                       $this->request->data['source_language_id'],
                                       $_FILES['target_file']['tmp_name'],
                                       $this->request->data['target_language_id']);
                $this->Flash->success(__('The translation memory has been expanded.'));
                return $this->redirect(['action' => 'view', $translationMemory->id]);
            } catch (Exception $e) {
                $this->Flash->error('The following error occured: "'.$e->getMessage().'". Please try again.');
                return $this->redirect(['action' => 'expand', $translationMemory->id]);
            }

        }
        $this->set(compact('translationMemory'));
        $this->set('_serialize', ['translationMemory']);
    }

    /**
     * Delete method.
     *
     * @param string|null $id Translation Memory id
     *
     * @return \Cake\Network\Response|null Redirects to index
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $translationMemory = $this->TranslationMemories->get($id);
        $this->_restrictAccess($translationMemory);
        if ($this->TranslationMemories->delete($translationMemory)) {
            $this->Flash->success(__('The translation memory has been deleted.'));
        } else {
            $this->Flash->error(__('The translation memory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
