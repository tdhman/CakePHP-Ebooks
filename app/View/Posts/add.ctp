<div class="content-box-header">
					
<h3>Add a new Post</h3>

	<div class="clear"></div>
					
</div> <!-- End .content-box-header -->

<div class="content-box-content">
					
	<div class="tab-content default-tab" id="tab1">
		<?php
		$config['toolbar'] = array(
			array( 'Source', 'Save', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ),
			array( 'NumberedList', 'BulletedList', '-'),
			array( 'Image', 'Link', 'Unlink', 'Anchor' )
		); 

		echo $this->cksource->create('Post');
		echo $this->cksource->input('title', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('post_category_id', array(
			'type'    => 'select',
			'class'	  => 'small-input',
			'options' => $categories,
			'empty'   => false
		));
		echo $this->cksource->input('priority', array('type' => 'select', 'class' => 'small-input', 'options' => array('Important','High','Normal','Draft')));
		echo $this->cksource->ckeditor('body');
		echo $this->cksource->input('secret_link', array('class' => 'text-input medium-input'));
		echo $this->cksource->input('published', array(
			'type' => 'checkbox',
		));
		echo $this->Form->submit('Save Post', 
				array('after' => $this->Html->link('Cancel', array('action' => 'index')))
			);
		echo $this->Form->end();
		?>
	</div> <!-- End #tab1 -->
</div>
