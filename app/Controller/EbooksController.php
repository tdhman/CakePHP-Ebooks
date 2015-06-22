<?php
App::import('Vendor', 'Uploader.Uploader');

class EbooksController extends AppController{

	public $name = 'Ebooks';
	public $uses = array('Ebook');
	public $helpers = array('Html', 'Form', 'Session','Paginator', 'Cksource', 'Text', 'Cache');
	public $components = array('Session', 'Auth', 'RequestHandler');
	public $paginate = array('Ebook' => array('limit' => 5, 'order' => array('Ebook.created' => 'desc')),
							'Comment' => array('limit' => 4, 'order' => array('Comment.created' => 'asc')));
	var $cacheAction = array('view' => array('callbacks' => true, 'duration' => 21600),
							 'display' => array('callbacks' => true, 'duration' => 36000));


	public function display() {
		$this->paginate['Ebook'] = array('limit' => 3, 'conditions' => array('Ebook.published' => true), 'order' => array('Ebook.created' => 'desc'));
		$ebooks = $this->paginate();
        if(isset($this->params['requested'])) {
             return $ebooks;
        }
        $this->set('ebooks', $ebooks);
	}

	public function feed() {
		if( $this->RequestHandler->isRss() ){
			$ebooks = $this->Ebook->find('all', array('limit' => 10, 'order' => 'Ebook.created DESC'));
			return $this->set(compact('ebooks'));
		}
	}

