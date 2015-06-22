<h1>Reply</h1>

<?php
echo $this->Form->create('Comment');
echo $this->Form->input('comment_author');
echo $this->Form->input('comment_author_email');
echo $this->Form->input('comment_content', array('rows' => '3'));
echo $this->Form->submit('Post');
echo $this->Form->end();
?>