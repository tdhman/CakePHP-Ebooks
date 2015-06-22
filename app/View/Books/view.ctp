        <div class="crumb_nav">
            <?php echo $this->Html->link('Sách', array('controller' => 'books', 'action' => 'display')); ?> &raquo;
			<?php echo h($book['Book']['title']); ?>
            </div>
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span><?php echo h($book['Book']['title']); ?></div>
        
        	<div class="feat_prod_box_details">
            	<div class="prod_img"><?php echo $this->Html->image($book['Book']['cover'], array('alt' => '', 'border' => '0', 'class' => 'thumbs', 'onerror' => array("this.src = '../img/prod1.gif'"))); ?>
                <br /><br />
				<?php echo $this->Form->input('rating', array('type' => 'select', 'label' => false, 'class' => 'rating', 'options' => array('1','2','3','4','5'), 'default' => $book['Book']['rating']));?>
                </div>
                
                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title">Giới thiệu</div>
                    <p class="details"><strong>Tác giả:</strong> <?php echo strip_tags($book['Book']['author']); ?></p>
					<p class="details"><strong>Chuyển ngữ:</strong> <?php echo strip_tags($book['Book']['editor']); ?></p>
					<p class="details"><strong>Thể loại:</strong> <?php echo strip_tags($book['Book']['genre']); ?></p>
					<p class="details">---</p>
					<div class="price"><strong>NXB:</strong> <span class="red"><?php echo strip_tags($book['Book']['publisher']); ?></span></div>
                    <div class="price"><strong>Giá:</strong> <span class="red"><?php echo strip_tags($book['Book']['price']); ?>đ</span></div>
					<p class="details"><?php if(strlen($book['Book']['link']) !== 0)
							if ($this->Session->read('Auth.User'))
								echo $this->Html->link('Download ebook', $book['Book']['link']);
							else
								echo '<strong>Bạn không có quyền xem link này</strong>&nbsp&nbsp&raquo;&nbsp', $this->Html->link('Đăng ký', array('action'=>'register', 'controller'=>'users')); ?></p>
                    <div class="clear"></div>
                    </div>
                    
                    <div class="box_bottom"></div>
                </div>    
            <div class="clear"></div>
            </div>
		<div id="demo" class="demolayout">

                <ul id="demo-nav" class="demolayout">
                <li><a class="active" href="#tab1">Giới thiệu</a></li>
                <li><a class="" href="#tab2">Sách tương tự</a></li>
                </ul>
    
            <div class="tabs-container">
            
                <div style="display: block; padding:25px 20px 0px 20px; font-size:11px;" class="tab" id="tab1">
					<?php echo $book['Book']['abstract']; ?>
                </div>
                    
                <div style="display: none;" class="tab" id="tab2">
					<p>Test</p>
                    <div class="clear"></div>
				</div>
            
            </div>
	</div>