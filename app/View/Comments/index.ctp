<div class="content-box-header">
					
	<h3>Comments</h3>				
	<div class="clear"></div>
					
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
		<table>
			<thead><tr>
				<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
				<th><?php echo $this->Paginator->sort('comment_author', 'Comment Author'); ?></th>
				<th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
				<th>Action</th>
			</tr></thead>
			<tbody>
			<?php foreach ($comments as $comment): ?>
			<tr>
				<td><?php echo $comment['Comment']['id']; ?></td>
				<td><?php echo $comment['Comment']['comment_author']; ?></td>
				<td><?php echo $comment['Comment']['created']; ?></td>
				<td>
					<?php echo $this->Html->link($this->Html->image('icons/comment.png', array('alt' => 'View')), array('controller' => 'ebooks', 'action' => 'view', $comment['Comment']['ebook_id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/pencil.png', array('alt' => 'Edit')), array('controller' => 'comments', 'action' => 'edit', $comment['Comment']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/cross.png', array('alt' => 'Delete')), array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), array('escape' => false), "Are you sure to delete this comment?");?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<div class="pagination">
			<?php echo $this->Paginator->first('First');?>
			<?php echo $this->Paginator->prev('Previous', null, null, array('class' => 'disabled')); ?>
			<?php echo $this->Paginator->numbers(array('modulus'=>3)); ?>
			<?php echo $this->Paginator->next('Next', null, null, array('class' => 'disabled')); ?> 
			<?php echo $this->Paginator->last('Last');?>
		</div> <!-- End .pagination -->
		<div class="clear"></div>
	</div> <!-- End #tab1 -->
</div>