<?php

class SessionsController extends \BaseController {

        protected $user;

	public function __construct(User $user)
	{
		$this->beforeFilter('csrf', ['only' => 'edit']);
		$this->user = $user;
	}
        
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()) return Redirect::to('/');

		return View::make('sessions.create', ['active' => 'login']);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::attempt(['email' => Input::get('login'), 'password' => Input::get('password')]) || 
                   Auth::attempt(['username' => Input::get('login'), 'password' => Input::get('password')]))
		{
                        $this->user->where('email', '=', Input::get('email'))->update(['lastlogin' => date('Y-m-d H:m:s')]);
                        
			return Redirect::to('/')
				->with('message', 'You are now logged in!')
				->with('alert_class', 'alert-success');
		}

		return Redirect::to('login')
			->with('message', 'Your credentials are incorrect')
			->with('alert_class', 'alert-danger')
			->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

		return Redirect::to('/')
			->with('message', 'Your are now logged out!')
			->with('alert_class', 'alert-info');
	}

}