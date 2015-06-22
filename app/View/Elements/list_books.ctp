<?php
$ebooks = $this->requestAction('/ebooks/show/sort:created/direction:desc/limit:5');
?>

<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>List of ebooks
&gt;&gt;
<small><?php echo $this->Html->link('Add Ebook', array('controller' => 'ebooks', 'action' => 'add')); ?></small>
</div>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
		<th><?php echo $this->Paginator->sort('title', 'Title'); ?></th> 
		<th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
		<th>Action</th>
	</tr>
	<!-- Loop to print $ebook-->
	<?php foreach ($ebooks as $ebook): ?>
	<tr>
		<td><?php echo $ebook['Ebook']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($ebook['Ebook']['title'], array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id'])); ?>
		</td>
		<td><?php echo $ebook['Ebook']['created']; ?></td>
		<td>
			<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $ebook['Ebook']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $ebook['Ebook']['id'])); ?>
			<?php echo $this->Html->link('View', array('action' => 'view', $ebook['Ebook']['id'])); ?>
        </td>
	</tr>
	<?php endforeach; ?>
</table>

    <!-- Shows the page numbers -->
	<div style="display: block; padding:5px 0px 20px 10px;">
	<?php echo $this->Paginator->numbers(); ?>
	</div>