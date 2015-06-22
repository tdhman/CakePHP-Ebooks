
        	
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Các loại sách
			&raquo;
			<small><?php echo $this->Html->link('A → Z', array('controller' => 'ebooks', 'action' => 'listaz', 1)); ?></small>
			</div>
			<?php
				foreach($ebooks as $ebook):
					echo '<div class="feat_prod_box">';
					echo '<div class="prod_img">', $this->Html->image('uploads/'.$ebook['Ebook']['cover'], array('alt' => '', 'border' => '0', 'class' => 'thumbs', 'onerror' => "this.src = '../img/prod1.gif'")), '</div>';
					echo '<div class="prod_det_box">';
					echo '<div class="box_top"></div>';
					echo '<div class="box_center">';
					echo '<div class="prod_title">', $ebook['Ebook']['title'], '</div>';
					echo '<p class="details">', String::truncate(strip_tags($ebook['Ebook']['abstract']), 200, array('ending' => '...', 'exact' => false)), '</p>';
					echo $this->Html->link('- chi tiết -', array('controller'=>'ebooks', 'action'=>'view', $ebook['Ebook']['id']), array('class' => 'more'));
					echo '<div class="clear"></div>';
					echo '</div>';
					echo '<div class="box_bottom"></div>';
					echo '</div>';
					echo '<div class="clear"></div>';
					echo '</div>';
				endforeach; 
			?>

			<div class="pagination">
				<?php echo $this->Paginator->first('« Trang đầu');?>
				<?php echo $this->Paginator->prev('« Trước', null, null, array('class' => 'disabled')); ?>
				<?php echo $this->Paginator->numbers(array('modulus'=>3)); ?>
				<?php echo $this->Paginator->next('Tiếp »', null, null, array('class' => 'disabled')); ?> 
				<?php echo $this->Paginator->last('Trang cuối »');?>
            </div>   
    
        

