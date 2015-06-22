          <div class="crumb_nav">
            <?php echo $this->Html->link('Trang chủ', array('controller' => 'posts', 'action' => 'display')); ?> &raquo;
			<?php echo h($post['Post']['title']); ?>
            </div>
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span><?php echo h($post['Post']['title']); ?></div>
        
        	<div class="feat_prod_box_details">
            
            	<div class="prod_img"><?php echo $this->Html->image($post['Post']['image'], array('alt' => '', 'border' => '0')); ?>
                <br /><br />
                </div>
                
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title">Thông tin
						<small><!--nocache--><?php
							if ($this->Session->read('Auth.User')){
								if ($role == 1) {
									echo ' » ', $this->Html->link('Edit', array('controller' => 'posts', 'action' => 'edit',$post['Post']['id']));
								}
							}
						?><!--/nocache--></small>
					</div>
					<p class="details">Người gửi: Chủ nhà</p>
                    <p class="details">Ngày gửi: <?php echo $post['Post']['created']; ?></p>
					<p class="details">Chỉnh sửa lần cuối: <?php echo $post['Post']['modified']; ?></p>
                    <div class="clear"></div>
                    </div>
                    
                    <div class="box_bottom"></div>
                </div>    
            <div class="clear"></div>
            </div>
		<div id="demo" class="demolayout">

                <ul id="demo-nav" class="demolayout">
                <li><a class="active" href="#tab1">Nội dung</a></li>
                </ul>
    
            <div class="tabs-container">
            
                <div style="display: block; padding:25px 20px 0px 20px; font-size:11px;" class="tab" id="tab1">
					<?php echo $post['Post']['body']; ?>
					<p class="details"><!--nocache--><?php if(strlen($post['Post']['secret_link']) !== 0)
							if ($this->Session->read('Auth.User'))
								echo $this->Html->link($post['Post']['secret_link']);
							else
								echo '<strong>Bạn không có quyền xem link này</strong>&nbsp&nbsp&raquo;&nbsp', $this->Html->link('Đăng ký', array('action'=>'register', 'controller'=>'users'));
					?><!--/nocache--></p>
                </div>
                    
                <div style="display: none;" class="tab" id="tab2">
                    <div class="clear"></div>
				</div>
            
            </div>
	</div>
        