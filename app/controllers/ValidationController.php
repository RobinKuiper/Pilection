<?php

class ValidationController extends \BaseController
{
    protected $user;

    public function __construct(User $user)
    {
        $this->beforeFilter('guest');
        $this->beforeFilter('csrf', ['on' => ['post']]);
        $this->user = $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id, $token)
    {
        if( count( $this->user->where('id', '=', $id)->where('validation', '=', $token)->first()) == 1)
        {
            $this->user->where('id', '=', $id)->update(['validation' => '0']);

            return Redirect::route('sessions.create', ['active' == 'login'])
                ->with('message', 'Your account is now activated!')
                ->with('alert_class', 'alert-success');

        }else{

            return Redirect::route('sessions.create')
                ->with('message', 'Your account is not yet activated.')
                ->with('alert_class', 'alert-danger');

        }
    }

}