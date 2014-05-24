<?php

class HomeController extends BaseController
{
	public function index()
	{
		return View::make('home');
	}

	public function refresh()
   	{
      	$permission = new Permission;
      	$permission->revoke();

      	return View::make('refresh');
   	}
}
