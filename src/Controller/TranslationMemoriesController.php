<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * TranslationMemories Controller
 *
 * @property \App\Model\Table\TranslationMemoriesTable $TranslationMemories
 */
class TranslationMemoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'SourceLanguage', 'TargetLanguage', 'TmTypes']
        ];
        $translationMemories = $this->paginate($this->TranslationMemories);
        
        $unitsTable = TableRegistry::get('Units');
        $query = $unitsTable->find();
        $countsRaw = $query->select(['translation_memory_id', 'unit_count'=>$query->func()->count('id')])->group('translation_memory_id');
        $unitCounts = array();
        foreach ($countsRaw as $count) {
			$unitCounts[$count->translation_memory_id] = $count->unit_count;
        }
        $this->set(compact('translationMemories'));
        $this->set(compact('unitCounts'));
        $this->set('_serialize', ['translationMemories']);
    }

    /**
     * View method
     *
     * @param string|null $id Translation Memory id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id);
        $unitsTable = TableRegistry::get('Units');
        $units = $this->paginate($unitsTable->find('all')->where(['Units.translation_memory_id' => $id]));

        $this->set(compact('translationMemory', 'units'));
        $this->set('_serialize', ['translationMemory, units']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $translationMemory = $this->TranslationMemories->newEntity();
        if ($this->request->is('post')) {
            $translationMemory = $this->TranslationMemories->patchEntity($translationMemory, $this->request->data);
            if ($this->TranslationMemories->save($translationMemory)) {
                $this->Flash->success(__('The translation memory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The translation memory could not be saved. Please, try again.'));
            }
        }
        $users = $this->TranslationMemories->Users->find('list', ['limit' => 200]);
        $languages = $this->TranslationMemories->Languages->find('list', ['limit' => 200]);
        $tmTypes = $this->TranslationMemories->TmTypes->find('list', ['limit' => 200]);
        $this->set(compact('translationMemory', 'users', 'languages', 'tmTypes'));
        $this->set('_serialize', ['translationMemory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Translation Memory id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $translationMemory = $this->TranslationMemories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $translationMemory = $this->TranslationMemories->patchEntity($translationMemory, $this->request->data);
            if ($this->TranslationMemories->save($translationMemory)) {
                $this->Flash->success(__('The translation memory has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The translation memory could not be saved. Please, try again.'));
            }
        }
        $users = $this->TranslationMemories->Users->find('list', ['limit' => 200]);
        $languages = $this->TranslationMemories->Languages->find('list', ['limit' => 200]);
        $tmTypes = $this->TranslationMemories->TmTypes->find('list', ['limit' => 200]);
        $this->set(compact('translationMemory', 'users', 'languages', 'tmTypes'));
        $this->set('_serialize', ['translationMemory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Translation Memory id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $translationMemory = $this->TranslationMemories->get($id);
        if ($this->TranslationMemories->delete($translationMemory)) {
            $this->Flash->success(__('The translation memory has been deleted.'));
        } else {
            $this->Flash->error(__('The translation memory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
