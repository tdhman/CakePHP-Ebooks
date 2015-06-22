<?php
App::import('Vendor', 'Uploader.Uploader');

class BooksController extends AppController{

	public $name = 'Books';
	public $uses = array('Book');
	public $helpers = array('Html', 'Form', 'Session','Paginator', 'Cksource');
	public $components = array('Session', 'Auth', 'RequestHandler');
	public $paginate = array('limit' => 5, 'order' => array('Book.created' => 'desc'));

	public function display() {
		$this->paginate['Book'] = array('limit' => 3, 'conditions' => array('Book.published' => true), 'order' => array('Book.created' => 'desc'));;
		$books = $this->paginate();
        if(isset($this->params['requested'])) {
             return $books;
        }
        $this->set('books', $books);
	}
	
	public function index() {
		$this->layout = "admin_default";
        $this->Book->recursive = 0;
        $this->set('books', $this->paginate());
    }
	
	public function show() {
        $books = $this->Book->find('all', array('order' => 'Book.created desc'));
		if (!empty($this->params['requested'])) {
			return $books;
		} else {
			$this->set(compact('books'), $this->paginate('Book'));
		}
    }
	
	public function view($id = null) {
		$this->Book->id = $id;
		$this->set('book',$this->Book->read());
	}
	
	public function add() {
		$this->layout = "admin_default";

		$this->loadModel('BookCategory');
		$categories = $this->BookCategory->find('list', array('fields' => array('BookCategory.id', 'BookCategory.name')));
		$this->set(compact('categories'));

        if ($this->request->is('post')) {
			$this->request->data['Book']['user_id'] = $this->Auth->user('id'); //Only logged in user can add new post
			if (!empty($this->request->data)) {
				if ($data = $this->Uploader->upload('cover', array('overwrite' => true))) {
					$this->request->data['Book']['cover'] = $data['name'];
					if ($this->Book->save($this->request->data)) {
						$this->Session->setFlash('Your post has been saved.');
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash('Unable to add new book.');
					}
				}
			}
        }
    }
	
	public function edit($id = null) {
		$this->layout = "admin_default";

		$this->loadModel('BookCategory');
		$categories = $this->BookCategory->find('list', array('fields' => array('BookCategory.id', 'BookCategory.name')));
		$this->set(compact('categories'));

		$this->Book->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Book->read();
		} else {
			if (!empty($this->request->data)) {
				if ($data = $this->Uploader->upload('cover', array('overwrite' => true))) {
					$this->request->data['Book']['cover'] = $data['name'];
				}
				if ($this->Book->save($this->request->data)) {
					$this->Session->setFlash('Your book has been updated.');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Unable to update your book.');
				}
			}
		}
    }
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Book->delete($id)) {
			$this->Session->setFlash('The book with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function latest() {
		$books = $this->Book->find('all', array('conditions' => array('Book.published' => true), 'order' => 'Book.created DESC', 'limit' => 3));
		if (!empty($this->params['requested'])) {
			return $books;
		} else {
			$this->set(compact('books'), $this->paginate('Book'));
		}
	}
	
	public function top() {
		$books = $this->Book->find('all', array('conditions' => array('Book.published' => true), 'order' => 'Book.rating DESC', 'limit' => 3));
		if (!empty($this->params['requested'])) {
		return $books;
		} else {
		$this->set(compact('books'));
		}
	}
	
	public function searchbook($id = null) {
		$this->loadModel('BookCategory');
		$category = $this->BookCategory->find('first', array('conditions' => array('BookCategory.id' => $id), 'fields' => array('BookCategory.name')));
		$this->set('category', $category['BookCategory']['name']);

		$condition = array('Book.book_category_id' => $id, 'Book.published' => true); 
		$this->set('searchbooks', $this->paginate('Book', $condition));
		
	}
	
	public function newbook() {
		$todayDate = date('Y-m-d');
		$targetDate = date('Y-m-d', strtotime('7 days ago'));
		$condition = array('Book.created <=' => $todayDate, 'Book.created >=' => $targetDate, 'Book.published' => true);
		$this->set('books', $this->paginate('Book', $condition));
	}
	
	public function rate($value = null) {
		$this->Session->setFlash('rating');
		$this->autoRender = false; 
		$rate = floor($this->Book->field('rate')+$value)/2;
		if($this->RequestHandler->isAjax()){
			$this->Book->saveField('rate', $this->Book->field('rate')+1);
		}
	}
	
	public function beforeFilter(){
        parent::beforeFilter();
		$this->Uploader = new Uploader(array('tempDir' => TMP));
		$this->Uploader->setup(array('uploadDir' => 'img'));
    }
	
	// ADMIN ROUTING
	public function admin_index() {
		$this->Book->recursive = 0;
        $this->set('books', $this->paginate());
	}
	
	public function admin_view($id = null) {
		$this->Book->id = $id;
		$this->set('book',$this->Book->read());
	}
	
	public function admin_add() {
        if ($this->request->is('post')) {
			$this->request->data['Book']['user_id'] = $this->Auth->user('id'); //Only logged in user can add new post
            if ($this->Book->save($this->request->data)) {
                $this->Session->setFlash('Your book has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add new book.');
            }
        }
    }
	
	public function admin_edit($id = null) {
		$this->Book->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Book->read();
		} else {
			if ($this->Book->save($this->request->data)) {
				$this->Session->setFlash('Your book has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update your book.');
			}
		}
    }
	
	public function admin_delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Book->delete($id)) {
			$this->Session->setFlash('The book with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
}