<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

        $this->setUp();
	}

    protected function loggedUser()
    {
        return Sentry::getUser();
    }

    protected function setUp()
    {
        $this->current_route = Route::getCurrentRoute()->getName();
        $this->logged_user = Sentry::getUser();

        View::share('logged_user', $this->logged_user);
        View::share('current_route', $this->current_route);
    }

}
