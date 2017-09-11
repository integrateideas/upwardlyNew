<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Log\Log;

/* Players Controller
*
* @property \App\Model\Table\PlayersTable $Players
*/
class PlayersController extends ApiController
{

  public function initialize()
  {
    parent::initialize();
    $this->Auth->allow(['add']);
  }
  
  /**
  * Protected function for username suggstion
  *
  * @return $username
  */
  protected function _suggestUsername($name){
    $name = trim(strtolower($name));
     // pr($name); die('qq');
    $usernameCheck1 = $this->Players->find()->where(['username' => $name])->first();
    // pr($usernameCheck1); die('u name');
      if(!$usernameCheck1){
        $username = $name;
      }else{
        $usernameCheck2 = $this->Players->find()->where(['username LIKE' => $name.'%'])->all()->toArray();
        //pr($usernameCheck2); die('u 2 name');
          if(!count($usernameCheck2)){
            $username = $name;
          }else{
            $username = $name.count($usernameCheck2);
          }
      }
    return $username;

  }
  
  /**
   * Add method for creating player and vendor player
   *
   * @return \Cake\Network\Response|void Redirects on successful add.
   */
  public function add()
  {

    //Log::write('debug',$this->request);

    $clientIdentifier = '1234567890';
    //$clientIdentifier = $this->request->query['client_id'];
    if(!$clientIdentifier){
      throw new UnauthorizedException('Client Identifier not found');
    }
    //$ref_code = 'ref12';
    //$ref_code = $this->request->query['ref_code'];
    /*validate vendor on basis of client identifier*/
    $this->loadModel('Vendors');
    $getVendorId = $this->Vendors->find()->where(['client_identifier'=>$clientIdentifier])->first()->id;
    if (!$getVendorId) {
      throw new UnauthorizedException('This Vendor is not linked to upwardly');
    }
    // Generate username _suggestUsername function
    // $first_name = $this->request->data()['first_name'];
    // $last_name = $this->request->data()['last_name'];
    // $this->request->data['username'] = $this->_suggestUsername($first_name.$last_name);

    // $this->request->data['username'] = $username;
    // Create vendor players data
    $this->request->data['vendor_players'][0]['vendor_id'] = $getVendorId;
    // $this->request->data['vendor_players'][0]['ref_code'] = $ref_code;
    $this->request->data['vendor_players'][0]['created'] = '2017-09-06 06:27:24';
    $this->request->data['vendor_players'][0]['modified'] = '2017-09-06 06:27:24';
    $player = $this->Players->newEntity();
      if ($this->request->is('post')) {
          $player = $this->Players->patchEntity($player, $this->request->getData(),['associated'=>['VendorPlayers']]);
          // pr($player); die('ssx');
          if ($this->Players->save($player,['associated'=>['VendorPlayers']])) {
            $data =array();
            $data['status']=true;
            $data['data'] = $player;
            $this->set('data',$data['data']);
            $this->set('status',$data['status']);
            $this->set('_serialize', ['status','data']);
          }
      }
  }
  
}
