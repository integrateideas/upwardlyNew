<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VendorActions Controller
 *
 * @property \App\Model\Table\VendorActionsTable $VendorActions
 *
 * @method \App\Model\Entity\VendorAction[] paginate($object = null, array $settings = [])
 */
class VendorActionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Actions', 'Vendors']
        ];
        $vendorActions = $this->paginate($this->VendorActions);

        $this->set(compact('vendorActions'));
        $this->set('_serialize', ['vendorActions']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Action id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorAction = $this->VendorActions->get($id, [
            'contain' => ['Actions', 'Vendors', 'VendorBadgeActions', 'VendorPlayerActionCounts', 'VendorPlayerActivities', 'VendorPlayerBadgeActivities']
        ]);

        $this->set('vendorAction', $vendorAction);
        $this->set('_serialize', ['vendorAction']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loggedInUser = $this->Auth->user();
        $vendorAction = $this->VendorActions->newEntity();
        if ($this->request->is('post')) {

            $this->request->data['custom_action_name'] = $this->request->data;
            $labelName = strtolower(str_replace(' ', '_', $this->request->data['label']));
            $this->request->data['custom_action_name'] = $labelName;

            $vendorAction = $this->VendorActions->patchEntity($vendorAction, $this->request->data);
            
            if ($this->VendorActions->save($vendorAction)) {
                $this->Flash->success(__('The vendor action has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vendor action could not be saved. Please, try again.'));
            }
        }
        $actions = $this->VendorActions->Actions->find('list', ['limit' => 200]);
        $vendors = $this->VendorActions->Vendors->find('list', ['limit' => 200]);
        $this->set(compact('vendorAction', 'actions', 'vendors'));
        $this->set('_serialize', ['vendorAction']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Action id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loggedInUser = $this->Auth->user();
        $vendorAction = $this->VendorActions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->request->data['custom_action_name'] = $this->request->data;
            $labelName = strtolower(str_replace(' ', '_', $this->request->data['label']));
            $this->request->data['custom_action_name'] = $labelName;

            $vendorAction = $this->VendorActions->patchEntity($vendorAction, $this->request->data);
            //pr($vendorAction); die('ss');
            if ($this->VendorActions->save($vendorAction)) {
                $this->Flash->success(__('The vendor action has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vendor action could not be saved. Please, try again.'));
            }
        }
        $actions = $this->VendorActions->Actions->find('list', ['limit' => 200]);
        $vendors = $this->VendorActions->Vendors->find('list', ['limit' => 200]);
        $this->set(compact('vendorAction', 'actions', 'vendors'));
        $this->set('_serialize', ['vendorAction']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Action id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorAction = $this->VendorActions->get($id);
        if ($this->VendorActions->delete($vendorAction)) {
            $this->Flash->success(__('The vendor action has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor action could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
