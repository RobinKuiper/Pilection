<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class oAuth extends Eloquent
{
    protected $fillable = ['username', 'email', 'firstname', 'lastname', 'provider', 'provider_uid', 'user_id', 'profile_url', 'website_url', 'photo_url', 'age', 'description', 'gender', 'language', 'birthday', 'phone', 'address', 'country', 'zip', 'region', 'city'];

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
            'firstname'      => $auth->firstName,
            'lastname'       => $auth->lastName,
            'provider'       => $provider,
            'provider_uid'   => $auth->identifier,
            'user_id'        => $user->id,
            'profile_url'    => $auth->profileURL,
            'website_url'    => $auth->webSiteURL,

            'photo_url'      => $auth->photoURL,
            'description'    => $auth->description,
            'gender'         => $auth->gender,
            'language'       => $auth->language,
            'age'            => $auth->age,
            'birthday'       => $auth->birthDay . '-' . $auth->birthMonth . '-' . $auth->birthYear,
            'phone'          => $auth->phone,
            'address'        => $auth->address,
            'country'        => $auth->country,
            'region'         => $auth->region,
            'city'           => $auth->city,
            'zip'            => $auth->zip

        ]);

    }

}