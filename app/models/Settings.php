<?php

class Settings extends \Eloquent {
	protected $fillable = ['user_id', 'show_email', 'show_name', 'show_lastlogin', 'date_format', 'system_notification', 'script_notification', 'project_notification'];

    protected $table = 'user_settings';

    public function saveDefaults($user_id)
    {
        $defaults = [
            'user_id'               => $user_id,
            'show_email'            => 0,
            'show_name'             => 1,
            'show_lastlogin'        => 1,
            'system_notification'   => 0,
            'script_notification'   => 0,
            'project_notification'  => 0,
            'date_format'           => "d-m-Y H:i:s"
        ];

        $this->create($defaults);
    }
}