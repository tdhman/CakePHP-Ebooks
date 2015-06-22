
	<?php echo $this->Session->flash(); ?>

	<?php
		echo $this->Session->flash('auth');
		echo $this->Form->create('User', array('action' => 'admin_login'));
		echo $this->Form->input('username', array('class' => 'text-input'));
		echo $this->Form->input('password', array('class' => 'text-input'));
		echo $this->Form->submit('Login', array('class' => 'button'));
		echo $this->Form->end();
	?>