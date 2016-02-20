<?php

function getUrlContent($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return ($httpcode >= 200 && $httpcode < 300) ? $data : false;
}

function xmlToObj($xml) {
	$obj = simplexml_load_string($xml);
	return ($obj !== false) ? $obj : false;
}

$xml = getUrlContent('https://www.reddit.com/r/Jokes/.rss?limit=100');

$obj = xmlToObj($xml);

foreach ($obj->entry as $entry) {
	echo '--------------------------------------------------<br>';
	echo 'Title: '.$entry->title.'<br>';
	echo '--------------------------------------------------<br>';
	echo 'Content: '.$entry->content.'<br>';
	echo '--------------------------------------------------<br><br><br>';
}