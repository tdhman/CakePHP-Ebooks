<?php
App::uses('CakeEmail', 'Network/Email');
class RequestsController extends AppController {
	public $name = 'Requests';
	public $components = array("Session", "Email");

	public function request() {
		if ( $this->request->is('post') ) {
			if(!empty($this->data)) {
				$this->Request->set($this->data);
 
				if($this->Request->validates()) {
					$this->Email->from = $this->data['Request']['name'] . ' <' . $this->data['Request']['email'] . '>';
					$this->Email->to = 'tdhman07@gmail.com';
					$this->Email->subject = 'Ebook Request';
					if ($this->Email->send($this->data['Request']['message']))
						$this->Session->setFlash('Yêu cầu của bạn đã được gửi.');
					else
						$this->Session->setFlash('Có lỗi xảy ra. Không thể gửi yêu cầu.');
				} else {
					$this->Session->setFlash('Lỗi: Thông tin nhập vào chưa đúng.');
				}
			}
			$this->redirect($this->referer());
		}
    }
}