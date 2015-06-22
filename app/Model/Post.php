<?php
class Post extends AppModel {
	var $name = 'Post';
	var $actsAs = array('Hitcount'); 
	//var $hasMany = array('Comment'=>array('className'=>'Comment'));
	var $belongsTo = array ('User' => array ('className' => 'User'), 'PostCategory'=>array('className'=>'PostCategory'));
	
	public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
	
	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) == $post;
	}
}
