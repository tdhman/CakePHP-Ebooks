<?php
$ebooks = $this->requestAction('/ebooks/latest');
foreach($ebooks as $ebook) {
	echo '<li>';
	echo '<div class="new_prod_box">';
	echo $this->Html->link(String::truncate($ebook['Ebook']['title'], 20), array('controller'=>'ebooks', 'action'=>'view', $ebook['Ebook']['id']));
	echo '<div class="new_prod_bg">';
	echo '<span class="new_icon">', $this->Html->image('new_icon.gif', array('alt' => '')) ,'</span>';
	echo $this->Html->image('uploads/'.$ebook['Ebook']['cover'], array('alt' => '', 'class' => 'thumb'));
	echo '</div></div>';
	echo '</li>';
}