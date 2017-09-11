<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Network\Exception\MethodNotAllowedException;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*/
class UsersController extends ApiController
{

  const USER_LABEL='user';

  public function initialize()
  {
    parent::initialize();
  }


  //Register User
  public function add()
  {
    throw new MethodNotAllowedException(__('BAD_REQUEST'));
  }



  /**
  * Edit method
  *
  * @param string|null $id User id.
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
    * @param string|null $id User id.
    * @return \Cake\Network\Response|null Redirects to index.
    * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */
    public function delete($id = null)
    {
      throw new MethodNotAllowedException(__('BAD_REQUEST'));
    }
  }
