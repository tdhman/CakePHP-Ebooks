<div class="content-box-header">
					
	<h3>List of Users</h3>				
	<div class="clear"></div>
					
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
	
	<form action="#">
		<fieldset>
			<input type="text" name="search" value="" id="id_search" placeholder="Search" autofocus />
		</fieldset>
	</form>
	
	<table id="table_example">
		<thead>
			<tr>
				<th>Username</th> 
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td>
					<?php echo $this->Html->link($user['User']['username'], array('controller' => 'users', 'action' => 'account', $user['User']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($this->Html->image('icons/user.png', array('alt' => 'Edit')), array('controller' => 'users', 'action' => 'view', $user['User']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/pencil.png', array('alt' => 'Edit')), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/cross.png', array('alt' => 'Delete')), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), array('escape' => false), "Are you sure to delete this user?");?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>  
 	<div class="clear"></div>
	</div> <!-- End #tab1 -->
</div>   
        

