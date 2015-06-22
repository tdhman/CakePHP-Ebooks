<?php
$categories = $this->requestAction('/bookcategories/cate');
foreach($categories as $category) {
	echo '<li><a href="#">', $category['BookCategory']['name'], '</a></li>';
}