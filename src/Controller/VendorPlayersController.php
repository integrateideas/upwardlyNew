<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VendorPlayers Controller
 *
 * @property \App\Model\Table\VendorPlayersTable $VendorPlayers
 *
 * @method \App\Model\Entity\VendorPlayer[] paginate($object = null, array $settings = [])
 */
class VendorPlayersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Players', 'Vendors', 'VendorLevels']
        ];
        $vendorPlayers = $this->paginate($this->VendorPlayers);

        $this->set(compact('vendorPlayers'));
        $this->set('_serialize', ['vendorPlayers']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Player id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorPlayer = $this->VendorPlayers->get($id, [
            'contain' => ['Players', 'Vendors'/*, 'VendorPlayerActivities', 'VendorPlayerBadgeActivities', 'VendorPlayerBadges'*/,'VendorLevels', 'VendorPlayerBadges.VendorBadges']
        ]);
        // pr($vendorPlayer);die();
        $this->set('vendorPlayer', $vendorPlayer);
        $this->set('_serialize', ['vendorPlayer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vendorPlayer = $this->VendorPlayers->newEntity();
        if ($this->request->is('post')) {
            $vendorPlayer = $this->VendorPlayers->patchEntity($vendorPlayer, $this->request->getData());
            if ($this->VendorPlayers->save($vendorPlayer)) {
                $this->Flash->success(__('The vendor player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor player could not be saved. Please, try again.'));
        }
        $players = $this->VendorPlayers->Players->find('list', ['limit' => 200]);
        $vendors = $this->VendorPlayers->Vendors->find('list', ['limit' => 200]);
        $vendorLevels = $this->VendorPlayers->VendorLevels->find('list', ['limit' => 200]);
        $this->set(compact('vendorPlayer', 'players', 'vendors', 'vendorLevels'));
        $this->set('_serialize', ['vendorPlayer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Player id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vendorPlayer = $this->VendorPlayers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendorPlayer = $this->VendorPlayers->patchEntity($vendorPlayer, $this->request->getData());
            if ($this->VendorPlayers->save($vendorPlayer)) {
                $this->Flash->success(__('The vendor player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vendor player could not be saved. Please, try again.'));
        }
        $players = $this->VendorPlayers->Players->find('list', ['limit' => 200]);
        $vendors = $this->VendorPlayers->Vendors->find('list', ['limit' => 200]);
        $vendorLevels = $this->VendorPlayers->VendorLevels->find('list', ['limit' => 200]);
        $this->set(compact('vendorPlayer', 'players', 'vendors', 'vendorLevels'));
        $this->set('_serialize', ['vendorPlayer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorPlayer = $this->VendorPlayers->get($id);
        if ($this->VendorPlayers->delete($vendorPlayer)) {
            $this->Flash->success(__('The vendor player has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor player could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