	public function index() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->Ebook->recursive = 0;
			$this->set('ebooks', $this->paginate());
		}
		else
			$this->redirect('/');
    }
	
	public function show() {
		$ebooks = $this->Ebook->find('all', array('order' => 'Ebook.created desc'));
		if (!empty($this->params['requested'])) {
			return $ebooks;
		} else {
			$this->set(compact('ebooks'), $this->paginate('Ebook'));
		}
    }
	
	public function view($id = null) {
		$this->layout = "view_default";
		$ebook = $this->Ebook->findById($id);
		if (!$ebook) {
			throw new NotFoundException('Trang không tồn tại.');
		}
		// separate rss stats, with custom field  
        if (isset($this->passedArgs['from']) && $this->passedArgs['from'] == 'rss')  
            $this->Ebook->hit($ebook['Ebook']['id'], array('hitField' => 'hitcount_rss'));  
        // regular hitcount  
		$this->Ebook->hit($ebook['Ebook']['id']);  
		
		$this->set('ebook', $ebook);
		
		$this->loadModel('Comment');
		$condition = array('Comment.ebook_id' => $id); 
		$this->set('comments', $this->paginate('Comment', $condition));
	}
	
	public function add() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('BookCategory');
			$categories = $this->BookCategory->find('list', array('fields' => array('BookCategory.id', 'BookCategory.name'), 'cache' => 'bookCategory', 'cacheConfig' => 'long'));
			$this->set(compact('categories'));

			if ($this->request->is('post')) {
				$this->request->data['Ebook']['user_id'] = $this->Auth->user('id'); //Only logged in user can add new post
				if (!empty($this->request->data)) {
					if ($data = $this->Uploader->upload('cover', array('overwrite' => true))) {
						$this->request->data['Ebook']['cover'] = $data['name'];
						if ($this->Ebook->save($this->request->data)) {
							$this->Session->setFlash('Your ebook has been saved.', 'flash_success');
							$this->redirect(array('action' => 'index'));
						} else {
							$this->Session->setFlash('Unable to add new ebook.', 'flash_error');
						}
					}
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function edit($id = null) {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('BookCategory');
			$categories = $this->BookCategory->find('list', array('fields' => array('BookCategory.id', 'BookCategory.name')));
			$this->set(compact('categories'));

			$this->Ebook->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Ebook->read();
			} else {
				if (!empty($this->request->data)) {
					if ($data = $this->Uploader->upload('cover', array('overwrite' => true))) {
						$this->request->data['Ebook']['cover'] = $data['name'];
					}
					if ($this->Ebook->save($this->request->data)) {
						$this->Session->setFlash('Your ebook has been updated.', 'flash_success');
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash('Unable to update your ebook.', 'flash_error');
					}
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Ebook->delete($id)) {
			$this->Session->setFlash('The ebook with id: ' . $id . ' has been deleted.');
			//$this->redirect(array('action' => 'index'));
			$this->redirect($this->referer());
		}
	}
	
	public function latest() {
		$ebooks = $this->Ebook->find('all', array('conditions' => array('Ebook.published' => true), 'order' => array('Ebook.created desc'), 'limit' => 10));
		
		if (!empty($this->params['requested'])) {
			return $ebooks;
		} else {
			$this->set(compact('ebooks'), $this->paginate('Ebook'));
		}
	}
	
	public function top() {
		$ebooks = $this->Ebook->find('all', array('conditions' => array('Ebook.published' => true, 'Ebook.rating' => 4), 'order' => 'rand()', 'limit' => 3));
		if (!empty($this->params['requested'])) {
		return $ebooks;
		} else {
		$this->set(compact('ebooks'));
		}
	}
	
	public function searchbook($id = null) {
		$this->loadModel('BookCategory');
		$category = $this->BookCategory->find('first', array('conditions' => array('BookCategory.id' => $id), 'fields' => array('BookCategory.name', 'BookCategory.ebook_count')));
		$this->set('category', $category['BookCategory']['name']);
		$this->set('ebook_count', $category['BookCategory']['ebook_count']);

		$condition = array('Ebook.book_category_id' => $id, 'Ebook.published' => true); 
		$this->set('searchbooks', $this->paginate('Ebook', $condition));
		
	}
	
	public function search() {
		$ebooks = $this->Ebook->find('all', array('conditions' => array('Ebook.published' => true), 'fields' => array('Ebook.id','Ebook.title', 'Ebook.author', 'Ebook.genre'), 'order' => 'Ebook.author asc'));
		$this->set(compact('ebooks'));
	}
	
	public function newbook() {
		$todayDate = date('Y-m-d');
		$targetDate = date('Y-m-d', strtotime('7 days ago'));
		$condition = array('Ebook.created <=' => $todayDate, 'Ebook.created >=' => $targetDate, 'Ebook.published' => true);
		$this->set('ebooks', $this->paginate('Ebook', $condition));
	}
	
	public function listaz($id = null) {
		if ($id == 1)
			$this->paginate['Ebook'] = array('limit' => 10, 'conditions' => array('Ebook.published' => true), 'order' => array('Ebook.title' => 'asc'));
		else
			$this->paginate['Ebook'] = array('limit' => 10, 'conditions' => array('Ebook.published' => true), 'order' => array('Ebook.title' => 'desc'));
		$ebooks = $this->paginate();
		$this->set('ebooks', $ebooks);
	}
	
	public function rate($value = null) {
		$this->Session->setFlash('rating');
		$this->autoRender = false; 
		$rate = floor($this->Ebook->field('rate')+$value)/2;
		if($this->RequestHandler->isAjax()){
			$this->Ebook->saveField('rate', $this->Ebook->field('rate')+1);
		}
	}
	
	public function beforeFilter(){
        parent::beforeFilter();
		$this->Uploader = new Uploader(array('tempDir' => TMP));
		$this->Uploader->setup(array('uploadDir' => 'img/uploads'));
    }
	
	/**
	 * Wrapper find to cache sql queries
	 * @param array $conditions
	 * @param array $fields
	 * @param string $order
	 * @param string $recursive
	 * @return array
	 */
	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
		if (Configure::read('Cache.disable') === false && Configure::read('Cache.check') === true && isset($fields['cache']) && $fields['cache'] !== false) {
			$key = $fields['cache'];
			$expires = '+1 hour';
			
			if (is_array($fields['cache'])) {
				$key = $fields['cache'][0];
				
				if (isset($fields['cache'][1])) {
					$expires = $fields['cache'][1];
				}
			}

			// Set cache settings
			Cache::config('sql_cache', array(
				'prefix' 	=> strtolower($this->name) .'-',
				'duration'	=> $expires
			));
			
			// Load from cache
			$results = Cache::read($key, 'sql_cache');
			
			if (!is_array($results)) {
				$results = parent::find($conditions, $fields, $order, $recursive);
				Cache::write($key, $results, 'sql_cache');
			}
			
			return $results;
		}
		
		// Not cacheing
		return parent::find($conditions, $fields, $order, $recursive);
	}
	// ADMIN ROUTING
	public function admin_index() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->Ebook->recursive = 0;
			$this->set('ebooks', $this->paginate());
		}
		else
			$this->redirect('/');
	}
	
	public function admin_view($id = null) {
		$this->Ebook->id = $id;
		$this->set('ebook',$this->Ebook->read());
	}
	
	public function admin_add() {
        if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('BookCategory');
			$categories = $this->BookCategory->find('list', array('fields' => array('BookCategory.id', 'BookCategory.name')));
			$this->set(compact('categories'));

			if ($this->request->is('post')) {
				$this->request->data['Ebook']['user_id'] = $this->Auth->user('id'); //Only logged in user can add new post
				if (!empty($this->request->data)) {
					if ($data = $this->Uploader->upload('cover', array('overwrite' => true))) {
						$this->request->data['Ebook']['cover'] = $data['name'];
						if ($this->Ebook->save($this->request->data)) {
							$this->Session->setFlash('Your ebook has been saved.', 'flash_success');
							$this->redirect(array('action' => 'index'));
						} else {
							$this->Session->setFlash('Unable to add new ebook.', 'flash_error');
						}
					}
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function admin_edit($id = null) {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('BookCategory');
			$categories = $this->BookCategory->find('list', array('fields' => array('BookCategory.id', 'BookCategory.name')));
			$this->set(compact('categories'));

			$this->Ebook->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Ebook->read();
			} else {
				if (!empty($this->request->data)) {
					if ($data = $this->Uploader->upload('cover', array('overwrite' => true))) {
						$this->request->data['Ebook']['cover'] = $data['name'];
					}
					if ($this->Ebook->save($this->request->data)) {
						$this->Session->setFlash('Your ebook has been updated.', 'flash_success');
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash('Unable to update your ebook.', 'flash_error');
					}
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function admin_delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Ebook->delete($id)) {
			$this->Session->setFlash('The ebook with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
}