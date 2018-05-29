<?php

namespace Framework\Kernel;

use Illuminate\Http\Request;
use \Exception;

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
		$this->path  = @(trim($_SERVER['PATH_INFO'], '/')) ? trim($_SERVER['PATH_INFO'], '/') : null;
		$_path 		 = explode('/', $this->path);
		$_controller = explode('@', $controller)[0];
		$_endpath 	 = explode('/', $this->path);

		$patch = $_path[count($_path) - 1];
		
		$this->routes[$path] = [
			'method' 	 => 'GET',
			'controller' => $_controller,
			'attr' 	 	 => explode('@', $controller)[1],
			'patch' 	 => isset($patch) ? $patch : ''
		];

	}

	public function boot()
	{
		$this->_uri[] = @(trim($_SERVER['PATH_INFO'], '/')) ? trim($_SERVER['PATH_INFO'], '/') : null;
		$current_uri = explode('/', $this->_uri[0]);
		
		$_endpoints = $new_end = [];
		foreach ($this->routes as $key => $route) {
			$_endpoints[] = $key;
		}

		if ($this->_uri[0] == null) $this->_uri[0] = '/';
		
		/**
		* Error Handling
		*/
		try {
			if (count($this->_uri) > 0 && in_array($this->_uri[0], $_endpoints)) {
				/**
				* instantiate controller
				*/
				$this->instance = (object) $this->routes[$this->_uri[0]];
				$cont 	= new $this->instance->controller;
				$func 	= $this->instance->attr;
				$cont->$func($this->instance->patch);
			} else {
				throw new Exception("Page/URL not found.");
			}
		} catch(Exception $e) {
			print($e->getMessage());
		}
	}
}
