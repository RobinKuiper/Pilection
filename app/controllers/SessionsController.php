<?php

class SessionsController extends \BaseController
{

    protected $user;

    public function __construct(User $user)
    {
        $this->beforeFilter('guest', ['only' => ['create', 'store']]);
        $this->user = $user;
    }

    /******
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $url = Session::get('url');
        return View::make('layouts.login', ['url' => $url, 'active' => 'login', 'title' => 'Login']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if($this->user->isValidated(Input::get('login'))){
            if (Auth::attempt(['email' => Input::get('login'), 'password' => Input::get('password')], Input::get('remember')) ||
                Auth::attempt(['username' => Input::get('login'), 'password' => Input::get('password')], Input::get('remember')))
            {
                $this->user->setLastLogin();

                return Redirect::to(Input::get('url'))
                    ->with('message', 'You are now logged in!')
                    ->with('alert_class', 'alert-success');
            }else{

                return Redirect::to('login')
                    ->with('message', 'Your credentials are incorrect, ' . link_to('password/forgot', 'forgot your password?'))
                    ->with('alert_class', 'alert-danger')
                    ->withInput();

            }
        }else{

            return Redirect::to('login')
                ->with('message', 'Your account is not yet activated.')
                ->with('alert_class', 'alert-danger')
                ->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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