<?php

class SessionsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()) return Redirect::to('/');

		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::attempt(Input::only('email', 'password')))
		{
			return Redirect::to('/')
				->with('message', 'You are now logged in!')
				->with('alert_class', 'alert-success');
		}

		return Redirect::to('login')
			->with('message', 'Your email/password combination was incorrect')
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