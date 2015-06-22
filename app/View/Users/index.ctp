<div class="content-box-header">
					
	<h3>List of Users</h3>				
	<div class="clear"></div>
					
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
		<table>
			<thead><tr>
				<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
				<th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
				<th><?php echo $this->Paginator->sort('role', 'Role'); ?></th>
				<th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
				<th>Action</th>
			</tr></thead>
			<tbody>
			<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
				<td><?php echo $user['User']['username']; ?></td>
				<td><?php if ($user['User']['role'] == 1)
							echo 'admin';
						  else
							echo 'member';
					?></td>
				<td><?php echo $user['User']['created']; ?></td>
				<td>
                                        <?php echo $this->Html->link($this->Html->image('icons/user.png', array('alt' => 'Edit')), array('controller' => 'users', 'action' => 'view', $user['User']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/pencil.png', array('alt' => 'Edit')), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/cross.png', array('alt' => 'Delete')), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('escape' => false), "Are you sure to delete this user?");?>
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