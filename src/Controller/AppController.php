<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Network\Session;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\Routing\Router;
use Cake\Log\Log;
use Firebase\JWT\JWT;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    const SUPER_ADMIN_LABEL = 'admin';
    const STAFF_ADMIN_LABEL = 'staff_admin';
    const STAFF_MANAGER_LABEL = 'staff_manager';

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
        ]);

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function beforeFilter(Event $event)
    {
        $user = $this->Auth->user();
        $sideNavData = ['id'=>$user['id'],'first_name' => $user['first_name'],'last_name' => $user['last_name'] ,'role_name' => $user['role']['name'],'role_label' => $user['role']['label']];
        $this->set('sideNavData', $sideNavData);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Http\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        // Note: These defaults are just to get started quickly with development
        // and should not be used in production. You should instead set "_serialize"
        // in each action as required.
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function isAuthorized($user)
    {
        
        if($user['role']->name == self::SUPER_ADMIN_LABEL) {
            $this->_vendorCondition == null;
        } else {
            $this->_vendorCondition == ['vendor_id' => $user['vendor_id']];
        }
        $action = $this->request->params['action'];
        $controller = $this->request->params['controller'];
        if (in_array($action, ['logout'])) {
            return true;
        }
        if (in_array($action, ['index', 'view', 'edit','add']) && $user['role']->name === 'staff_manager') {
            return true;
        }
        if (in_array($controller, ['LegacyRedemptions', 'LegacyRewards','VendorLocations'] ) && in_array($action, ['index', 'view', 'edit', 'add']) && $user['role']->name === 'staff_manager') {
            return true;
        }
        if (in_array($action, ['add','index', 'view', 'edit','delete']) && $user['role']->name === 'admin') {
            return true;
        }
        if (in_array($action, ['add','index','view','delete','edit','staffreport']) && in_array($user['role']->name, ['staff_admin'])) {
            return true;
        }
        if (empty($this->request->params['pass'][0])) {
            return false;
        }
        return false;
    }
}
