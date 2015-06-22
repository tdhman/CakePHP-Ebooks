<?php
class BookCategory extends AppModel {
	var $name = 'BookCategory';
	var $hasMany = array('Ebook' => array('className' => 'Ebook', 'counterCache' => true));
	
	public $validate = array(
        'name' => array(
            'rule' => 'notEmpty'
        )
    );
}
