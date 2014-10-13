<?php

class UsersController extends \BaseController {

   public function __construct()
   {
      $this->beforeFilter('sentry', ['except' => ['login','logout', 'doLogin', 'revokePermission']] );
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = User::with('groups')
            ->where('permissions', 'NOT LIKE', '%superuser%')
            ->orderBy('email', 'asc')->paginate();
        $index = $users->getPerPage() * ($users->getCurrentPage() - 1) + 1;
        return View::make('users.index', compact('users', 'index'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $groups = Sentry::getGroups();
        $outlets = SalesOutlets::dropdownList();
        $roles = ['' => 'Select Role'] + User::$roles;

		return View::make('users.create', compact('groups', 'outlets', 'roles'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), User::$rules);

        if ($validator->passes()) {
            $group = Sentry::findGroupById(Input::get('role'));
			$outlet_id = (Input::get('outlet_id') == 'all' || Input::get('outlet_id') == 0) ? 0 : Input::get('outlet_id');

            // Create the user
            $user = Sentry::createUser(array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'name' => Input::get('name'),
                'phone' => Input::get('phone'),
                'address' => Input::get('address'),
                'outlet_id' => $outlet_id,

                'activated' => Input::get('activated'),
                'permissions' => []
            ));

            // Assign the group to the user
            $user->addGroup($group);

            return Redirect::route('users.create')
                ->with('success', 'User created successfully');

        } else {
            return Redirect::route('users.create')
                ->withErrors($validator)
                ->withInput(Input::all());
        }
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
		$groups = Sentry::getGroups();
		$outlets = SalesOutlets::dropdownList();
		$roles = ['' => 'Select Role'] + User::$roles;
		$user = User::with('groups')->find($id);

		return View::make('users.edit', compact('groups', 'outlets', 'roles', 'user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = User::$updateRules;
		if(Input::get('password'))
			$rules['password'] = 'alpha_num|between:4,8';

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->passes()) {
			$group = Sentry::findGroupById(Input::get('role'));
			$outlet_id = (Input::get('outlet_id') == 'all' || Input::get('outlet_id') == 0) ? 0 : Input::get('outlet_id');

			// Create the user
			$user = Sentry::createUser(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'name' => Input::get('name'),
				'phone' => Input::get('phone'),
				'address' => Input::get('address'),
				'outlet_id' => $outlet_id,

				'activated' => Input::get('activated'),
				'permissions' => []
			));

			// Assign the group to the user
			$user->addGroup($group);

			return Redirect::route('users.create')
				->with('success', 'User created successfully');

		} else {
			return Redirect::route('users.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $user = Sentry::findUserById($id);
        $user->delete();

        return Redirect::route('users.index')
            ->with('success', 'User deleted succesfully');
	}

	public function login()
	{
	    if(Sentry::check())
       {
         return Redirect::route('home');
       }
		return View::make('users.login');
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
         	return Redirect::route('users.login')->withErrors($validator);
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
         return Redirect::route('users.login')->with('error', $error);
	}

	public function logout()
	{
		Sentry::logout();
		return Redirect::route('users.login');
	}

   public function revokePermission()
   {
      $permissions = \Mualnuam\Permission::revoke();
      return View::make('users.revoke', compact('permissions'));
   }
}
