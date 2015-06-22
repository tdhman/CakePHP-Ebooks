<?php
$messages = $this->requestAction('messages/display/sort:created/direction:desc');

echo '<h3>', count($messages) ,' Messages</h3>';
if (count($messages) > 0){
	foreach($messages as $message):
		echo '<p><strong>', $this->Time->niceShort($message['Message']['created']), '</strong> by ', $message['Message']['name'], '<br/>', $message['Message']['content'];
		echo '<br/><small>', $message['Message']['email'], '</small>';
		echo '<small> ', $this->Html->link('Reply', array('controller'=>'messages', 'action'=>'reply', $message['Message']['id']), array('class' => 'remove-link')), '</small>';
		echo '</p>';
	endforeach; 
}
