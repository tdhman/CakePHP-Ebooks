
        	
            <div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Các loại sách</div>
			
			<?php
				foreach($books as $book):
					echo '<div class="feat_prod_box">';
					echo '<div class="prod_img">', $this->Html->image($book['Book']['cover'], array('alt' => '', 'border' => '0', 'class' => 'thumbs', 'onerror' => "this.src = '../img/prod1.gif'")), '</div>';
					echo '<div class="prod_det_box">';
					echo '<div class="box_top"></div>';
					echo '<div class="box_center">';
					echo '<div class="prod_title">', $book['Book']['title'], '</div>';
					echo '<p class="details">', String::truncate(strip_tags($book['Book']['abstract']), 100, array('ending' => '...', 'exact' => false)), '</p>';
					echo $this->Html->link('- chi tiết -', array('controller'=>'books', 'action'=>'view', $book['Book']['id']), array('class' => 'more'));
					echo '<div class="clear"></div>';
					echo '</div>';
					echo '<div class="box_bottom"></div>';
					echo '</div>';
					echo '<div class="clear"></div>';
					echo '</div>';
				endforeach; 
			?>

			<div class="pagination">
				<?php echo $this->Paginator->numbers(); ?>
            </div>   
    
        

