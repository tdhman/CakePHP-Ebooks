<?php
class UsersController extends AppController {
	public $name = 'Users';
	public $uses = array('User');
	public $helpers = array("Html", "Form", "Session");
	public $components = array("Session");
	public $paginate = array('limit' => 10, 'order' => array('User.created' => 'desc'));

	public function index() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->User->recursive = 0;
			$this->set('users', $this->paginate());
		}
		else
			$this->redirect('/');
    }
	public function account($id = null) {
		$this->User->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->User->read();
		} else {
			if (!empty($this->request->data['User']['password_tmp'])){
				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password_tmp']);
			}
			$this->User->save($this->request->data);
			$this->Session->setFlash('Đã cập nhật thay đổi.');
			$this->redirect(array('action' => 'view', $id));
		}
    }
	public function view($id = null) {
		if($this->Auth->User('id') && ($this->Auth->User('id') == $id || $this->Auth->user('role') == '1')) {
			$this->User->id = $id;
			$this->set('test',$this->User->read());
		}
    }
	 /*public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }*/
	
	/**
	*  The AuthComponent provides the needed functionality
	*  for login
	*/
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$id = $this->Auth->user ('id');
				$this->User->id = $id;
				$this->User->saveField ('last_login', date ('Y-m-d H:i:s'));   
				if ($this->Auth->user('role') === 1){
					$this->redirect(array('controller' => 'posts', array('action' => 'index')));
				} else {
					$this->redirect($this->Auth->redirect());
				}
			} else {
				$this->Session->setFlash('Nhập sai tên hoặc mật khẩu!');
			}
		}
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	public function register() {
		if (!empty($this->data)) {
			if( $this->data['User']['password'] != $this->data['User']['password_tmp'] ) {
				$this->User->invalidate( 'password_tmp', 'Mật khẩu không đúng.' );
			} else {
				$this->Session->setFlash("Xin lỗi. Hiện tại không cho đăng kí tài khoản mới.");
				/*$this->User->create();
				if($this->User->save($this->data))
				{
					$this->Session->setFlash("Tài khoản đã được tạo. Bạn có thể đăng nhập bây giờ.");
					$this->redirect(array('action' => 'login'));
				}*/
			}
		}
	}
	
	public function add() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			if (!empty($this->data)) {
				if( $this->data['User']['password'] != $this->data['User']['password_tmp'] ) {
					$this->User->invalidate( 'password_tmp', 'Password does not match.' );
				} else {
					$this->User->create();
					if($this->User->save($this->data))
					{
						$this->Session->setFlash("Account created.", 'flash_success');
					}
				}
			}
		}
	}
	
	public function edit($id = null) {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->User->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->User->read();
			} else {
				if (!empty($this->request->data)) {
					$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password_tmp']);
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash('User info has been updated.');
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash('Unable to update user info.');
					}
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function delete($id) {
		if ($this->Auth->user('role') == '1'){
			if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			}
			if ($this->User->delete($id)) {
				$this->Session->setFlash('User with id: ' . $id . ' has been deleted.');
				$this->redirect(array('action' => 'index'));
			}
		} else {
			$this->redirect('/');
		}
	}
	
	public function search() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$users = $this->User->find('all', array('fields' => array('User.id','User.username'), 'order' => 'User.username asc'));
			$this->set(compact('users'));
		}
	}
	
	// Allow registration
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->fields = array('username' => 'username', 'password' => 'password');
		$this->Auth->allow('register','forgot');
		if(in_array($this->action, array('register'))) {
			$this->Auth->fields = array('username' => 'username', 'password' => 'wrongfield'); //That means that password will NOT be hashed during registration process (in case of failed validation of register form).
		}
	}
	
	function beforeRender() {
		parent::beforeRender();
	}
	
	/*
	 * ADMIN ROUTING
	*/
	public function admin_login() {
		$this->layout = "admin_login";
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->Auth->user('role') == '1')
					$this->redirect(array('admin' => false, 'controller' => 'posts', 'action' => 'index'));
				else
					$this->Session->setFlash('Your account is valid, but you do not have admin role', 'flash_attention');
			} else {
				$this->Session->setFlash('Invalid username or password, try again!', 'flash_error');
			}
		}
	}
	
	public function admin_logout() {
		$this->Auth->logout();
		$this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'login'));
	}
}