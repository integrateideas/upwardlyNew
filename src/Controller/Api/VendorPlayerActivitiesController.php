<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\I18n\Time;
use Cake\Collection\Collection;
use App\Controller\Api\VendorPlayersController as VP;

/**
* VendorPlayerActivities Controller
*
* @property \App\Model\Table\VendorPlayerActivitiesTable $VendorPlayerActivities
*/
class VendorPlayerActivitiesController extends ApiController
{

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
    $this->Auth->allow(['index','view']);
  }

  /**
  * Index method
  *
  * @return \Cake\Network\Response|null
  */
  public function index()
  {
    // $this->request->query['client_id'] = 'ZUv8tB0wTObl4gBYNeozjvYmHu1x4ilY';
    if(!isset($this->request->query['client_id'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','vendor_id'));
    }
    if(isset($this->request->query['client_id']) && empty($this->request->query['client_id'])){
      throw new BadRequestException(__('EMPTY_NOT_ALLOWED','client_id'));
    }

    $this->loadModel('Vendors');
    $vendorId = $this->Vendors->find()->where(['client_identifier'=>$this->request->query['client_id']])->first()->id;
    $this->request->query['vendor_id'] = $vendorId;
    $this->loadModel('VendorPlayers');
    $vendorPlayers = $this->VendorPlayers->findByVendorId($vendorId)->select(['id'])->all()->toArray();
    $collection = new Collection($vendorPlayers);
    $vendorPlayerIds = $collection->extract('id')->toArray();
    $vendorPlayerActivity = $this->VendorPlayerActivities->find()->contain(['VendorPlayers'])->where(['vendor_player_id in'=>$vendorPlayerIds])
    ->order('VendorPlayerActivities.created DESC')->all()->toArray();

    //pr($vendorPlayerActivity); die();
    $this->loadModel('ADmad/HybridAuth.SocialProfiles');
    foreach ($vendorPlayerActivity as $key => $value) {
      $vendorPlayerActivity[$key]['social_profile'] = $this->SocialProfiles->findByUserId($value->vendor_player->player_id)->first();
    }
    $data =array();
    $data['status']=true;
    $data['data'] = $vendorPlayerActivity;
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);

  }

  /**
  * View method
  *
  * @param string|null $id Vendor Player Activity id.
  * @return \Cake\Network\Response|null
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null)
  {
    if(!isset($this->request->query['client_id'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','vendor_id'));
    }
    if(isset($this->request->query['client_id']) && empty($this->request->query['client_id'])){
      throw new BadRequestException(__('EMPTY_NOT_ALLOWED','client_id'));
    }

    $this->loadModel('Vendors');
    $vendorId = $this->Vendors->find()->where(['client_identifier'=>$this->request->query['client_id']])->first()->id;
    $this->request->query['vendor_id'] = $vendorId;
    $vendorPlayerActivity = $this->VendorPlayerActivities->findByVendorPlayerId($id)
    ->order('VendorPlayerActivities.created DESC')
    ->all()->toArray();

    $data =array();
    $data['status']=true;
    $data['data'] =$vendorPlayerActivity;
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);

  }

  /**
  * Add method
  *
  * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
  */
  public function add()
  {


    $vendorPlayerData = $this->_validateAuthToken();
    $vendorId = $vendorPlayerData['vendor_id'];
    $vendorPlayerId = $this->Auth->user('id');
    $this->request->data['vendor_id'] = $vendorId;
    $this->request->data['vendor_player_id'] = $vendorPlayerId;
    if (!$this->request->is(['post'])) {
      throw new MethodNotAllowedException(__('BAD_REQUEST'));
    }
    if(!$this->request->data){
      throw new BadRequestException(__('Request Data not found. Kindly Provide valid Request Data.'));
    }
    $data = $this->request->data;
    // pr($data); die('s');
    if(!isset($data['meta_data'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','meta_data'));
    }
    $vendorPlayerActivity = $this->VendorPlayerActivities->newEntity($data);
    $vendorPlayerActivity = $this->VendorPlayerActivities->patchEntity($vendorPlayerActivity,$data);
    if($vendorPlayerActivity->errors()){

    }

    if ($this->VendorPlayerActivities->save($vendorPlayerActivity)) {
          $vp = new VP();
      $data =array();
      $data['status']=true;
      $data['data']['feed'] =$vendorPlayerActivity;
      $data['data']['playerInfo'] =$vp->_getPlayerInfo($vendorId,$vendorPlayerId);
      $this->set('status',$data['status']);
      $this->set('data',$data['data']);
      $this->set('_serialize', ['status','data']);
    } else {
      if($vendorPlayerActivity->errors()){
        pr($vendorPlayerActivity->errors());die;
      }else{
        throw new InternalErrorException(__('INTERNAL_SERVER_ERROR'));
      }
    }



  }

  /**
  * Edit method
  *
  * @param string|null $id Vendor Player Activity id.
  * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
  * @throws \Cake\Network\Exception\NotFoundException When record not found.
  */
  public function edit($id = null)
  {
    throw new MethodNotAllowedException(__('BAD_REQUEST'));
  }

  /**
  * Delete method
  *
  * @param string|null $id Vendor Player Activity id.
  * @return \Cake\Network\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null)
  {
    throw new MethodNotAllowedException(__('BAD_REQUEST'));
  }
}
