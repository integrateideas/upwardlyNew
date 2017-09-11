<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VendorPlayerActionCounts Controller
 *
 * @property \App\Model\Table\VendorPlayerActionCountsTable $VendorPlayerActionCounts
 *
 * @method \App\Model\Entity\VendorPlayerActionCount[] paginate($object = null, array $settings = [])
 */
class VendorPlayerActionCountsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['VendorPlayers', 'VendorActions']
        ];
        $vendorPlayerActionCounts = $this->paginate($this->VendorPlayerActionCounts);

        $this->set(compact('vendorPlayerActionCounts'));
        $this->set('_serialize', ['vendorPlayerActionCounts']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Player Action Count id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorPlayerActionCount = $this->VendorPlayerActionCounts->get($id, [
            'contain' => ['VendorPlayers', 'VendorActions']
        ]);

        $this->set('vendorPlayerActionCount', $vendorPlayerActionCount);
        $this->set('_serialize', ['vendorPlayerActionCount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vendorPlayerActionCount = $this->VendorPlayerActionCounts->newEntity();
        if ($this->request->is('post')) {
            $vendorPlayerActionCount = $this->VendorPlayerActionCounts->patchEntity($vendorPlayerActionCount, $this->request->getData());
            if ($this->VendorPlayerActionCounts->save($vendorPlayerActionCount)) {
                $this->Flash->success(__('The vendor player action count has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor player action count could not be saved. Please, try again.'));
        }
        $vendorPlayers = $this->VendorPlayerActionCounts->VendorPlayers->find('list', ['limit' => 200]);
        $vendorActions = $this->VendorPlayerActionCounts->VendorActions->find('list', ['limit' => 200]);
        $this->set(compact('vendorPlayerActionCount', 'vendorPlayers', 'vendorActions'));
        $this->set('_serialize', ['vendorPlayerActionCount']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Player Action Count id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vendorPlayerActionCount = $this->VendorPlayerActionCounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendorPlayerActionCount = $this->VendorPlayerActionCounts->patchEntity($vendorPlayerActionCount, $this->request->getData());
            if ($this->VendorPlayerActionCounts->save($vendorPlayerActionCount)) {
                $this->Flash->success(__('The vendor player action count has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor player action count could not be saved. Please, try again.'));
        }
        $vendorPlayers = $this->VendorPlayerActionCounts->VendorPlayers->find('list', ['limit' => 200]);
        $vendorActions = $this->VendorPlayerActionCounts->VendorActions->find('list', ['limit' => 200]);
        $this->set(compact('vendorPlayerActionCount', 'vendorPlayers', 'vendorActions'));
        $this->set('_serialize', ['vendorPlayerActionCount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Player Action Count id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorPlayerActionCount = $this->VendorPlayerActionCounts->get($id);
        if ($this->VendorPlayerActionCounts->delete($vendorPlayerActionCount)) {
            $this->Flash->success(__('The vendor player action count has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor player action count could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
