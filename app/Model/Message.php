<?php
class Message extends AppModel {
	var $name = 'Message';
	
	var $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Chưa điền tên người gửi.'
        ),
        'email' => array(
            'rule' => 'email',
            'message' => 'Địa chỉ email không tồn tại.'
        ),
        'content' => array(
            'rule' => 'notEmpty',
            'message' => 'Chưa điền nội dung.'
        )
    );
}