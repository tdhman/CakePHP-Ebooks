<div class="content">
<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>List of books
<br/>
<?php echo $this->Html->link('Add Book', array('controller' => 'books', 'action' => 'add')); ?>
</div>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
		<th><?php echo $this->Paginator->sort('title', 'Title'); ?></th> 
		<th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
		<th>Action</th>
	</tr>
	<!-- Loop to print $book-->
	<?php foreach ($books as $book): ?>
	<tr>
		<td><?php echo $book['Book']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($book['Book']['title'], array('controller' => 'books', 'action' => 'view', $book['Book']['id'])); ?>
		</td>
		<td><?php echo $book['Book']['created']; ?></td>
		<td>
			<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $book['Book']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $book['Book']['id'])); ?>
            <?php echo $this->Html->link('View', array('action' => 'view', $book['Book']['id'])); ?>
        </td>
	</tr>
	<?php endforeach; ?>
</table>

    <!-- Shows the page numbers -->
    <?php echo $this->Paginator->numbers(); ?>
	
    <!-- Shows the next and previous links -->
    <?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?>
	
    <!-- prints X of Y, where X is current page and Y is number of pages -->
    <!--<?php echo $this->Paginator->counter(); ?>-->
    <!--<?php
    echo $this->Paginator->counter(array(
    'format' => 'Page %page% of %pages%, showing %current% records out of
    %count% total, starting on record %start%, ending on %end%'
    ));
    ?>-->

</div>