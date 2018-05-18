<?php

namespace Framework\Kernel;

use Illuminate\Http\Request;

class Router {

	private $routes = [];
	private $_uri = [];
	private $instance;
	private $path;
	private $end_points = [];

	public function __construct()
	{

	}

	public function get($path, $controller) 
	{	
		$patch = '';
		$this->end_points[] = $path;
		$this->path  = trim($_SERVER['PATH_INFO'], '/');
		$_path 		 = explode('/', $this->path);
		$_controller = explode('@', $controller)[0];
		$_endpath 	 = explode('/', $this->path);

		$patch = $_path[count($_path) - 1];
		
		$this->routes[$path] = [
			'method' 	 => 'GET',
			'controller' => $_controller,
			'attr' 	 	 => explode('@', $controller)[1],
			'patch' 	 => isset($patch[1]) ? $patch : ''
		];
	}

	public function boot()
	{
		$this->_uri[] = trim($_SERVER['PATH_INFO'], '/');
		foreach ($this->_uri as $keyy => $value) {
			if (in_array($value, $this->routes)) {

			}
		}

		$current_uri = explode('/', $this->_uri[0]);
		//$current_uri = implode('/', $current_uri);
		
		$_endpoints = $new_end = [];
		foreach ($this->routes as $key => $route) {
			$_endpoints[] = $key;
		}
		$uri = array_intersect(explode('/', $this->_uri[0]), $this->end_points);
		$patch 	= explode('/', $this->_uri[0]);

		if (count($uri) > 0) {
			$this->instance = (object) $this->routes[$uri[0]];
			$cont 	= new $this->instance->controller;
			$func 	= $this->instance->attr;
			$cont->$func($patch[count($patch) - 1]);
		} else {
			echo '404 not found.';
		}
	}
}
