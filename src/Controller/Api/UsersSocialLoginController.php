<?php
namespace App\Controller\Api;

use App\Controller\Api\SocialLoginApiController;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ConflictException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\NotFoundException;
use Cake\Collection\Collection;
use Cake\Cache\Cache;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*/
class UsersSocialLoginController extends SocialLoginApiController
{

  const USER_LABEL='user';

  public function initialize()
  {
    parent::initialize();
    $this->Auth->allow(['login']);
  }

  public function index() {
    if(!isset($this->request->query['token'])){
      throw new BadRequestException(__('Unauthrized req'));
    }
    $token  = $this->request->query['token'];
    $payload = JWT::decode($token, Security::salt(), array('HS256'));
    $vendorId = (isset($payload->v_id))? $payload->v_id:null;
    if(!$vendorId){
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }
    $data =array();
    $data['status']=true;
    $data['data']['message']='User Validated. Get access token';
    $data['data']['token_url']='URl';
    $data['data']['token'] = $this->request->query['token'];
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);

  }
  public function login() {
    // die('www');
//    $this->loadComponent('RequestHandler');
    if(!isset($this->request->query['client_id'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','client_id'));
    }
    if(isset($this->request->query['client_id']) && empty($this->request->query['client_id'])){
      throw new BadRequestException(__('EMPTY_NOT_ALLOWED','client_id'));
    }

    $this->loadModel('Vendors');
    $vendorId = $this->Vendors->find()->where(['client_identifier'=>$this->request->query['client_id']])->first()->id;
    // pr($vendorId); die('qq');
    $this->request->query['vendor_id'] = $vendorId;
    if ($this->request->is('post') || $this->request->query('provider')) {
      $this->Auth->config([
        'authenticate' => [
          'ADmad/HybridAuth.HybridAuth' => [
            'hauth_return_to' => '/api/usersSocialLogin/login/?provider='.$this->request->query('provider').'&client_id='.$this->request->query['client_id']
          ]
        ]
      ]);
      /*pr($this->Auth->config([
        'authenticate' => [
          'ADmad/HybridAuth.HybridAuth' => [
            'hauth_return_to' => '/api/usersSocialLogin/login/?provider='.$this->request->query('provider').'&client_id='.$this->request->query['client_id']
          ]
        ]
      ]));
      die('sss');*/

      $user = $this->Auth->identify();
      pr($user); die('sss user');
      if ($user) {
        $this->loadModel('VendorPlayers');
        $isPlayerAssociatedWithVendor = $this->VendorPlayers->findByVendorId($vendorId)->where(['player_id'=>$user['id']])->first();
        if(!$isPlayerAssociatedWithVendor){
          $req = ['vendor_id'=>$vendorId,'player_id'=>$user['id']];
          $vendorPlayer = $this->VendorPlayers->newEntity($req);
          $vendorPlayer = $this->VendorPlayers->patchEntity($vendorPlayer , $req);
          if($this->VendorPlayers->save($vendorPlayer)){
            $isPlayerAssociatedWithVendor =  $vendorPlayer;
          }else{
            //log error
          }
        }
      $token=JWT::encode(['sub' => $isPlayerAssociatedWithVendor->id,'exp' => time() + 10,'v_id'=>$vendorId],Security::salt());
      $upwardlyUrl = $this->request->env('REQUEST_SCHEME').'://'.$this->request->env('SERVER_NAME').$this->request->base;
      $this->redirect($upwardlyUrl.'/UsersSocialLogin?token='.$token);
        
      }
    }
  }
}
