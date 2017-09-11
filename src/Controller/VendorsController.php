<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
/**
 * Vendors Controller
 *
 * @property \App\Model\Table\VendorsTable $Vendors
 *
 * @method \App\Model\Entity\Vendor[] paginate($object = null, array $settings = [])
 */
class VendorsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $vendors = $this->paginate($this->Vendors);

        $this->set(compact('vendors'));
        $this->set('_serialize', ['vendors']);
    }

    /**
     * View method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => ['Users', 'VendorActions', 'VendorBadges', 'VendorDomains', 'VendorLevels', 'VendorPlayers']
        ]);

        $this->set('vendor', $vendor);
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vendor = $this->Vendors->newEntity();

        if ($this->request->is('post')) {
            $this->request->data['client_identifier']=rand(1,999999999);

            $this->loadModel('Roles');
            $role=$this->Roles->findByName("staff_admin")->select(['id'])->first();

            $this->request->data['vendor_domains'][0] = $this->request->data['vendor_domains'];
            $this->request->data['vendor_actions'][0] = ['action_id'=>1,'points'=>100];


            $this->request->data['users'][0] = $this->request->data['user'];
            $this->request->data['users'][0]['role_id']=$role->id;
            $this->request->data['users'][0]['status']= $this->request->data['status'];
            unset($this->request->data['user']);
            unset($this->request->data['vendor_domain']);
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->data,['associated' => ['Users','VendorDomains','VendorActions'] ]);
            // pr($vendor); die('ss');

            if ($this->Vendors->save($vendor,['associated' => ['Users','VendorDomains','VendorActions'] ])) {
                $this->Flash->success(__('The vendor has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vendor'));
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vendor = $this->Vendors->get($id, [
            'contain' => ['VendorDomains']
        ]);

        $oldImageName = $vendor->image_name;
        $path = Configure::read('ImageUpload.unlinkPathForVendorImages');

        if ($this->request->is(['patch', 'post', 'put'])) {
            // $this->request->data['vendor_domains'][0] = $this->request->data['vendor_domains'];
            // unset($this->request->data['vendor_domain']);
            $vendor = $this->Vendors->patchEntity($vendor, $this->request->data);
            if ($this->Vendors->save($vendor)) {
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
            $this->Flash->success(__('The vendor has been saved.'));
            return $this->redirect(['action' => 'index']);
            }else {
                $this->Flash->error(__('The vendor could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vendor'));
        $this->set('_serialize', ['vendor']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vendor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vendor = $this->Vendors->get($id);
        if ($this->Vendors->delete($vendor)) {
            $this->Flash->success(__('The vendor has been deleted.'));
        } else {
            $this->Flash->error(__('The vendor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
