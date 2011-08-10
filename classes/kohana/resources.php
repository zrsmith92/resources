<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Resources {
	
	public static $instance;
	
	public $config;
	
	public $library_scripts;
	public $library_styles;
	public $config_object_name;
	
	public $scripts_base_url;
	public $styles_base_url;
	
	public $loaded_scripts = array(
		'interal'	=> array(),
		'external'	=> array(),
		'inline'	=> array(),
		'config'	=> array()
	);
	public $loaded_styles = array(
		'internal'	=> array(),
		'external'	=> array(),
		'inline'	=> array()
	);
	
	public static function instance()
	{
		if ( ! Resources::$instance ) {
			Resources::$instance = new Resources();

			Resources::$instance->config = Kohana::config('Resources');
			
			foreach ( Resources::$instance->config as $key => $val )
			{
				if ( property_exists('Resources', $key) )
				{
					Resources::$instance->{$key} = $value;
				}
			}
			
			if ( Resources::$instance->config->default_scripts )
			{
				array_map(array('Resources', 'add_library_script'), Resources::$instance->config->default_scripts);
			}
			if ( Resources::$instance->config->default_styles )
			{
				array_map(array('Resources', 'add_library_style'), Resources::$instance->config->default_styles);
			}
		}
		
		return Resources::$instance;
	}
	private final __construct() { /* Singleton Class */ }
	
	public static function add_script($type, $data = NULL, $dependencies = array())
	{
		if ( is_array($type) )
			return array_map(array('Resources', 'add_script'), $type);
		
		if ( $data === NULL && $dependencies === NULL )
			return Resources::add_library_script($type);

		array_map(array('Resource', 'add_library_script'), $dependencies);
		
		if ( array_key_exists($type, Resources::$intance->loaded_styles) )
		{
			Resources::$intance->loaded_styles[$type] = $data;
		}
	}
	
	public static function add_style($type, $data = NULL, $dependencies = array())
	{
		if ( is_array($type) )
			return array_map(array('Resources', 'add_style'), $type);
		
		if ( $data === NULL && $dependencies === NULL )
			return Resources::add_library_style($type);

		array_map(array('Resource', 'add_library_script'), $dependencies);
		
		if ( array_key_exists($type, Resources::$intance->loaded_styles) )
		{
			Resources::$intance->loaded_styles[$type] = $data;
		}
	}
	
	public static function add_library_script($script)
	{
		if (	array_key_exists($script, Resources::instance()->library_scripts) 
			&& !array_key_exists($script, Resources::instance()->load_scripts) )
		{
			call_user_func_array(array('Resources', 'add_script'), Kohana::instance()->library_scripts[$script]);
		}
	}
	
	public static function add_library_style($style)
	{
		if (	array_key_exists($style, Resources::instance()->library_styles)
		 	&& !array_key_exists($style, Resources::instance()->loaded_styles) )
		{
			call_user_func_array(array('Resources', 'add_style'), Kohana::instance()->library_styles[$style]);
		}
	}
	
	public static function render_scripts()
	{
		if ( Resources::instance()->config['cache-scripts'] && $cache = Cache::instance()->get('Resources', FALSE) )
			return $cache->scripts;
		
		$html = array();
		$scripts = Resources::instance()->loaded_scripts;
		$scripts['inline'][] = Resources::instance()->config_object_name . ' = ' json_encode($scripts['config']);

		foreach ( $scripts['external'] as $script )
		{
			$html[] = HTML::script($script);
		}		
		foreach ( $scripts['internal'] as $script )
		{
			$html[] = HTML::script(Resources::instance()->scripts_base_url . $script);
		}
		foreach( $scripts['inline'] as $script )
		{
			$html[] = '<script>' . $script . '</script>';
		}
		
		return implode("\n", $html);
	}
	
	public static function render_styles()
	{
		if ( Resources::instance()->config['cache_styles'] && $cache = Cache::instance()->get('Resources', FALSE) )
			return $cache;
		
		$html = array();
		$styles = Resources::instance()->loaded_scripts;
		
		foreach ( $styles['internal'] as $style )
		{
			$html[] = HTML::style(Resources::instance()->styles_base_url . $style);
		}
		foreach ( $styles['external'] as $style )
		{
			$html[] = HTML::style($style);
		}
		foreach( $styles['inline'] as $style )
		{
			$html[] = '<style>' . $style . '</style>';
		}
		
		return implode("\n", $html);
	}
}