<?php
class BookCategoriesController extends AppController {
	var $name = 'BookCategories';  

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