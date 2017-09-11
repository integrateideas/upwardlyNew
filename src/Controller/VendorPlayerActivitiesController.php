<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VendorPlayerActivities Controller
 *
 * @property \App\Model\Table\VendorPlayerActivitiesTable $VendorPlayerActivities
 *
 * @method \App\Model\Entity\VendorPlayerActivity[] paginate($object = null, array $settings = [])
 */
class VendorPlayerActivitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['VendorPlayers', 'VendorActions', 'VendorBadges', 'VendorLevels']
        ];
        $vendorPlayerActivities = $this->paginate($this->VendorPlayerActivities);

        $this->set(compact('vendorPlayerActivities'));
        $this->set('_serialize', ['vendorPlayerActivities']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Player Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorPlayerActivity = $this->VendorPlayerActivities->get($id, [
            'contain' => ['VendorPlayers', 'VendorActions', 'VendorBadges', 'VendorLevels']
        ]);

        $this->set('vendorPlayerActivity', $vendorPlayerActivity);
        $this->set('_serialize', ['vendorPlayerActivity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vendorPlayerActivity = $this->VendorPlayerActivities->newEntity();
        if ($this->request->is('post')) {
            $vendorPlayerActivity = $this->VendorPlayerActivities->patchEntity($vendorPlayerActivity, $this->request->getData());
            if ($this->VendorPlayerActivities->save($vendorPlayerActivity)) {
                $this->Flash->success(__('The vendor player activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor player activity could not be saved. Please, try again.'));
        }
        $vendorPlayers = $this->VendorPlayerActivities->VendorPlayers->find('list', ['limit' => 200]);
        $vendorActions = $this->VendorPlayerActivities->VendorActions->find('list', ['limit' => 200]);
        $vendorBadges = $this->VendorPlayerActivities->VendorBadges->find('list', ['limit' => 200]);
        $vendorLevels = $this->VendorPlayerActivities->VendorLevels->find('list', ['limit' => 200]);
        $this->set(compact('vendorPlayerActivity', 'vendorPlayers', 'vendorActions', 'vendorBadges', 'vendorLevels'));
        $this->set('_serialize', ['vendorPlayerActivity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Player Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vendorPlayerActivity = $this->VendorPlayerActivities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendorPlayerActivity = $this->VendorPlayerActivities->patchEntity($vendorPlayerActivity, $this->request->getData());
            if ($this->VendorPlayerActivities->save($vendorPlayerActivity)) {
                $this->Flash->success(__('The vendor player activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor player activity could not be saved. Please, try again.'));
        }
        $vendorPlayers = $this->VendorPlayerActivities->VendorPlayers->find('list', ['limit' => 200]);
        $vendorActions = $this->VendorPlayerActivities->VendorActions->find('list', ['limit' => 200]);
        $vendorBadges = $this->VendorPlayerActivities->VendorBadges->find('list', ['limit' => 200]);
        $vendorLevels = $this->VendorPlayerActivities->VendorLevels->find('list', ['limit' => 200]);
        $this->set(compact('vendorPlayerActivity', 'vendorPlayers', 'vendorActions', 'vendorBadges', 'vendorLevels'));
        $this->set('_serialize', ['vendorPlayerActivity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Player Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorPlayerActivity = $this->VendorPlayerActivities->get($id);
        if ($this->VendorPlayerActivities->delete($vendorPlayerActivity)) {
            $this->Flash->success(__('The vendor player activity has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor player activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
