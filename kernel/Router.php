<?php

namespace Framework\Kernel;

use Illuminate\Http\Request;

class Router {

	private $routes = [];
	private $_uri = [];
	private $instance;
	private $path;

	public function __construct()
	{

	}

	public function get($path, $controller) 
	{	
		$this->path = trim($_SERVER['PATH_INFO'], '/');
		$_path = explode('/', $this->path);
		$_controller = explode('@', $controller)[0];

		$patch = $_path[count($_path) - 1];

		if (isset($patch[1])) {
			$this->routes[$path] = [
				'method' 	 => 'GET',
				'controller' => $_controller,
				'attr' 	 	 => explode('@', $controller)[1],
				'patch' 	 => $patch
			];
		}
	}

	public function boot()
	{
		$this->_uri[] = trim($_SERVER['PATH_INFO'], '/');
		foreach ($this->_uri as $keyy => $value) {
			if (in_array($value, $this->routes)) {

			}
		}

		$current_uri = explode('/', $this->_uri[0]);
		unset($current_uri[count($current_uri) - 1]);

		$current_uri = implode('/', $current_uri);

		$_endpoints = [];
		foreach ($this->routes as $key => $route) {
			$_endpoints[] = $key;
		}

		if (in_array($current_uri, $_endpoints)) {
			$this->instance = (object) $this->routes[$current_uri];
			$patch 	= $this->instance->patch;
			if (isset($patch)) {
				$cont 	= new $this->instance->controller;
				$func 	= $this->instance->attr;
				$cont->$func($patch);
			}
		} else {
			echo '404 not found.';
		}
	}
}
