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
		$_controller = explode('@', $controller)[0];

		$this->routes[$path] = [
			'method' 	 => 'GET',
			'controller' => $_controller,
			'attr' 	 	 => explode('@', $controller)[1],
			'patch' 	 => explode('/', $this->path)[1]
		];
	}

	public function boot()
	{
		$this->_uri[] = trim($_SERVER['PATH_INFO'], '/');

		foreach ($this->_uri as $keyy => $value) {
			if (in_array($value, $this->routes)) {

			}
		}

		$current_uri = explode('/', $this->_uri[0])[0];
		$_endpoints = [];
		foreach ($this->routes as $key => $route) {
			$_endpoints[] = $key;
		}

		if (in_array($current_uri, $_endpoints)) {
			$this->instance = (object) $this->routes[$current_uri];
			$patch 	= $this->instance->patch;
			$cont 	= new $this->instance->controller;
			$func 	= $this->instance->attr;
			$cont->$func($patch);
		}
	}
}
