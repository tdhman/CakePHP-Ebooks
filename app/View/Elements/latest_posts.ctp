<?php
$posts = $this->requestAction('/posts/latest');
foreach($posts as $post) {
echo '<p>', $this->Html->link($post['Post']['title'], array('controller'=>'posts', 'action'=>'view', $post['Post']['id'])), '</p>'; 
}