<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class oAuth extends Eloquent implements UserInterface, RemindableInterface
{
    protected $fillable = ['username', 'email', 'firstname', 'lastname', 'provider', 'provider_uid', 'user_id', 'profile_url', 'website_url'];

    public $errors;
    public static $rules = [];

    protected $table = 'oauth';
    protected $hidden = array('password');

    public function getWithProviderUID( $provider, $provider_uid )
    {
        return $this->where('provider', '=', $provider)
                     ->where('provider_uid', '=', $provider_uid)
                     ->first();
    }

    public function create_authentication( $provider, $user, $auth )
    {
        $this->create([
            'username'       => $auth->username,
            'email'          => $auth->email,
            'firstname'      => $auth->first_name,
            'lastname'       => $auth->last_name,
            'provider'       => $provider,
            'provider_uid'   => $auth->identifier,
            'user_id'        => $user->id,
            'profile_url'    => $auth->profileURL,
            'website_url'    => $auth->websiteURL
        ]);
    }

}