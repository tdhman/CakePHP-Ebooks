<div class="content-box-header">
					
<h3>Add a new Ebook</h3>

	<div class="clear"></div>
					
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
		<?php
		echo $this->cksource->create('Ebook', array('type' => 'file'));
		echo $this->cksource->input('title', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('author', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('editor', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('source', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('genre', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('rating', array('type' => 'select', 'class' => 'rating', 'options' => array('1','2','3','4','5'), 'default' => '0'));
		echo $this->cksource->input('book_category_id', array('type' => 'select', 'class' => 'small-input', 'options' => $categories, 'empty'   => false));
		echo $this->cksource->ckeditor('abstract',array('escape' => false));
		echo $this->cksource->input('cover', array('type' => 'file', 'class' => 'text-input medium-input'));
		echo $this->cksource->input('publisher', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('published_date', array('type' => 'date', 'dateFormat' => 'DMY'));
		echo $this->cksource->input('price', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('link', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('published', array('type' => 'checkbox'));
		echo $this->cksource->input('protected', array('type' => 'checkbox'));
		echo $this->Form->submit('Add Book', 
				array('after' => $this->Html->link('Cancel', array('action' => 'index')))
			);
		echo $this->Form->end();
		?>
	</div> <!-- End #tab1 -->
</div>
