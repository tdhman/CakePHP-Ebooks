<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Blog's Posts
<br/>
<?php echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' => 'add')); ?>
</div>
<?php
$posts = $this->requestAction('/posts/show');
?>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
		<th><?php echo $this->Paginator->sort('title', 'Title'); ?></th> 
		<th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
		<th>Action</th>
	</tr>
	<!-- Loop to print $post-->
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($post['Post']['title'], array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
		</td>
		<td><?php echo $post['Post']['created']; ?></td>
		<td>
			<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
            <?php echo $this->Html->link('View', array('action' => 'view', $post['Post']['id'])); ?>
        </td>
	</tr>
	<?php endforeach; ?>
</table>

    <!-- Shows the page numbers -->
    <?php echo $this->Paginator->numbers(); ?>
	
    <!-- Shows the next and previous links -->
    <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
