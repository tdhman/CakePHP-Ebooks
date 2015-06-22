<?php
$comments = $this->requestAction('/comments/latest');
foreach($comments as $comment) {
echo $comment['Comment']['title'];
}