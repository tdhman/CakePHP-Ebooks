<?php
	//App::import('Sanitize'); //Strips extra whitespace, images, scripts and stylesheets from output
	
	$this->set('documentData', array(
    'xmlns:dc' => 'http://purl.org/dc/elements/1.1/'));
    $this->set('channelData', array(
    'title' => __("Sách Mới Đăng Gần Đây", true),
    'link' => $this->Html->url('/', true),
    'description' => __("Sách mới.", true),
    'language' => 'vi',
	'atom:link' => array(
            'attrib' => array(
            'href' => 'http://ebooks.mistips.info/ebooks/feed.rss',
            'rel' => 'self',
            'type' => 'application/rss+xml'))
	));

    foreach ($ebooks as $ebook) {
		$postTime = strtotime($ebook['Ebook']['created']);
		$postLink = array('controller' => 'ebooks', 'action' => 'view', $ebook['Ebook']['id']);

		// This is the part where we clean the body text for output as the description
		// of the rss item, this needs to have only text to make sure the feed validates
		$bodyText = preg_replace('=\(.*?\)=is', '', $ebook['Ebook']['abstract']);
		$bodyText = $this->Text->stripLinks($bodyText);
		//$bodyText = Sanitize::stripAll($bodyText);
		$bodyText = $this->Text->truncate($bodyText, 400, array('ending' => '...', 'exact' => true, 'html' => true));

		echo $this->Rss->item(array(), array('title' => $ebook['Ebook']['title'], 
											'link' => $postLink,'guid' => array('url' => $postLink, 'isPermaLink' => 'true'),
											'description' => $bodyText,
											'pubDate' => $ebook['Ebook']['created']));
    }
?>