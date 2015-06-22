<div class="content-box-header">				
	<h3>Posts</h3>
	<div class="clear"></div>			
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
        <?php echo $this->Session->flash(); ?>
		<table>
			<thead><tr>
				<th><?php echo $this->Paginator->sort('id', 'ID', array('model'=>'Post')); ?></th>
				<th><?php echo $this->Paginator->sort('title', 'Title', array('model'=>'Post')); ?></th> 
				<th><?php echo $this->Paginator->sort('hitcount', 'Hits', array('model'=>'Post')); ?></th> 
				<th><?php echo $this->Paginator->sort('created', 'Created', array('model'=>'Post')); ?></th>
				<th>Action</th>
			</tr></thead>
			
			<tbody>
			<?php foreach ($posts as $post): ?>
			<tr>
				<td><?php echo $post['Post']['id']; ?></td>
				<td>
					<?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
				</td>
				<td><?php echo $post['Post']['hitcount']; ?></td>
				<td><?php echo $post['Post']['created']; ?></td>
				<td>
					<?php echo $this->Html->link($this->Html->image('icons/open.png', array('alt' => 'View')), array('controller' => 'posts', 'action' => 'view', $post['Post']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/pencil.png', array('alt' => 'Edit')), array('controller' => 'posts', 'action' => 'edit', $post['Post']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/cross.png', array('alt' => 'Delete')), array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']), array('escape' => false), "Are you sure to delete this post?");?>
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
</div> <!-- End .content-box-content -->