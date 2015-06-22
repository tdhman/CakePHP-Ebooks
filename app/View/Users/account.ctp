
	<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet6.gif', array('alt' => '')); ?></span>Tài khoản của bạn</div>

     <div class="feat_prod_box_details">
        <div class="register_form">
                <div class="form_subtitle">Thông tin</div>
					<?php
					echo $this->Form->create('User');
					echo $this->Form->input('name');
					echo $this->Form->input('username', array('disabled' => 'disabled'));
					echo $this->Form->input('password_tmp', array('label' => 'New password', 'type' => 'password', 'value' => ''));
					echo $this->Form->input('email');
					echo $this->Form->submit('Update', array('after' => $this->Html->link('Cancel', array('controller' => 'users', 'action' => 'view', $user['id']))));
					echo $this->Form->end();
					?>
				</div>  
          </div>

    <div class="clear"></div>
