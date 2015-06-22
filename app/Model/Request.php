<?php class Request extends AppModel {
 
    var $name = 'Request';
    var $useTable = false;
 
    var $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'message' => 'Chưa điền tên người gửi.'
        ),
        'email' => array(
            'rule' => 'email',
            'message' => 'Địa chỉ email không tồn tại.'
        ),
        'message' => array(
            'rule' => 'notEmpty',
            'message' => 'Chưa điền nội dung yêu cầu.'
        )
    );
}