<div class="content-box-header">
					
	<h3>Ebooks</h3>				
	<div class="clear"></div>
					
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
                <?php echo $this->Session->flash(); ?>
		<table>
			<thead><tr>
				<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
				<th><?php echo $this->Paginator->sort('title', 'Title'); ?></th> 
				<th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
				<th>Action</th>
			</tr></thead>
			<!-- Loop to print $ebook-->
			<tbody>
			<?php foreach ($ebooks as $ebook): ?>
			<tr>
				<td><?php echo $ebook['Ebook']['id']; ?></td>
				<td>
					<?php echo $this->Html->link($ebook['Ebook']['title'], array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id'])); ?>
				</td>
				<td><?php echo $ebook['Ebook']['created']; ?></td>
				<td>
                                        <?php echo $this->Html->link($this->Html->image('icons/open.png', array('alt' => 'Edit')), array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/pencil.png', array('alt' => 'Edit')), array('controller' => 'ebooks', 'action' => 'edit', $ebook['Ebook']['id']), array('escape' => false)); ?>
					<?php echo $this->Html->link($this->Html->image('icons/cross.png', array('alt' => 'Delete')), array('controller' => 'ebooks', 'action' => 'delete', $ebook['Ebook']['id']), array('escape' => false), "Are you sure to delete this ebook?");?>
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