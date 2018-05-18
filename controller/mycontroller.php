<?php


namespace Framework\Controllers;

use Framework\Kernel\Controller;

class MyController extends Controller
{
	public function __construct()
	{
		
	}

	public function abc($id)
	{
		echo $id;
	}

	public function edf($id)
	{
		echo $id.'edf';
	}

	public function cde($id)
	{
		echo $id.'cde';
	}
}
