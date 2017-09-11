<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendors', 'Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Vendors', 'Roles', 'SocialProfiles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            //pr($user); die('ss');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $loggedInUser = $this->Auth->user();
        if($loggedInUser['role']->name == self::SUPER_ADMIN_LABEL){
            $vendors = $this->Users->Vendors->find('list')->where(['status'=>1])->all()->toArray();
            $roles = $this->Users->Roles->find('list')->where(['status'=>1])->all()->toArray();
        }else {
            $roles = $this->Users->Roles->find('list')->where(['status'=>1,'name <>'=>'admin'])->all()->toArray();
        }
        $this->set('loggedInUser', $loggedInUser);
        $this->set(compact('user', 'vendors', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $loggedInUser = $this->Auth->user();
        if($loggedInUser['role']->name == self::SUPER_ADMIN_LABEL){
        $vendors = $this->Users->Vendors->find('list')->where(['status'=>1])->all()->toArray();
        $roles = $this->Users->Roles->find('list')->where(['status'=>1])->all()->toArray();
        }else if($loggedInUser['role']->name == self::STAFF_ADMIN_LABEL){
        $vendors = $this->Users->Vendors->find('list')
        ->where(['status'=>1, 'id'=>$loggedInUser['vendor_id']])
        ->all()
        ->toArray();
        $roles = $this->Users->Roles->find('list')
        ->where(['status'=>1,'name <>'=>'admin'])
        ->all()
        ->toArray();
        }
        else {
        $vendors = $this->Users->Vendors->find('list')
        ->where(['status'=>1, 'id'=>$loggedInUser['vendor_id']])
        ->all()
        ->toArray();
        $roles = $this->Users->Roles->find('list')
        ->where(['status'=>1,'name'=>'staff_manager'])
        ->all()
        ->toArray();
        }
        $this->set('loggedInUser', $loggedInUser);
        
        $this->set(compact('user', 'vendors', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @param null
     * @return \Cake\Http\Response|null Redirects to dashboard.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function login(){
        $this->viewBuilder()->layout('login-admin');   
        if ($this->request->is('post')) {
        //pr($this->request); die();
            $user = $this->Auth->identify();
            //pr($user); die('sss');
            if ($user) {
                $this->loadModel('Roles');
                $user['role'] = $query = $this->Roles->find('RolesById', ['role' => $user['role_id']])->select(['name', 'label'])->first();
                //pr($query); die();
                $this->loadModel('Vendors');
                $query = $this->Vendors->findById($user['vendor_id'])->first();
                if($query->status != 1) {
                $this->Flash->error(__('VENDOR_ACCOUNT_DISABLED', $query->org_name ));
                return null;
            }
            $this->Auth->setUser($user);
            //Setup Session Data to Handle View Elements
            $loggedInUser = $this->Auth->user();
            $userId = $loggedInUser['id'];
            
            $this->redirect(['controller' => 'Users','action' => 'index']);
            
            }else{
                $this->Flash->error(__('We are not able to recognize you. Kindly Provide correct credentials.'));
            }
        }  
    }

    /**
     * Logout method
     * @param null
     * @return \Cake\Http\Response|null Redirects to login.
     */
    public function logout(){
        $this->Auth->logout();
        return $this->redirect(['action' => 'login']);
    }

}
