<?php

namespace App\Controller;

use Cake\Core\Exception\Exception;
use Cake\ORM\TableRegistry;
use App\Exporter\ExporterFactory;
use App\Importer\ImporterFactory;

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
            'contain' => ['Users', 'SourceLanguage', 'TargetLanguage', 'TmTypes'],
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

        $this->set(compact('translationMemory', 'units'));
        $this->set('_serialize', ['translationMemory, units']);
    }

    public function export($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id, [
            'contain' => ['SourceLanguage', 'TargetLanguage', 'TmTypes'],
        ]);
        $this->_restrictAccess($translationMemory);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $exporter = ExporterFactory::createForFormat($this->request->data['export_format']);
            $exporter->init($translationMemory);
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
					$importer->importUnits($translationMemory, $_FILES['source_file']['tmp_name'], $_FILES['target_file']['tmp_name']);
					$this->Flash->success(__('The translation memory has been uploaded.'));
		            return $this->redirect(['action' => 'view', $translationMemory->id]);
				} catch (Exception $e) {
					$this->Flash->error('The following error occured: "'.$e->getMessage().'". Please, try again.');
                    $this->TranslationMemories->delete($translationMemory);
                    return $this->redirect(['action' => 'add']);
				}

            } else {
                $this->Flash->error(__('The translation memory could not be uploaded. Please, try again.'));
                $this->TranslationMemories->delete($translationMemory);
                return $this->redirect(['action' => 'add']);
            }
        }
        $languages = $this->TranslationMemories->SourceLanguage->find('list', ['limit' => 200]);
        $tmTypes = $this->TranslationMemories->TmTypes->find('list', ['limit' => 200]);
        $this->set(compact('translationMemory', 'languages', 'tmTypes'));
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
            'contain' => ['SourceLanguage', 'TargetLanguage', 'TmTypes'],
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
        $this->set(compact('translationMemory', 'languages', 'tmTypes'));
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
