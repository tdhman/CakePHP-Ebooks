<?php
$posts = $this->requestAction('posts/display/sort:created/direction:desc/limit:3');

foreach($posts as $post):
    echo '<p><h1>', $post['Post']['title'], '</p></h1>';
	echo '<p><small>Created:', $post['Post']['created'], '</small></p>';
	echo String::truncate(strip_tags($post['Post']['body']), 25, array('ending' => '...', 'exact' => false));
	echo '<br/><br/>';
	echo $this->Html->link('Read more', array('controller'=>'posts', 'action'=>'view', $post['Post']['id']));
	echo '<br/>';
endforeach; 
