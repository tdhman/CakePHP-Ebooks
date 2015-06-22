            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Thông báo</div>
			
			<?php
				foreach($posts as $post):
					echo '<div class="feat_prod_box">';
					echo '<div class="prod_img">', $this->Html->image($post['Post']['image'], array('alt' => '', 'border' => '0', 'class' => 'post')), '</div>';
					echo '<div class="prod_det_box">';
					echo '<div class="box_top"></div>';
					echo '<div class="box_center">';
					echo '<div class="prod_title">', $post['Post']['title'], '</div>';
					echo '<p class="details">', String::truncate(strip_tags($post['Post']['body']), 100, array('ending' => '...', 'exact' => false)), '</p>';
					echo $this->Html->link('- chi tiết -', array('controller'=>'posts', 'action'=>'view', $post['Post']['id']), array('class' => 'more'));
					echo '<div class="clear"></div>';
					echo '</div>';
					echo '<div class="box_bottom"></div>';
					echo '</div>';
					echo '<div class="clear"></div>';
					echo '</div>';
				endforeach; 
			?>

			<div class="pagination">
				<?php echo $this->Paginator->prev('« Trước', null, null, array('class' => 'disabled')); ?>
				<?php echo $this->Paginator->numbers(array('modulus'=>3)); ?>
				<?php echo $this->Paginator->next('Tiếp »', null, null, array('class' => 'disabled')); ?> 
            </div>
		
		<div class="title">
			<span class="title_icon"><?php echo $this->Html->image('bullet2.gif', array('alt' => '')); ?></span>Sách mới &raquo;
			<small><?php echo $this->Html->link('Xem', array('controller' => 'ebooks', 'action' => 'newbook')); ?></small>
		</div> 
           
           <div class="new_products">
                  <ul id="mycarousel" class="jcarousel-skin-tango">
                     <?php echo $this->element('latest_books', array('cache'=>'+1 day'));?>
                  </ul>
            </div> 
    