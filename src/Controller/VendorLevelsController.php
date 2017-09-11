<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VendorLevels Controller
 *
 * @property \App\Model\Table\VendorLevelsTable $VendorLevels
 *
 * @method \App\Model\Entity\VendorLevel[] paginate($object = null, array $settings = [])
 */
class VendorLevelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendors']
        ];
        $vendorLevels = $this->paginate($this->VendorLevels);

        $this->set(compact('vendorLevels'));
        $this->set('_serialize', ['vendorLevels']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Level id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorLevel = $this->VendorLevels->get($id, [
            'contain' => ['Vendors', 'VendorPlayerActivities', 'VendorPlayers']
        ]);

        $this->set('vendorLevel', $vendorLevel);
        $this->set('_serialize', ['vendorLevel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loggedInUser = $this->Auth->user();
        $lastLevel = $this->VendorLevels->findByVendorId($loggedInUser['vendor_id'])->last();
        //pr($lastLevel); die();
        if (isset($this->request->data['points'])) {
            if(!$this->request->data['points'] || ($this->request->data['points'] && $lastLevel && $this->request->data['points'] <= $lastLevel->points)){
                $this->Flash->error(__('Points should be more than '.$lastLevel->points));
                $this->redirect(['action' => 'add']);
                return;
            }
        }

        $vendorLevel = $this->VendorLevels->newEntity();
        if ($this->request->is('post')) {
            $vendorLevel = $this->VendorLevels->patchEntity($vendorLevel, $this->request->data);
            // pr($vendorLevel); die('ss');
            if ($this->VendorLevels->save($vendorLevel)) {
                $this->Flash->success(__('The Vendor Level has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The Vendor Level could not be saved. Please, try again.'));
            }
        }
        $vendors = $this->VendorLevels->Vendors->find('list', ['limit' => 200]);
        $this->set(compact('vendorLevel', 'vendors','loggedInUser','lastLevel'));
        $this->set('_serialize', ['vendorLevel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Level id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vendorLevel = $this->VendorLevels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendorLevel = $this->VendorLevels->patchEntity($vendorLevel, $this->request->getData());
            if ($this->VendorLevels->save($vendorLevel)) {
                $this->Flash->success(__('The vendor level has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor level could not be saved. Please, try again.'));
        }
        $vendors = $this->VendorLevels->Vendors->find('list', ['limit' => 200]);
        $this->set(compact('vendorLevel', 'vendors'));
        $this->set('_serialize', ['vendorLevel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Level id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorLevel = $this->VendorLevels->get($id);
        if ($this->VendorLevels->delete($vendorLevel)) {
            $this->Flash->success(__('The vendor level has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor level could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
