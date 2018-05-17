<?php

namespace Framework\Kernel;

use Illuminate\Http\Request;

class Router {

	private $route;
	private $routes;

	public function get($path, $controller) 
	{
		$this->route = $path . ',' . $controller;
	}

	public function start()
	{
		echo $this->route;
	}
}
