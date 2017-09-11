<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\Core\Configure;

/**
 * VendorBadges Controller
 *
 * @property \App\Model\Table\VendorBadgesTable $VendorBadges
 *
 * @method \App\Model\Entity\VendorBadge[] paginate($object = null, array $settings = [])
 */
class VendorBadgesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $loggedInUser = $this->Auth->user();
        if($loggedInUser['role']->name == self::SUPER_ADMIN_LABEL){
            $vendorBadges = $this->VendorBadges->find()->contain(['Vendors', 'VendorBadgeActions'])->where($this->_vendorCondition)->all();
        }else{
            $vendorBadges = $this->VendorBadges->find()->contain(['Vendors', 'VendorBadgeActions'])->where(['vendor_id' => $this->Auth->user('vendor_id')])->all();
        }
        $this->set(compact('vendorBadges'));
        $this->set('_serialize', ['vendorBadges']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor Badge id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendorBadge = $this->VendorBadges->get($id, [
            'contain' => ['Vendors', 'VendorBadgeActions', 'VendorPlayerActivities', 'VendorPlayerBadges']
        ]);

        $this->set('vendorBadge', $vendorBadge);
        $this->set('_serialize', ['vendorBadge']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $loggedInUser = $this->Auth->user();
        $vendorBadge = $this->VendorBadges->newEntity();
        // pr($this->request->data);die;
        if ($this->request->is('post')) {
            $this->request->data['vendor_badge_actions']=[$this->request->data['vendor_badge_action']];
            unset($this->request->data['vendor_badge_action']);
            $vendorBadge = $this->VendorBadges->patchEntity($vendorBadge, $this->request->data, ['associated' => 'VendorBadgeActions']);
            // pr($vendorBadge); die('ss');
            if ($this->VendorBadges->save($vendorBadge, ['associated' => 'VendorBadgeActions'])) {
                $this->Flash->success(__('The vendor badge has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vendor badge could not be saved. Please, try again.'));
            }
        }

        $this->loadModel('VendorActions');
        $vendorActions = $this->VendorActions->find()
                                             ->where(['vendor_id'=>$loggedInUser['vendor_id']])
                                             ->contain(['Actions'])
                                             ->all()
                                             ->toArray();
        foreach ($vendorActions as $key => $vendorAction){

            if(!$vendorAction['custom_action_name']){

                $vendorAction['custom_action_name'] = $vendorAction['action']['name'];
            }
        }
        $vendorActions = (new Collection($vendorActions))->combine('id','custom_action_name')->toArray();
        $vendors = $this->VendorBadges->Vendors->find('list', ['limit' => 200]);
        $this->set(compact('vendorBadge', 'vendors', 'vendorActions'));
        $this->set('_serialize', ['vendorBadge']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor Badge id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $loggedInUser = $this->Auth->user();
        $vendorBadge = $this->VendorBadges->get($id, [
            'contain' => ['VendorBadgeActions']
        ]);

        $oldImageName = $vendorBadge->image_name;
        $path = Configure::read('ImageUpload.unlinkPathForVendorBadgesImages');

        // pr($vendorBadge); die();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vendorBadge = $this->VendorBadges->patchEntity($vendorBadge, $this->request->data, ['associated' => 'VendorBadgeActions']);
            // pr($vendorBadge); die();
            if ($this->VendorBadges->save($vendorBadge, ['associated' => 'VendorBadgeActions'])) {
                // pr($vendorBadge);die;
                if(empty($this->request->data['image_name']['tmp_name'])){
                    unset($this->request->data['image_name']);
                    $oldImageName ='';
                }
                if(!empty($oldImageName)){
                    $filePath = $path . '/'.$oldImageName;
                    if($filePath != '' && file_exists( $filePath ) ){
                        unlink($filePath);
                    }
                }

                $this->Flash->success(__('The vendor badge has been saved.'));
                $this->redirect(['action' => 'index']);
                return ;
            } else {
                $this->Flash->error(__('The vendor badge could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('VendorActions');
        $vendorActions = $this->VendorActions->find()
                                             ->where(['vendor_id'=>$loggedInUser['vendor_id']])
                                             ->contain(['Actions'])
                                             ->all()
                                             ->toArray();
        // pr($vendorActions);
        foreach ($vendorActions as $key => $vendorAction){

            if(!$vendorAction['custom_action_name']){

                $vendorAction['custom_action_name'] = $vendorAction['action']['name'];
            }
        }
        $vendorActions = (new Collection($vendorActions))->combine('id','custom_action_name')->toArray();
        $vendors = $this->VendorBadges->Vendors->find('list', ['limit' => 200]);
        $this->set(compact('vendorBadge', 'vendors', 'vendorActions'));
        $this->set('_serialize', ['vendorBadge']);
        $this->set('loggedInUser', $loggedInUser);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor Badge id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendorBadge = $this->VendorBadges->get($id);
        if ($this->VendorBadges->delete($vendorBadge)) {
            $this->Flash->success(__('The vendor badge has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor badge could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
