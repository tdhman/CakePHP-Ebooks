<div class="content">
<div class="title"><span class="title_icon"><?php echo $this->Html->image('bullet1.gif', array('alt' => '')); ?></span>Add New Book</div>
<?php
echo $this->cksource->create('Book', array('type' => 'file'));
echo $this->cksource->input('title');
echo $this->cksource->input('author');
echo $this->cksource->input('editor');
echo $this->cksource->input('genre');
echo $this->cksource->input('rating', array('type' => 'select', 'class' => 'rating', 'options' => array('1','2','3','4','5'), 'default' => '0'));
echo $this->cksource->input('book_category_id', array('type'    => 'select', 'options' => $categories, 'empty'   => false));
echo $this->cksource->ckeditor('abstract',array('escape' => false));
echo $this->cksource->input('cover', array('type' => 'file'));
echo $this->cksource->input('publisher');
echo $this->cksource->input('published_date', array('type' => 'date', 'dateFormat' => 'DMY'));
echo $this->cksource->input('price');
echo $this->cksource->input('link');
echo $this->cksource->input('published', array('type' => 'checkbox'));
echo $this->Form->submit('Add Book', 
        array('after' => $this->Html->link('Cancel', array('action' => 'index')))
    );
echo $this->Form->end();
?>
</div>
