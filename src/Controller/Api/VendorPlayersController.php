<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ConflictException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Collection\Collection;
use Cake\Cache\Cache;
use Cake\Event\Event;
/**
* VendorPlayers Controller
*
* @property \App\Model\Table\VendorPlayersTable $VendorPlayers
*/
class VendorPlayersController extends ApiController
{

  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
    $this->Auth->allow(['token','view','leaderBoard','show_myself']);
  }

  /**
  * Index method
  *
  * @return \Cake\Network\Response|null
  */
  public function index()
  {
    $vendorPlayerData = $this->_validateAuthToken();
    $vendorId = $vendorPlayerData['vendor_id'];
    $vendorPlayerId = $this->Auth->user('id');
    $data =array();
    $data['status']=true;
    $data['data'] =$this->_getPlayerInfo($vendorId,$vendorPlayerId);
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);
  }

  public function token()
  {
    $token = $this->request->header('Authorization');
    $payload = JWT::decode($token, Security::salt(), array('HS256'));
    $vendorId = (isset($payload->v_id))? $payload->v_id:null;
    if(!$vendorId){
      throw new UnauthorizedException(__('INVALID_TOKEN_PROVIDED'));
    }
    $time = time() + (365 * 24 * 60 * 60);
    $expTime = Time::createFromTimestamp($time);
    $expTime = $expTime->format('Y-m-d H:i:s');
    $data =array();
    $data['status']=true;
    $data['data']['token'] =JWT::encode(['sub' => $payload->sub,'exp' =>  $time,'v_id'=>$vendorId],Security::salt());
    $data['data']['expiry'] =$expTime;
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);
  }
  /**
  * View method
  *
  * @param string|null $id Vendor Player id.
  * @return \Cake\Network\Response|null
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function view($id = null)
  {
    if(!isset($this->request->query['client_id'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','client_id'));
    }
    if(isset($this->request->query['client_id']) && empty($this->request->query['client_id'])){
      throw new BadRequestException(__('EMPTY_NOT_ALLOWED','client_id'));
    }

    $this->loadModel('Vendors');
    $vendorId = $this->Vendors->find()->where(['client_identifier'=>$this->request->query['client_id']])->first()->id;
    $this->request->query['vendor_id'] = $vendorId;
    $data =array();
    $data['status']=true;
    $data['data'] =$this->_getPlayerInfo($vendorId,$id);
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);
  }

  public function _getPlayerInfo($vendorId,$vendorPlayerId){
    $monthFromDate = Time::now();
    $monthFromDate->day(1);
    $monthFromDate = $monthFromDate->format('Y-m-d 00:00:00');
    $weekFromDate  = Time::now();
    $weekFromDate->subDay(6);
    $weekFromDate = $weekFromDate->format('Y-m-d 00:00:00');
    $todayFromDate = Time::now();
    $todayFromDate = $todayFromDate->format('Y-m-d 00:00:00');
    $toDate = Time::now();
    $toDate = $toDate->format('Y-m-d H:i:s');
    $playerInfo = array();
    $points = 0;
    // pr($this->Players);die;
    $this->loadModel('VendorPlayerActivities');
    $differentPoints = $this->VendorPlayerActivities->findByVendorPlayerId($vendorPlayerId);
    $thisMonthPoints = $differentPoints->where(['created >= '=>$monthFromDate,'created < '=>$toDate])->sumOf('points');
    $thisWeekPoints = $differentPoints->where(['created >= '=>$weekFromDate,'created < '=>$toDate])->sumOf('points');
    $todayPoints = $differentPoints->where(['created >= '=>$todayFromDate,'created < '=>$toDate])->sumOf('points');

    $this->loadModel('VendorPlayers');
    $playerData = $this->VendorPlayers->findById($vendorPlayerId)
    ->contain(['VendorPlayerBadges','VendorLevels','Players','Vendors'])->first();
    $playerInfo['playerLevelInfo'] = $playerData->vendor_level;
    unset($playerData->vendor_level);
    $playerBadgesCount = count($playerData->vendor_player_badges);
    unset($playerData->vendor_player_badges);
    $this->loadModel('ADmad/HybridAuth.SocialProfiles');
    $playerData->player->socialProfile  = $this->SocialProfiles->findByUserId($playerData->player_id)->first();
    $playerInfo['playerInfo'] = $playerData;

    $playerInfo['playerInfo']['playerBadgesCount'] = $playerBadgesCount;
    $playerInfo['playerInfo']['thisMonthPoints'] = $thisMonthPoints;
    $playerInfo['playerInfo']['thisWeekPoints'] = $thisWeekPoints;

    $playerInfo['playerInfo']['todayPoints'] = $todayPoints;

    $this->loadModel('VendorLevels');
    $netRequiredPointsUpToCurrentLevel = $this->VendorLevels->findByVendorId($vendorId)
    ->where(['level_rank =' =>$playerInfo['playerLevelInfo']->level_rank])->first()->points;
    $requiredPointsToAchieveNextVendorLevel = $this->VendorLevels->findByVendorId($vendorId)
    ->where(['level_rank' =>($playerInfo['playerLevelInfo']->level_rank + 1)])->first();
    if($requiredPointsToAchieveNextVendorLevel){
      $requiredPointsToAchieveNextVendorLevel = $requiredPointsToAchieveNextVendorLevel->points;
    }else{
      $requiredPointsToAchieveNextVendorLevel = $this->VendorLevels->findByVendorId($vendorId)
    ->where(['level_rank' =>($playerInfo['playerLevelInfo']->level_rank)])->first();
    $requiredPointsToAchieveNextVendorLevel = $requiredPointsToAchieveNextVendorLevel->points;
    }
    $playerRequiredPointsToGetNextLevel = $requiredPointsToAchieveNextVendorLevel - $netRequiredPointsUpToCurrentLevel;

    $remainingPointsToAchieveNextLevel = $requiredPointsToAchieveNextVendorLevel - $playerInfo['playerInfo']->points;
    $playerAheadFromCurrentLevel = $playerInfo['playerInfo']->points - $netRequiredPointsUpToCurrentLevel;
    if($playerRequiredPointsToGetNextLevel){
      $percentPointsGainedToAchieveNextlevel = ($playerAheadFromCurrentLevel/$playerRequiredPointsToGetNextLevel)*100;  
    }else{
      $percentPointsGainedToAchieveNextlevel = 0;
    }
    
    $playerInfo['playerInfo']['percentPointsGainedToAchieveNextLevel'] = $percentPointsGainedToAchieveNextlevel;
    $playerInfo['playerInfo']['pointsRemainingToAchieveNextLevel'] = $remainingPointsToAchieveNextLevel;
    $playerInfo['playerInfo']['totalAbsolutePointsRequiredForNextLevel'] = $playerRequiredPointsToGetNextLevel;
    $playerInfo['playerInfo']['totalRelativePointsRequiredForNextLevel'] = $requiredPointsToAchieveNextVendorLevel;
    //if it is last level then true else false

    $getLastLevelPoints = $this->VendorLevels->findByVendorId($vendorId)->last();
    if($playerInfo['playerLevelInfo']->id == $getLastLevelPoints->id){
      $playerInfo['playerInfo']['isFinalLevel'] = true;
    }else{
      $playerInfo['playerInfo']['isFinalLevel'] = false;
    }
    

    $playerInfo['playerInfo'] = $playerInfo['playerInfo']->toArray();
    $playerInfo['playerLevelInfo'] = $playerInfo['playerLevelInfo']->toArray();
    $this->loadModel('VendorPlayerBadges');
    $this->loadModel('VendorBadges');
    $playerBadges = $this->VendorPlayerBadges->findByVendorPlayerId($vendorPlayerId)->contain(['VendorBadges'])->toArray();


    //pr(count($playerBadges)); die('ss');
    $badgeIds = array();
    $totalVendorPlayerCount = $this->VendorPlayers->findByVendorId($vendorId)->count();
    $playerInfo['achievedBadges'] = $playerBadges;
    $this->loadModel('VendorPlayerBadges');
    foreach ($playerInfo['achievedBadges'] as $key => $value) {
      $playerGainedThisBadge = $this->VendorPlayerBadges->findByVendorBadgeId($value->vendor_badge->id)->count();
      $playerInfo['achievedBadges'][$key]['perecentPlayerGainedThisBadge'] = ($playerGainedThisBadge/$totalVendorPlayerCount)*100;
    }

    $playerInfo['playerInfo']['playerAchievedBadgesCount'] = count($playerBadges);
    if($vendorPlayerId == $this->Auth->user('id')){
      foreach ($playerBadges as $key => $value) {
        $badgeIds[] = $value->vendor_badge_id;
      }
      if($badgeIds){
          $vendorBadges = $this->VendorBadges->findByVendorId($vendorId)->where(['VendorBadges.id NOT IN'=>$badgeIds])->toArray();
      }else{
        $vendorBadges = $this->VendorBadges->findByVendorId($vendorId)->toArray();
      }

      $playerInfo['unachievedBadges'] = $vendorBadges;
      foreach ($playerInfo['unachievedBadges'] as $key => $value) {
        $perecentPlayerGainedThisBadge = $this->VendorPlayerBadges->findByVendorBadgeId($value->id)->count();
        $playerInfo['unachievedBadges'][$key]['perecentPlayerGainedThisBadge'] = ($perecentPlayerGainedThisBadge/$totalVendorPlayerCount)*100;
      }
      $playerInfo['playerInfo']['vendorTotalBadgesCount'] = count($playerBadges) + count($vendorBadges);

      $playerInfo['playerInfo']['percentageBadgeAchievedByPlayer'] = ($playerInfo['playerInfo']['playerAchievedBadgesCount']/$playerInfo['playerInfo']['vendorTotalBadgesCount'])*100;

    }

    $playerLevels = $this->VendorLevels->findByVendorId($vendorId)->where(['id <= ' => $playerData->vendor_level_id])->toArray();

    $vendorLevels = $this->VendorLevels->findByVendorId($vendorId)->where(['id > ' => $playerData->vendor_level_id])->toArray();
    $playerInfo['achievedLevels'] = $playerLevels;
    foreach ($playerLevels as $key => $value) {
      $playerGainedThisLevel = $this->VendorPlayers->findByVendorId($vendorId)->where(['vendor_level_id >='=>$value->id])->count();
      $playerInfo['achievedLevels'][$key]['perecentPlayerGainedThisLevel'] = ($playerGainedThisLevel/$totalVendorPlayerCount)*100;
    }
    $playerInfo['unachievedLevels'] = $vendorLevels;
    foreach ($vendorLevels as $key => $value) {
      $playerGainedThisLevel = $this->VendorPlayers->findByVendorId($vendorId)->where(['vendor_level_id >='=>$value->id])->count();
      $playerInfo['unachievedLevels'][$key]['perecentPlayerGainedThisLevel'] = ($playerGainedThisLevel/$totalVendorPlayerCount)*100;
    }
    return $playerInfo;
  }


  public function leaderBoard(){
    if(!isset($this->request->query['client_id'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','vendor_id'));
    }
    if(isset($this->request->query['client_id']) && empty($this->request->query['client_id'])){
      throw new BadRequestException(__('EMPTY_NOT_ALLOWED','client_id'));
    }

    $this->loadModel('Vendors');
    $vendorId = $this->Vendors->find()->where(['client_identifier'=>$this->request->query['client_id']])->first()->id;
    $this->request->query['vendor_id'] = $vendorId;
    $data = $this->request->query;
    $fromDate = null;
    $toDate = Time::now();
    $toDate = $toDate->format('Y-m-d H:i:s');
    if(isset($data['interval'])){
      switch ($data['interval']) {
        case 'month':
        $fromDate = Time::now();
        $fromDate->day(1);
        $fromDate = $fromDate->format('Y-m-d 00:00:00');
        break;
        case 'week':
        $fromDate = $fromDate = Time::now();
        $fromDate->subDay(6);
        $fromDate = $fromDate->format('Y-m-d 00:00:00');

        break;
        case 'today':
        $fromDate = $fromDate = Time::now();
        $fromDate = $fromDate->format('Y-m-d 00:00:00');
        break;
        default:
        $fromDate = null;
        $toDate = null;
        break;
      }
    }
    $this->loadModel('VendorPlayerActivities');
    $vendorPlayers = $this->VendorPlayers->findByVendorId($vendorId)->select(['id'])->all()->toArray();
    $collection = new Collection($vendorPlayers);
    $vendorPlayerIds = $collection->extract('id')->toArray();
    $query = $this->VendorPlayerActivities->find();
    if($fromDate && $toDate){
      $vendor_player_data = $query->contain(['VendorPlayers','VendorPlayers.Players'])->where(['vendor_player_id in'=>$vendorPlayerIds])
      ->select(['sum' => $query->func()->sum('VendorPlayerActivities.points'),'vendor_player_id','VendorPlayers.player_id'])
      ->where(['VendorPlayerActivities.created >= '=>$fromDate,'VendorPlayerActivities.created < '=>$toDate])
      ->group(['vendor_player_id'])
      ->order('sum DESC')
      ->all()->toArray();
    }else{
      $vendor_player_data = $query->contain(['VendorPlayers','VendorPlayers.Players'])->where(['vendor_player_id in'=>$vendorPlayerIds])
      ->select(['sum' => $query->func()->sum('VendorPlayerActivities.points'),'vendor_player_id','VendorPlayers.player_id'])
      ->group(['vendor_player_id'])
      ->order('sum DESC')
      ->all()->toArray();
    }
    // pr($vendor_player_data);die;
    $this->loadModel('ADmad/HybridAuth.SocialProfiles');
    foreach ($vendor_player_data as $key => $value) {
      $vendor_player_data[$key]['playerInfo'] =  $this->VendorPlayers->findById($value->vendor_player_id)->contain(['Players'])->where(['vendor_id'=>$vendorId])->first();
      $vendor_player_data[$key]['social_profile'] = $this->SocialProfiles->findByUserId($value->vendor_player->player_id)->first();
    }
    $data =array();
    $data['status']=true;
    $data['data'] =$vendor_player_data;
    $this->set('data',$data['data']);
    $this->set('status',$data['status']);
    $this->set('_serialize', ['status','data']);

  }

  public function show_myself(){
    if(!isset($this->request->query['client_id'])){
      throw new BadRequestException(__('MANDATORY_FIELD_MISSING','vendor_id'));
    }
    if(isset($this->request->query['client_id']) && empty($this->request->query['client_id'])){
      throw new BadRequestException(__('EMPTY_NOT_ALLOWED','client_id'));
    }
    $vendorPlayerData = $this->_validateAuthToken();
    $vendorId = $vendorPlayerData['vendor_id'];
    $vendorPlayerId = $this->Auth->user('id');
    $this->loadModel('Vendors');
    $vendorId = $this->Vendors->find()->where(['client_identifier'=>$this->request->query['client_id']])->first()->id;
    $this->request->query['vendor_id'] = $vendorId;

    $data = $this->request->query;
    $fromDate = null;
    $toDate = Time::now();
    $toDate = $toDate->format('Y-m-d H:i:s');
    if(isset($data['interval'])){
      switch ($data['interval']) {
        case 'month':
        $fromDate = Time::now();
        $fromDate->day(1);
        $fromDate = $fromDate->format('Y-m-d 00:00:00');
        break;
        case 'week':
        $fromDate = $fromDate = Time::now();
        $fromDate->subDay(6);
        $fromDate = $fromDate->format('Y-m-d 00:00:00');

        break;
        case 'today':
        $fromDate = $fromDate = Time::now();
        $fromDate = $fromDate->format('Y-m-d 00:00:00');
        break;
        default:
        $fromDate = null;
        $toDate = null;
       
      }
    }
    $this->loadModel('VendorPlayerActivities');
    $vendorPlayers = $this->VendorPlayers->findByVendorId($vendorId)->select(['id'])->all()->toArray();
    $collection = new Collection($vendorPlayers);
    $vendorPlayerIds = $collection->extract('id')->toArray();
    $query = $this->VendorPlayerActivities->find();
    if($fromDate && $toDate){
    $vendor_player_data = $query->contain(['VendorPlayers','VendorPlayers.Players'])->where(['vendor_player_id in'=>$vendorPlayerIds])
      ->select(['sum' => $query->func()->sum('VendorPlayerActivities.points'),'vendor_player_id','VendorPlayers.player_id'])
      ->where(['VendorPlayerActivities.created >= '=>$fromDate,'VendorPlayerActivities.created < '=>$toDate])
      ->group(['vendor_player_id'])
      ->order('sum DESC')
      ->all()->toArray();

    
  }else{
    $vendor_player_data = $query->contain(['VendorPlayers','VendorPlayers.Players'])->where(['vendor_player_id in'=>$vendorPlayerIds])
      ->select(['sum' => $query->func()->sum('VendorPlayerActivities.points'),'vendor_player_id','VendorPlayers.player_id'])
      ->group(['vendor_player_id'])
      ->order('sum DESC')
      ->all()->toArray();

  }
  // pr($vendor_player_data);die;
    foreach ($vendor_player_data as $key => $value) {
      $vendor_player_data[$key]['rank'] = $key + 1;
      if($value->vendor_player_id == $vendorPlayerId){
        $vendorPlayerArrayKey = $key;
      }
    }
    // pr($vendor_player_data);die;
    // pr($vendor_player_data[$vendorPlayerArrayKey]);die;
    // pr($vendorPlayerArrayKey);die;
    // pr($vendor_player_data[$vendorPlayerArrayKey]['rank']);die;
    // pr(sizeof($vendor_player_data));die;
    if(sizeof($vendor_player_data) < 5){
      $start = 0;
      $noOfPlayers = sizeof($vendor_player_data); 
    }elseif($vendor_player_data[$vendorPlayerArrayKey]['rank'] < 3){
      $start = 0;
      $noOfPlayers = 5 ;
    }elseif (sizeof($vendor_player_data)-3 <= $vendorPlayerArrayKey+1) {
      $start = sizeof($vendor_player_data)-5;
      $noOfPlayers =  5;
      
    }else{
      $start = $vendorPlayerArrayKey-2;
      $noOfPlayers = 5;
    }
    $requiredData = array_slice($vendor_player_data, $start,$noOfPlayers);

    $this->loadModel('ADmad/HybridAuth.SocialProfiles');
    foreach ($vendor_player_data as $key => $value) {
      $vendor_player_data[$key]['playerInfo'] =  $this->VendorPlayers->findById($value->vendor_player_id)->contain(['Players'])->where(['vendor_id'=>$vendorId])->first();
      $vendor_player_data[$key]['social_profile'] = $this->SocialProfiles->findByUserId($value->vendor_player->player_id)->first();
    }

    $data['status']=true;
    $this->set('data',$requiredData,$vendor_player_data);
    $this->set('_serialize', ['data']);

  }

  /**
  * Add method
  *
  * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
  */
  public function add()
  {
    throw new MethodNotAllowedException(__('BAD_REQUEST'));
  }

  /**
  * Edit method
  *
  * @param string|null $id Vendor Player id.
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
  * @param string|null $id Vendor Player id.
  * @return \Cake\Network\Response|null Redirects to index.
  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
  */
  public function delete($id = null)
  {
    throw new MethodNotAllowedException(__('BAD_REQUEST'));
  }



}
