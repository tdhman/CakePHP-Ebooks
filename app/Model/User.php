<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
	var $name = 'User';
	
	public $validate = array(
        'name' => array(
		    'required' => array(
                'rule' => array('notEmpty'),
				'message' => 'Nhập vào tên'
			)
        ),
        'username' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'Nhập vào bí danh'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'Bí đanh đã tồn tại.'
				)
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Nhập vào mật khẩu'
            ),
			'login' => array(
				'rule' => '/^[a-z0-9]{6,}$/i',
				'message' => 'Mật khẩu bao gồm chữ hoặc số, tối thiếu 6 kí tự.'
			)
        ),
		'email' => array(
		    'required' => array(
		        'rule' => array('email'),
				'message' => 'Email chưa chính xác.'
			)
		)
    );
	
	/**
	 * Enable Cake to hash password before save to database
	 */
	public function beforeSave($option = array('')) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_tmp']);
		}
		return true;
	}
}