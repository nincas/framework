<?php


namespace Framework\Controllers;

use Framework\Kernel\Controller;

class MyController extends Controller
{
	/*
	* Controller Method..
	*/
	public function __construct()
	{
		//
	}

	public function login($id)
	{
		render('login.html');
	}

	public function home($id)
	{
		render('index.html');
	}

	public function about($id)
	{
		render('about.html');
	}

	public function contact($id)
	{
		render('contact.html');
	}
}
