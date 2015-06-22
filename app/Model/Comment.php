<?php
class Comment extends AppModel {
	var $name = 'Comment';
	var $belongsTo = array('Post'=>array('className'=>'Post'));
	
	public $validate = array(
        'comment_author' => array(
            'rule' => 'notEmpty'
        ),
        'comment_author_email' => array(
            'rule' => 'notEmpty'
        ),
        'comment_content' => array(
            'rule' => 'notEmpty'
        )
    );
}
