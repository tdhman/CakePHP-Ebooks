<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array('Session', 'Auth');
	public $helpers = array('Paginator');
	
	function beforeFilter() {
		// Authenticate
		$this->Auth->userModel = 'User';
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->logoutRedirect = '/';
		$this->Auth->allow('display','view','home','latest','top','cate','searchbook','newbook','listaz','post','reply','search','request','feed');
	}
	// Binding variable $user to all view for later access
	function beforeRender() {
		$this->set('user', $this->Auth->user());
		// In the views $user['User']['username'] would display the logged in users username
		if($this->Auth->user('role') == 1){
			$this->set('role',$this->Auth->user('role'));// admin role
		} else {
			$this->set('role',2); //2 is the role of normal users
		}
	}
	
	public function isAuthorized($user) {
		// Admin can access every action
		if (isset($user['role']) && $user['role'] == '1') {
			return true;
		}
		// Default deny
		return false;
	}
}
