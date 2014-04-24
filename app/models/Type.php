<?php

class Type extends Eloquent
{

    protected $fillable = ['type, slug'];
    protected $table = 'types';

    public $errors;
    public static $rules = [];

    public static $sluggable = array(
        'build_from' => 'type',
        'save_to'    => 'slug',
    );

    public function items()
    {
        return $this->hasMany('Item');
    }
}
