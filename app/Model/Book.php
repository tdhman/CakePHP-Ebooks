<?php
class Book extends AppModel {
	var $name = 'Book';
	//var $hasMany = array('Comment'=>array('className'=>'Comment'));
	var $belongsTo = array('BookCategory'=>array('className'=>'BookCategory'));
	var $actsAs = array(
		'Uploader.FileValidation' => array(
			'file' => array(
				'extension' => array(
					'value' => array('gif', 'jpg', 'jpeg'),
					'error' => 'Only gif, jpg and jpeg images are allowed!'
				),
				'minWidth' => 500,
				'minHeight' => 500,
				'required' => true
			),
			'import' => array(
				'required' => false
			),
			'file1' => array(
				'required' => true
			),
			'file2' => array(
				'required' => false
			),
			'file3' => array(
				'required' => true
			)
		)
	);
	public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'content' => array(
            'rule' => 'notEmpty'
        ),
		'author' => array(
            'rule' => 'notEmpty'
        ),
		'editor' => array(
            'rule' => 'notEmpty'
        ),
		'genre' => array(
            'rule' => 'notEmpty'
        ),
		'cover' => array(
            'rule' => 'notEmpty'
        ),
		'abstract' => array(
            'rule' => 'notEmpty'
        ),
		'publisher' => array(
            'rule' => 'notEmpty'
        ),
                'published_date' => array(
            'rule' => 'notEmpty'
        )
    );
}
