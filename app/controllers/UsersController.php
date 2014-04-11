<?php

class UsersController extends \BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->beforeFilter('csrf', ['only' => 'edit']);
		$this->user = $user;
	}
        
        /**
	 * Show the users profile
	 *
	 * @return View: Profile
	 */
	public function show($id)
	{
                $user = $this->user->find($id);
                
		return View::make('users.show', ['user' => $user]);
	}
        
        /**
	 * Show users edit profile page
	 *
	 * @return View: edit profile
	 */
        public function edit($id)
	{
                $user = $this->user->find($id);
                
		return View::make('users.edit', ['user' => $user]);
	}
        
        /**
	 * Store a updated user info in database.
	 *
	 * @return Redirect
	 */
        public function update($id)
	{
                return 'edit';
	}

	/**
	 * Show the form for registering a new user.
	 *
	 * @return View: Register form
	 */
	public function create()
	{
		return View::make('users.create', ['active' => 'register']);
	}

	/**
	 * Store a newly created user in database.
	 *
	 * @return Redirect
	 */
	public function store()
	{
		$input = Input::all();

		//return $input;

		if( ! $this->user->fill($input)->isValid())
		{
                    return $this->user->errors;
			return Redirect::back()->withInput()->withErrors($this->user->errors);
		}

		$this->user->create([
                        'username'              => $input['username'],
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