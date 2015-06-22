<div class="content-box-header">
	<h3>Add a new User</h3>
	<div class="clear"></div>
</div> <!-- End .content-box-header -->

<div class="content-box-content">
	<div class="tab-content default-tab" id="tab1">
		<?php echo $this->Session->flash(); ?>
		<?php
		echo $this->Form->create('User');
		echo $this->Form->input('name', array('class' => 'text-input medium-input'));
		echo $this->Form->input('username', array('class' => 'text-input medium-input'));
		echo $this->Form->input('password', array('label' => 'Current password', 'class' => 'text-input medium-input'));
		echo $this->Form->input('password_tmp', array('label' => 'New password', 'type' => 'password', 'value' => '', 'class' => 'text-input medium-input'));
		echo $this->Form->input('email', array('class' => 'text-input medium-input'));
		echo $this->Form->end('Add new');
		?>
	</div> <!-- End #tab1 -->
</div>