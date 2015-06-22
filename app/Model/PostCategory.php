<?php
class PostCategory extends AppModel {
	var $name = 'PostCategory';
	
	public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        ),
		'image' => array(
            'rule' => 'notEmpty'
        )
    );
}
