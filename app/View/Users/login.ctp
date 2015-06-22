
    <div class="left_content">
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Đăng nhập</div>
        
        	<div class="feat_prod_box_details">
            <p class="details">Đăng nhập vào blog HOẶC chọn đăng ký nếu bạn chưa có tài khoản 
				<?php echo $this->Html->link('Đăng ký', array('action'=>'register', 'controller'=>'users'));?>.</p>
            
              	<div class="register_form">
                <div class="form_subtitle">Đăng nhập</div>
                    <?php
						echo $this->Session->flash('auth');
						echo $this->Form->create('User', array('action' => 'login'));
						echo $this->Form->input('username', array('label' => 'Bí danh'));
						echo $this->Form->input('password', array('label' => 'Mật khẩu'));
						echo $this->Form->end('Đăng nhập');
					?>
                </div>  
            
          </div>	
            
              

            

            
        <div class="clear"></div>
        </div><!--end of left content-->
        
        
