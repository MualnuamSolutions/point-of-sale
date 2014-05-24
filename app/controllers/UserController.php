<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function login()
	{
	    if(Sentry::check())
	    	return Redirect::route('home');

		return View::make('user.login');
	}

	/**
    * Authenticate user based on credentials
    *
    * @return Response
    */
	public function doLogin()
	{
   	$rules = [
      	'email' => 'required|email',
      	'password' => 'required'
      ];

   	$validator = Validator::make(Input::all(), $rules);

   	if($validator->passes()) {
      	$error = "Login failed. Please check your credentials.";
      	try
      	{
         	// Set login credentials
         	$credentials = array(
            		'email' => Input::get('email'),
            		'password' => Input::get('password')
         	);

         	// Try to authenticate the user. Set remember flag to false
         	$user = Sentry::authenticate($credentials, false);

         	if(Sentry::check()) {
                  if(Request::ajax())
                     return Response::json(['status' => 'success', 'message' => 'Login successful'])->setCallback(Input::get('callback'));
                  else
                     return Redirect::route('home');
         	} else {
            		return $this->loginFailed();
            }
         }
      	catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
      	{
         	return $this->loginFailed();
      	}
      	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
      	{
         	return $this->loginFailed();
      	}
      	catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
      	{
          	return $this->loginFailed();
      	}
      	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		   {
            return $this->loginFailed();
		   }
		   catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		   {
			   return $this->loginFailed();
		   }
		   // The following is only required if throttle is enabled
		   catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
			   return $this->loginFailed('suspended');
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
				return $this->loginFailed('banned');
			}
   	} else {
         if(Request::ajax())
            return $this->loginFailed();
         else
         	return Redirect::route('user.login')->withErrors($validator);
   	}
	}

	private function loginFailed($type = null)
	{
		$error = "Login failed. Please check your credentials.";

		if ($type == 'suspended') {
			$suspension_time = Config::get('cartalyst/sentry::throttling.suspension_time');
			$minutes = $suspension_time>1?'minutes':'minute';
			$error = sprintf('Your account has been suspended due to multiple login attempts. Please try again after %d %s.', $suspension_time, $minutes);

		} elseif ($type == 'banned') {
			$error = "You account has been banned due to security policy. Please contact administrator";
		}

      if(Request::ajax()) {
         return Response::json(['status' => 'error', 'message' => $error])->setCallback(Input::get('callback'));
      }
      else
         return Redirect::route('user.login')->with('error', $error);
	}

	public function logout()
	{
		Sentry::logout();
		return Redirect::route('user.login');
	}
}
