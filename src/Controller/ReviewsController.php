<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;


/**
 * Reviews Controller
 *
 * @property \App\Model\Table\ReviewsTable $Reviews
 */
class ReviewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $conn = ConnectionManager::get('default');
        $reviewsData = $conn->execute('select count(reviews.id) as reviews_count, sum(reviews.units_checked) as units_checked from users inner join reviews on users.id = reviews.user_id and users.id = '.$this->Auth->user()['id'].' group by users.id')->fetchAll('assoc');

        if (count($reviewsData) > 0) {
            $reviewsCount = $reviewsData[0]['reviews_count'];
            $unitsChecked = $reviewsData[0]['units_checked'];
        } else {
            $reviewsCount = 0;
            $unitsChecked = 0;
        }
        $reviewPoints = 10*$unitsChecked;

        $this->set(compact('reviewsCount', 'unitsChecked', 'reviewPoints'));

    }

    public function add()
    {
        if ($this->request->is('post')) {
            $ids = $this->request->data['ids'];
            $decisions = $this->request->data['decisions'];

            $unitsTable = TableRegistry::get('Units');

            if (count($ids) != count($decisions)) {
                $this->Flash->error(__('Error submitting review.'));
            } else {
                for($i=0; $i<count($ids); $i++) {
                    $unitId = $ids[$i];
                    $decision = ($decisions[$i] == "1");

                    $unit = $unitsTable->get($unitId);
                    $unit->reviewer_id = $this->Auth->user()['id'];
                    $unit->review = $decision;

                    $unitsTable->save($unit);
                }
                $review = $this->Reviews->newEntity();
                $review->user_id = $this->Auth->user()['id'];
                $review->units_checked = count($ids);
                $this->Reviews->save($review);
            }
            $this->Flash->success(__('Review successfully submitted.'));
            return $this->redirect(['action' => 'index']);

        } else {
            $conn = ConnectionManager::get('default');
            $units = $conn->execute('select * from translation_memories inner join units on translation_memories.id = units.translation_memory_id and units.review is null and translation_memories.tm_type_id != 5 order by rand() limit 50');

            $this->set(compact('units'));
            $this->set('_serialize', ['units']);

        }


    }

}
