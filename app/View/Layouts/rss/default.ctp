<?php
    echo $this->Rss->header();
    if (!isset($documentData)) {
    $documentData = array();
    }
    if (!isset($channelData)) {
    $channelData = array();
    }
    if (!isset($channelData['title'])) {
    $channelData['title'] = $title_for_layout;
    }
    $channel = $this->Rss->channel(array('xmlns:atom' => 'http://www.w3.org/2005/Atom'), $channelData, $content_for_layout);
    echo $this->Rss->document($documentData,$channel);
?>
