<?php

class UsersController extends \BaseController {

	protected $user;
        protected $item;

	public function __construct(User $user, Item $item)
	{
                $this->beforeFilter('guest', ['only' => ['create', 'store']]);
                $this->beforeFilter('auth', ['only' => ['edit', 'index', 'show', 'update']]);
		$this->beforeFilter('csrf', ['only' => 'edit']);
		$this->user = $user;
                $this->item = $item;
	}
        
        /**
	 * Show the authenticated users profile
	 *
	 * @return View: Profile
	 */
	public function index()
	{
        $id = Auth::user()->id;

		return $this->show($id);
	}
        
        /**
	 * Show the users profile
	 *
	 * @return View: Profile
	 */
	public function show($id)
	{
                if(preg_match('/^[1-9][0-9]*$/', $id)):
                    $user = $this->user->find($id);
                ;else:
                    $user = $this->user->where('username', '=', $id)->first();
                endif;
                
                $items = $this->item->where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->get();
                
		return View::make('users.show', ['user' => $user, 'items' => $items]);
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