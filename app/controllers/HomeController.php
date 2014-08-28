<?php
use \Mualnuam\Permission;

class HomeController extends BaseController
{
	public function index()
	{
		return View::make('home');
	}
}
