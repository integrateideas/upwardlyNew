<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link      http://cakephp.org CakePHP(tm) Project
* @since     0.2.9
* @license   http://www.opensource.org/licenses/mit-license.php MIT License
*/
namespace App\Controller\Api;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\ConflictException;
use Cake\Cache\Cache;
use Cake\I18n\Time;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
use Cake\Network\Exception\InternalErrorException;
use App\Controller\Api\ApiHelper;

/**
* Application Controller
*
* Add your application-wide methods in the class below, your controllers
* will inherit them.
*
* @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
*/
class SocialLoginApiController extends Controller
{

  //initialize auth
  public function initialize()
  {
    parent::initialize();
    $this->loadComponent('RequestHandler');
    $this->loadComponent('Auth', [
      'authenticate' => [
        'ADmad/HybridAuth.HybridAuth' => [
          // All keys shown below are defaults
          'fields' => [
            'provider' => 'provider',
            'openid_identifier' => 'openid_identifier',
            'email' => 'email'
          ],

          'profileModel' => 'ADmad/HybridAuth.SocialProfiles',
          'profileModelFkField' => 'user_id',

          'userModel' => 'Players',
        ]
      ]
    ]);
}

public function beforeFilter(Event $event)
{
  $origin = $this->request->header('Origin');
  if($this->request->header('CONTENT_TYPE') != "application/x-www-form-urlencoded; charset=UTF-8"){
    $this->request->env('CONTENT_TYPE', 'application/json');
  }
  $this->request->env('HTTP_ACCEPT', 'application/json');
  if (!empty($origin)) {
    $this->response->header('Access-Control-Allow-Origin', $origin);
  }

  if ($this->request->method() == 'OPTIONS') {
    $method  = $this->request->header('Access-Control-Request-Method');
    $headers = $this->request->header('Access-Control-Request-Headers');
    $this->response->header('Access-Control-Allow-Headers', $headers);
    $this->response->header('Access-Control-Allow-Methods', empty($method) ? 'GET, POST, PUT, DELETE' : $method);
    $this->response->header('Access-Control-Allow-Credentials', 'true');
    $this->response->header('Access-Control-Max-Age', '120');
    $this->response->send();
    die;
  }
  // die;
  $this->response->cors($this->request)
  ->allowOrigin(['*'])
  ->allowMethods(['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'])
  ->allowHeaders(['X-CSRF-Token','token'])
  ->allowCredentials()
  ->exposeHeaders(['Link'])
  ->maxAge(300)
  ->build();
}
public function isAuthorized($user)
{
  return false;
}

}
