<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Danh mục sách
&raquo;
<small><?php echo $this->Html->link('A → Z', array('controller' => 'ebooks', 'action' => 'listaz', 1), array('class' => 'test')); ?></small>
</div>
<?php
	foreach($ebooks as $ebook):
		echo '<div class="feat_prod_box">';
		echo '<div class="prod_title">', $ebook['Ebook']['title'], '</div>';
		echo '<p class="details">', strip_tags($ebook['Ebook']['author']), '</p>';
		echo $this->Html->link('- chi tiết -', array('controller'=>'ebooks', 'action'=>'view', $ebook['Ebook']['id']), array('class' => 'more'));
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

