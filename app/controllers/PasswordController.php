<?php

class PasswordController extends \BaseController
{

    public function __construct()
    {
        $this->beforeFilter('guest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('layouts.login', ['active' => 'forgot', 'title' => 'Forgot Pasword']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        switch ($response = Password::remind(Input::only('email'))) {
            case Password::INVALID_USER:
                return Redirect::back()
                    ->with('message', Lang::get($response))
                    ->with('alert_class', 'alert-danger');

            case Password::REMINDER_SENT:
                return Redirect::back()
                    ->with('message', Lang::get($response))
                    ->with('alert_class', 'alert-success');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($token = null)
    {
        if (is_null($token)) App::abort(404);
        return View::make('password.edit', ['token' => $token]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response) {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()
                    ->with('message', Lang::get($response))
                    ->with('alert_class', 'alert-danger');

            case Password::PASSWORD_RESET:
                return Redirect::to('login')
                    ->with('message', 'You have succesfully changed your password!')
                    ->with('alert_class', 'alert-success');
        }
    }
}