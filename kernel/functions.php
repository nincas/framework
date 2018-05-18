<?php


function sayHello($name = "")
{	
	dump($name);
	die();
}

function render($filename) {
	$html = file_get_contents(dirname(__DIR__).'/templates/'.$filename);
	return $html;
}