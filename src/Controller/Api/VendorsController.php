<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ConflictException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Inflector;
use Cake\Routing\Router;
use Cake\Core\Configure;
use Firebase\JWT\JWT;
use Cake\Cache\Cache;
use Cake\Utility\Security;
use Cake\I18n\Time;

/**
* Vendors Controller
*
* @property \App\Model\Table\VendorsTable $Vendors
*/
class VendorsController extends ApiController
{

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
    $this->Auth->allow(['token']);
  }


  // generate vendor token
  //get client identifier and create jwt auth token
  //
  public function token()
  {
    // generate vendor token 
    $clientIdentifier = '1234567890';
    // pr($clientIdentifier); die('ss');
    //$clientIdentifier = $this->request->query['client_id'];
    if(!$clientIdentifier){
      throw new BadRequestException('Client Identifier not found');
    }

    /*validate vendor on basis of client identifier*/
    $this->loadModel('Vendors');
    $getVendorId = $this->Vendors->find()->where(['client_identifier'=>$clientIdentifier])->first()->id;
    
    $token=JWT::encode(['exp' => time() + 10,'v_id'=>$getVendorId],Security::salt());
      $data =array();
      $data['status']=true;
      $data['data'] = $token;
      $this->set('data',$data['data']);
      $this->set('status',$data['status']);
      $this->set('_serialize', ['status','data']);
  }

}
