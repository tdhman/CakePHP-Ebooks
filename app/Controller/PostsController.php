<?php
class PostsController extends AppController{

	public $name = 'Posts';
	
	public $helpers = array('Html', 'Form', 'Session','Paginator', 'Cksource', 'Cache');
	public $components = array('Session', 'Auth', 'RequestHandler');
	public $paginate = array( 'Post' => array('limit' => 5, 'order' => array('Post.created' => 'desc')),
						 'Ebook' => array('limit' => 5, 'order' => array('Ebook.created' => 'desc')));
	var $cacheAction = array('view' => array('callbacks' => true, 'duration' => '+1 week'));

	public function display() {
		$this->paginate['Post'] = array('limit' => 3, 'order' => array('Post.priority' => 'asc', 'Post.created' => 'desc'), 'conditions' => array('Post.published' => true));;
		$posts = $this->paginate();
        if(isset($this->params['requested'])) {
             return $posts;
        }
        $this->set('posts', $posts);
	}
	
	public function index() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('Ebook');
			$this->set('ebooks', $this->paginate('Ebook'));
			
			$this->Post->recursive = 0;
			$this->set('posts', $this->paginate('Post'));
		} else
			$this->redirect('/');
    }
	
	public function view($id = null) {
		$post = $this->Post->read(null, $id);
		if (!$post) {
			throw new NotFoundException("Bài viết không tồn tại.");
		}
		// separate rss stats, with custom field  
        if (isset($this->passedArgs['from']) && $this->passedArgs['from'] == 'rss')  
            $this->Post->hit($post['Post']['id'], array('hitField' => 'hitcount_rss'));  
        // regular hitcount  
		$this->Post->hit($post['Post']['id']);  
		$this->set(compact('post'));
	}
	
	public function add() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('PostCategory');
			$categories = $this->PostCategory->find('list', array('fields' => array('PostCategory.id', 'PostCategory.name')));
			$this->set(compact('categories'));
			
			if ($this->request->is('post')) {
				$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Only logged in user can add new post
				$result = $this->PostCategory->find('first', array('conditions' => array('PostCategory.id' => $this->request->data['Post']['post_category_id'])));
				$this->request->data['Post']['image'] = $result['PostCategory']['image'];
				if ($this->Post->save($this->request->data)) {
					$this->Session->setFlash('Your post has been saved.', 'flash_success');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Unable to add your post.', 'flash_error');
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function edit($id = null) {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->loadModel('PostCategory');
			$categories = $this->PostCategory->find('list', array('fields' => array('PostCategory.id', 'PostCategory.name')));
			$this->set(compact('categories'));
			$this->Post->id = $id;
			
			if ($this->request->is('get')) {
				$this->request->data = $this->Post->read();
			} else {
				$result = $this->PostCategory->find('first', array('conditions' => array('PostCategory.id' => $this->request->data['Post']['post_category_id'])));
				$this->request->data['Post']['image'] = $result['PostCategory']['image'];
				if ($this->Post->save($this->request->data)) {
					$this->Session->setFlash('Your post has been updated.', 'flash_success');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash('Unable to update your post.', 'flash_error');
				}
			}
		} else
			$this->redirect('/');
    }
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	public function latest() {
		$posts = $this->Post->find('all', array('Post.published' => true, 'order' => 'Post.created DESC', 'limit' => 10));
		if (!empty($this->params['requested'])) {
		return $posts;
		} else {
		$this->set(compact('posts'));
		}
	}
	
	// Only authorized user can add/edit/delete post
	public function isAuthorized($user) {
		// All registered users can add posts
		if ($this->action === 'add') {
			return true;
		}

		// The owner of a post can edit and delete it
		if (in_array($this->action, array('edit', 'delete'))) {
			$postId = $this->request->params['pass'][0];
			if ($this->Post->isOwnedBy($postId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}
	
	/*public function beforeFilter(){   
        $this->Auth->userModel = 'User';   
        $this->Auth->allow(array('index', 'view'));   
    }*/   
	
	// ADMIN ROUTING
	public function admin_index() {
		$this->Post->recursive = 0;
        $this->set('posts', $this->paginate());
	}
	
	public function admin_view($id = null) {
		$this->Post->id = $id;
		$this->set('post',$this->Post->read());
	}
	
	public function admin_add() {
        if ($this->request->is('post')) {
			$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Only logged in user can add new post
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }
	
	public function admin_edit($id = null) {
		$this->Post->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Post->read();
		} else {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update your post.');
			}
		}
    }
	
	public function admin_delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
}