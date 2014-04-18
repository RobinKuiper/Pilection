<?php

class UsersController extends \BaseController
{

    protected $user;
    protected $item;
    protected $views;
    protected $settings;

    public function __construct(User $user, Item $item, Views $views, Settings $settings)
    {
        $this->beforeFilter('guest', ['only' => ['create', 'store']]);
        $this->beforeFilter('auth', ['only' => ['edit', 'index', 'show', 'update']]);
        //$this->beforeFilter('csrf', ['only' => 'edit']);
        $this->user = $user;
        $this->item = $item;
        $this->views = $views;
        $this->settings = $settings;
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
        if (preg_match('/^[1-9][0-9]*$/', $id)):
            $user = $this->user->findOrFail($id);
        else:
            $user = $this->user->where('username', '=', $id)->first();
        endif;

        $user->views = $this->views->updateViews($user->id, 'user', 1);
        $settings = $this->settings->where('user_id', '=', $user->id)->first();
        $settings->own = $this->settings->where('user_id', '=', Auth::user()->id)->first();

        $items = $this->item->where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->get();

        return View::make('users.show', ['user' => $user, 'items' => $items, 'settings' => $settings]);
    }

    /**
     * Show users edit profile page
     *
     * @return View: edit profile
     */
    public function edit()
    {
        $id = Auth::user()->id;

        $user = $this->user->find($id);
        $settings = $this->settings->where('user_id', '=', $id);

        return View::make('users.edit', ['user' => $user, 'settings' => $settings]);
    }

    /**
     * Store a updated user info in database.
     *
     * @return Redirect
     */
    public function update()
    {

        switch(Input::get('change')){
            case 'profile':
                $rules = [
                    'firstname' => 'alpha|min:2',
                    'lastname' => 'alpha|min:2',
                ];

                $update_fields  = [
                    'firstname' => Input::get('firstname'),
                    'lastname' => Input::get('lastname')
                ];
            break;

            case 'password':
                $rules = [
                    'password' => 'required|alpha_num|between:6,12',
                    'password_confirmation' => 'same:password'
                ];

                $update_fields = [
                  'password' => Hash::make(Input::get('password'))
                ];
            break;

            case 'email':
                $rules = [
                    'email' => 'required|email|unique:users',
                ];

                $update_fields = [
                    'email' => Input::get('email')
                ];
            break;
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $this->user->where('id', '=', Auth::user()->id)->update($update_fields);

        return Redirect::Route('users.index')
            ->with('message', 'Your ' . Input::get('change') . ' is updated!')
            ->with('alert_class', 'alert-success');
    }

    /**
     * Show the form for registering a new user.
     *
     * @return View: Register form
     */
    public function create()
    {
        return View::make('users.create2', ['active' => 'register']);
    }

    /**
     * Store a newly created user in database.
     *
     * @return Redirect
     */
    public function store()
    {
        $token = str_random(40);

        $input_fields = [
            'username'      => Input::get('username'),
            'password'      => Input::get('password'),
            'password_confirmation' => Input::get('password_confirmation'),
            'email'         => Input::get('email'),
            'firstname'     => Input::get('firstname'),
            'lastname'      => Input::get('lastname'),
            'validation'    => $token
        ];

        if (!$this->user->fill($input_fields)->isValid()) {
            return Redirect::back()->withInput()->withErrors($this->user->errors);
        }

        $input_fields['password'] = Hash::make($input_fields['password']);

        $user = $this->user->create($input_fields);
        $this->settings->saveDefaults($user->id);

        Mail::send('emails.auth.validation', ['token' => $token, 'id' => $user->id], function($message)
        {
            $message->to(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname') . ' (' . Input::get('username') . ')')->subject('Email validation!');
        });

       return Redirect::Route('sessions.create')
            ->with('message', 'Thanks for registering!')
            ->with('alert_class', 'alert-success');
    }

}