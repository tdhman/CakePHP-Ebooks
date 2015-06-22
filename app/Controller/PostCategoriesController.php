<?php
class PostCategoriesController extends AppController {
	var $name = 'PostCategories';  

	public function cate() {
		$categories = $this->BookCategory->find('all', array('order' => 'BookCategory.id ASC'));   
		if (!empty($this->params['requested'])) {
			return $categories;
		} else {
			$this->set(compact('categories'));
		}
	}
 }
?>