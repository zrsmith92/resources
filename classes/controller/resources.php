<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Resources extends Controller {
	
	public function before()
	{
		if ( !$this->request->is_internal() )
			//die();
			throw new HTTP_Exception_404();
	}
	
	public function action_cache_scripts($scripts)
	{
		
	}
	
	public function action_cache_styles($styles)
	{
		
	}
	
}