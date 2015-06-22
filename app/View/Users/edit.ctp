<?php
echo $this->Form->create('User');
echo $this->Form->input('name');
echo $this->Form->input('username', array('disabled' => 'disabled'));
//echo $this->Form->input('password', array('disabled' => 'disabled', 'label' => 'Current password'));
echo $this->Form->input('password_tmp', array('label' => 'New password', 'type' => 'password', 'value' => ''));
echo $this->Form->input('email');
echo $this->Form->end('Update');
?>