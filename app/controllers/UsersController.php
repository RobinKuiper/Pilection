<?php

class UsersController extends \BaseController {

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
		return View::make('users.create', ['active' => 'register']);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		//return $input;

		if( ! $this->user->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}

		$this->user->create([
			'email' 		=> $input['email'],
			'firstname'		=> $input['firstname'],
			'lastname'		=> $input['lastname'],
			'password'		=> Hash::make($input['password'])
		]);
		
		return Redirect::to('login')
			->with('message', 'Thanks for registering!')
			->with('alert_class', 'alert-success');
	}

}