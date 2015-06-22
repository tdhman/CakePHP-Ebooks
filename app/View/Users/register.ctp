<div class="left_content">
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Đăng ký</div>
        
        	<div class="feat_prod_box_details">
            <p class="details">Đăng ký email để nhận thông tin cập nhật mới trên blog.</p>
            
              	<div class="register_form">
                <div class="form_subtitle">Đăng ký tài khoản mới</div>
                    <?php
					echo $this->Form->create('User', array('action' => 'register'));
					echo $this->Form->input('name', array('label' => 'Tên'));
					echo $this->Form->input('email', array('label' => 'Email'));
					echo $this->Form->input('username', array('label' => 'Bí danh'));
					echo $this->Form->input('password', array('label' => 'Mật khẩu'));
					echo $this->Form->input('password_tmp', array('type' => 'password', 'label' => 'Nhập lại mật khẩu'));
					echo '<div id="mc">'.
					'<p>Vẽ lại hình bên dưới để xác nhận: (<a onclick="window.location.reload()" href="#" title="Hình mới">thay hình khác</a>)</p>'.
					'<canvas class="triangle" height="154" width="220" id="mc-canvas">'.
						'Trình duyệt không hỗ trợ. Cập nhật phiên bản mới hơn hoặc dùng trình duyệt khác'.
					'</canvas>'.
					'<input id="mc-action" value="" type="hidden">'.
					'</div>';
					echo $this->Form->Submit('Đăng kí', array('disabled' => 'disabled', 'id' => 'submit'));
					echo $this->Form->end();
					?>
                </div>  
            
          </div>	
        <div class="clear"></div>
    </div><!--end of left content-->