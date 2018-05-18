<?php


namespace Framework\Controllers;

use Framework\Kernel\Controller;

class MyController extends Controller
{
	public function __construct()
	{
		
	}

	public function login($id)
	{
		print(render('login.html'));
	}

	public function home($id)
	{
		print(render('index.html'));
	}

	public function about($id)
	{
		echo 'this is about';
	}

	public function contact($id)
	{
		echo 'this is contact';
	}
}
