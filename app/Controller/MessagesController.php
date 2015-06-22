<?php
class MessagesController extends AppController {
	public $name = 'Messages';
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session', 'RequestHandler', 'Email');
	
	public function request() {
		if ( $this->request->is('post') ) {
			if(!empty($this->data)) {
				if ($this->Message->save($this->request->data)) {
						$this->Session->setFlash('Đã gửi lời nhắn.');
				} else {
						$this->Session->setFlash('Lỗi: Không thể gửi lời nhắn.');
				}
			}
			$this->redirect($this->referer());
		}
    }
	
	public function display() {
		$messages = $this->Message->find('all', array('conditions' => array('Message.checked' => false)));
		// Update unread message to read
		//$this->Message->updateAll(array('Message.checked' => true));
		if (!empty($this->params['requested'])) {
			return $messages;
		} else {
			$this->set(compact('messages'));
		}
	}
	
	public function reply($id = null) {
		$message = $this->Message->read(null,$id);
		$this->set(compact('message'));
		// Set unread message to read
		$this->Message->id = $id;
		$this->Message->saveField('checked', true);
		// Send reply email
		/*$this->Email->to = $message['Message']['email'];
		$this->Email->subject = 'Reply from Ebook-lists.tk';
		$this->Email->from = 'Ebook-lists.tk <request@ebook-lists.tk>';
		$this->Email->template = 'default';
		$this->Email->sendAs = 'html';
		$this->Email->smtpOptions = array(
			'port'=>'465',
			'timeout'=>'30',
			'auth' => true,
			'host' => 'ssl://smtp.gmail.com',
			'username'=>'tdhman07@gmail.com',
			'password'=>'tdhman1912',
		);
		$this->Email->delivery = 'smtp';
		if ($this->Email->send('Reply message...')) {
			// Set unread message to read
			$this->Message->id = $id;
			$this->Message->saveField('checked', true);
			echo 'Your message has been sent.';
		} else {
			echo $this->Email->smtpError;
		}*/
		
		$this->redirect($this->referer());
	}
}