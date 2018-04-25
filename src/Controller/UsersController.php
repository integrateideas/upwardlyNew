<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

use Cake\Routing\Router;
use Cake\Core\Configure;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;

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
    public function index($category_id = null)
    {
        if(empty($category_id)){
            $this->Flash->error(__('Please enter category id in url'));
        }
        $this->viewBuilder()->layout('login-admin');

        /*$woocommerce = new Client(
            'http://revmax.twinspark.co', 
            'ck_5ecf43a297b5341dfb68c4ba5f7e83db56125b19', 
            'cs_6387cb6a55c87e8cd6223fbca39a92324dbfd013',
            [
                'wp_api' => true,
                'version' => 'wc/v1',
            ]
        );*/

        $woocommerce = new Client(
            'https://revmaxconverters.com', 
            'ck_b69a201d410c15d8a6357890a2d479ad472ca1e9', 
            'cs_421cbd0374fb65ba15d2d1621c9a3495e400d702',
            [
                'wp_api' => true,
                'version' => 'wc/v1',
            ]
        );


             // pr($woocommerce); die('ss');
        try {
            // Array of response results.
            
            // $results = $woocommerce->get('products',  ['category' =>$category_id,'per_page'=> '90']);
             $results = $woocommerce->get('products');
            // pr($results); die('ss');

            // $results = $woocommerce->get('products',  ['per_page' => '25','category' =>['303']]);
            // $results = $woocommerce->get('products/attributes/40/terms');//attribute id


            //$attributes = $woocommerce->get('products/attributes/6');
            //pr($attributes); die('ssqq');
            //echo wc_get_formatted_variation( $product->get_variation_attributes(), true );

            // pr($results); die('ss');

            // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...
            // Last request data.
            $lastRequest = $woocommerce->http->getRequest();
            $lastRequest->getUrl(); // Requested URL (string).
            $lastRequest->getMethod(); // Request method (string).
            $lastRequest->getParameters(); // Request parameters (array).
            $lastRequest->getHeaders(); // Request headers (array).
            $lastRequest->getBody(); // Request body (JSON).

            // Last response data.
            $lastResponse = $woocommerce->http->getResponse();
            $lastResponse->getCode(); // Response code (int).
            $lastResponse->getHeaders(); // Response headers (array).
            $lastResponse->getBody(); // Response body (JSON).



        } catch (HttpClientException $e) {
            // pr($e); die('ss');
            $e->getMessage(); // Error message.
            $e->getRequest(); // Last request data.
            $e->getResponse(); // Last response data.
        }

        $this->paginate = [
            'contain' => ['Vendors', 'Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users','results'));
        $this->set('_serialize', ['users','results']);
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
