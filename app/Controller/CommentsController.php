<?php
class CommentsController extends AppController{
	public $name = 'Comments';
	
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	public $paginate = array('Comment' => array('limit' => 15, 'order' => array('Comment.created' => 'desc')));

	public function view($id = null) {
		$this->Comment->comment_id = $id;
		$this->set('comment',$this->Comment->read());
	}
	
	public function index() {
		if ($this->Auth->user('role') == '1'){
			$this->layout = "admin_default";
			$this->Comment->recursive = 0;
			$this->set('comments', $this->paginate());
		}
		else
			$this->redirect('/');
	}
	
	public function post($id = null) {
		if ($this->request->is('post')) {
			$this->Comment->set(array('ebook_id'=>$id));
			if($this->Auth->user('id'))
				$this->request->data['Comment']['user_id'] = $this->Auth->user('id'); //Logged in user can add new comment
			else
				$this->request->data['Comment']['user_id'] = 0; // Guest can add comment too
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash('Nhận xét của bạn đã gửi.');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Unable to add your comment.');
			}
		}
	}
	
	public function reply($id = null) {
		if ($this->request->is('post')) {
			$this->Comment->set(array('comment_parent'=>$id));
			$comment = $this->Comment->find('first', array('conditions' => array('Comment.id' => $id)));
			$this->Comment->set(array('ebook_id'=> $comment['Comment']['ebook_id']));
			if($this->Auth->user('id'))
				$this->request->data['Comment']['user_id'] = $this->Auth->user('id'); 
			else
				$this->request->data['Comment']['user_id'] = 0;
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash('Nhận xét của bạn đã gửi.');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Có lỗi xảy ra. Không thể gửi nhận xét.');
			}
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash('The comment with id: ' . $id . ' has been deleted.');
			$this->redirect($this->referer());
		}
	}
	
	public function latest() {
		$comments = $this->Comment->find('all', array('order' => 'Comment.created DESC', 'limit' => 10));
		if (!empty($this->params['requested'])) {
		return $comments;
		} else {
		$this->set(compact('comments'));
		}
	}
}