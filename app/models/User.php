<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    protected $fillable = ['username', 'firstname', 'lastname', 'email', 'password', 'validation'];

    public $errors;
    public static $rules = [
        'username' => 'required|alpha_dash|min:3',
        'firstname' => 'alpha|min:2',
        'lastname' => 'alpha|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_dash|between:6,12',
        'password_confirmation' => 'same:password'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function setLastLogin($id=null)
    {
        $id = ($id == null) ? Auth::user()->id : $id;
        $this->user->where('id', '=', $id)->update(['lastlogin' => date('Y-m-d H:m:s')]);
    }

    public function mailValidation($id, $token)
    {
        Mail::send('emails.auth.validation', ['token' => $token, 'id' => $id], function($message)
        {
            $message->to(Input::get('email'), Input::get('firstname') . ' ' . Input::get('lastname') . ' (' . Input::get('username') . ')')->subject('Welcome to Pilection!');
        });
    }

    public function isValidated($login)
    {
        if( count($this->where('email', '=', $login)->where('validation', '=', 0)->first()) == 1 ||
            count($this->where('username', '=', $login)->where('validation', '=', 0)->first()) == 1)
                return true;

        return false;
    }

    public function isValid()
    {
        $validation = Validator::make($this->attributes, static::$rules);

        if ($validation->passes()) return true;

        $this->errors = $validation->messages();
        return false;
    }

}