       <div class="crumb_nav">
            <?php echo $this->Html->link('Sách', array('controller' => 'ebooks', 'action' => 'display')); ?> &raquo;
			<?php echo h($ebook['Ebook']['title']); ?>
            </div>
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet3.gif', array('alt' => '')); ?></span><?php echo h($ebook['Ebook']['title']); ?></div>
        
        	<div class="feat_prod_box_details">
            	<div class="prod_img"><?php echo $this->Html->image('uploads/'.$ebook['Ebook']['cover'], array('alt' => '', 'border' => '0', 'class' => 'thumbs', 'onerror' => array("this.src = '../img/uploads/NoCover.jpg'"))); ?>
                <br /><br />
				<?php echo $this->Form->input('rating', array('type' => 'select', 'label' => false, 'disabled' => 'disabled', 'class' => 'rating', 'options' => array('1','2','3','4','5'), 'default' => $ebook['Ebook']['rating']));?>
                </div>
                
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title">Thông tin 
						<small><!--nocache--><?php
							if ($this->Session->read('Auth.User')){
								if ($role == 1) {
									echo ' » ', $this->Html->link('Edit', array('controller' => 'ebooks', 'action' => 'edit',$ebook['Ebook']['id']));
								}
							}
						?><!--/nocache--></small>
					</div>
                    <p class="details"><strong>Tác giả:</strong> <?php echo strip_tags($ebook['Ebook']['author']); ?></p>
					<p class="details"><strong>Chuyển ngữ:</strong> <?php echo strip_tags($ebook['Ebook']['editor']); ?></p>
					<p class="details"><strong>Thể loại:</strong> <?php echo strip_tags($ebook['Ebook']['genre']); ?></p>
					<?php if(strlen($ebook['Ebook']['source']) !== 0)
						echo '<p class="details"><strong>Nguồn:</strong>&nbsp;&raquo;&nbsp;', $this->Html->link('Xem', strip_tags($ebook['Ebook']['source'])), '</p>';
					?>
					<p class="details">---</p>
					<div class="price"><strong>NXB:</strong> <span class="red"><?php echo strip_tags($ebook['Ebook']['publisher']); ?></span></div>
                    <div class="price"><strong>Giá:</strong> <span class="red"><?php echo strip_tags($ebook['Ebook']['price']); ?>đ</span></div>
					<p class="details">
						<!--nocache--><?php if(strlen($ebook['Ebook']['link']) !== 0)
							//if ($this->Session->read('Auth.User'))
								if (!$ebook['Ebook']['protected'])
									echo $this->Html->link('Download ebook', $ebook['Ebook']['link']);
								else
									echo '<strong>Link tải ebook đã bị khóa</strong>';
							//else
							//	echo '<strong>Bạn không có quyền xem link này</strong>&nbsp&nbsp&raquo;&nbsp', $this->Html->link('Đăng ký', array('action'=>'register', 'controller'=>'users'));
						?><!--/nocache--> 
					</p>
                    <div class="clear"></div>
                    </div>
                    
                    <div class="box_bottom"></div>
                </div>    
            <div class="clear"></div>
            </div>
		<div id="demo" class="demolayout">

                <ul id="demo-nav" class="demolayout">
					<li><a class="active" href="#tab1">Giới thiệu</a></li>
					<li><a class="" href="#tab2">Nhận xét</a></li>
                </ul>
    
            <div class="tabs-container">
            
                <div style="display: block; padding:25px 20px 0px 20px; font-size:11px;" class="tab" id="tab1">
					<?php echo $ebook['Ebook']['abstract']; ?>
                </div>
                    
                <div style="display: none;" class="tab" id="tab2">
					<!--nocache--><?php if(empty($comments)) {
						echo '<p class="details">Chưa có nhận xét nào cho tác phẩm này.</p>';
					} else {
						foreach($comments as $comment):
							echo '<div class="feat_prod_box">';
							echo '<div class="prod_title">', $comment['Comment']['comment_author'], '</div>';
							echo '<p class="more">&nbsp&nbsp', $this->Time->niceShort($comment['Comment']['created']), '</p>';
							echo '<p class="comment">', strip_tags($comment['Comment']['comment_content']), '</p>';
							echo $this->Html->link('- phản hồi -', array('controller'=>'comments', 'action'=>'reply', $comment['Comment']['id']), array('class' => 'reply'));
							echo '<div class="clear"></div>';
							echo '</div>';
						endforeach;
					}
					?><!--/nocache-->
					<div class="pagination">
						<?php echo $this->Paginator->prev('« Trước', null, null, array('class' => 'disabled')); ?>
						<?php echo $this->Paginator->numbers(array('modulus'=>3)); ?>
						<?php echo $this->Paginator->next('Tiếp »', null, null, array('class' => 'disabled')); ?> 
					</div>  

					<div class="register_form" title="Click vào để gửi nhận xét">
						<div class="form_subtitle">Gửi nhận xét &raquo; Click here</div>
						<!--nocache--><?php if ($this->Session->read('Auth.User')) {
							echo $this->Form->create('Comment', array('url' => '/comments/post/'.$ebook['Ebook']['id']));
							echo $this->Form->input('comment_author', array('label' => 'Tên', 'type' => 'hidden', 'value' => $user['name']));
							echo $this->Form->input('comment_author_email', array('label' => 'Email', 'type' => 'hidden', 'value' => $user['email']));
							echo $this->Form->input('comment_content', array('label' => 'Nội dung'));
							echo $this->Form->end('Gửi');
							echo '<p class="comment_details">', $user['name'], ', bạn có thể gửi nhận xét tại đây.</p>';
							} else {
								echo $this->Form->create('Comment', array('url' => '/comments/post/'.$ebook['Ebook']['id']));
								echo $this->Form->input('comment_author', array('label' => 'Tên'));
								echo $this->Form->input('comment_author_email', array('label' => 'Email'));
								echo $this->Form->input('comment_content', array('label' => 'Nội dung'));
								echo $this->Form->end('Gửi');
								echo '<p class="comment_details">Không yêu cầu đăng ký tài khoản.</p>';
								echo '<p class="comment_details">Nếu bạn đã tạo tài khoản, đăng nhập tại đây.&nbsp&nbsp&raquo;&nbsp', $this->Html->link('Đăng nhập', array('action'=>'login', 'controller'=>'users')), '</p>';
							}
						?><!--/nocache--> 
					</div>
					<!-- reply form -->
					<div id="basic-modal-content">
						<h3>Phản hồi nhận xét</h3>
						<!--nocache--><?php 
							if ($this->Session->read('Auth.User')) {
							echo $this->Form->create('Comment');
							echo $this->Form->input('comment_author', array('label' => 'Tên', 'type' => 'hidden', 'value' => $user['name']));
							echo $this->Form->input('comment_author_email', array('label' => 'Email', 'type' => 'hidden', 'value' => $user['email']));
							echo $this->Form->input('comment_content', array('label' => 'Nội dung'));
							echo $this->Form->submit('Gửi', array('class' => 'submit1'));
							echo $this->Form->end();
							} else {
								echo $this->Form->create('Comment');
								echo $this->Form->input('comment_author', array('label' => 'Tên'));
								echo $this->Form->input('comment_author_email', array('label' => 'Email'));
								echo $this->Form->input('comment_content', array('label' => 'Nội dung'));
								echo $this->Form->submit('Gửi', array('class' => 'submit1'));
								echo $this->Form->end();
								echo '<p class="details">Nếu bạn đã tạo tài khoản, đăng nhập tại đây.&nbsp&nbsp&raquo;&nbsp', $this->Html->link('Đăng nhập', array('action'=>'login', 'controller'=>'users')), '</p>';
								echo '<br/>';
							}
						?><!--/nocache-->
					</div>
                    <div class="clear"></div>
				</div>
            
            </div>
	</div>