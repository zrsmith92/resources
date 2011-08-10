<?php defined('SYSPATH') or die('No direct script access.');
return array(
	
	'scripts_base_url' 	=> 'js/',
	'styles_base_url'	=> 'css/',
	
	'config_object_name' => 'Site',
	
	
	'library_scripts'	=> array(
		'chrome-frame'		=> array('external', 'https://ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js'),
		'dojo'				=> array('external', 'https://ajax.googleapis.com/ajax/libs/dojo/1.6.1/dojo/dojo.xd.js'),
		'ext-core'			=> array('external', 'https://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js'),
		'jquery' 			=> array('external', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'),
		'jqueryui'			=> array('external', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js'),
		'mootools'			=> array('external', 'https://ajax.googleapis.com/ajax/libs/mootools/1.3.2/mootools-yui-compressed.js'),
		'prototype' 		=> array('external', 'https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js'),
		'scriptacolous' 	=> array('external', 'https://ajax.googleapis.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js'),
		'swfobject'			=> array('external', 'https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js'),
		'yui'				=> array('external', 'https://ajax.googleapis.com/ajax/libs/yui/3.3.0/build/yui/yui-min.js'),
		'google-webfonts'	=> array('external', 'https://ajax.googleapis.com/ajax/libs/webfont/1.0.22/webfont.js')
	),
	
	'library_styles'	=> array()
	
	'default_scripts'	=> array(),
	'default_styles'	=> array()
	
);