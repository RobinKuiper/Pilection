<?php

class Type extends Eloquent
{

    protected $fillable = ['type'];
    protected $table = 'types';

    public $errors;
    public static $rules = [];

    public function items()
    {
        return $this->hasMany('Item');
    }
}