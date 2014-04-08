<?php

class System extends Eloquent{

	protected $fillable = ['title', 'body'];
	protected $table = 'systems';

	public $errors;
	public static $rules = [
		'title' 	=> 'required|alpha|min:2',
		'body' 		=> 'required|alpha|min:10'
	];

	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if($validation->passes()) return true;

		$this->errors = $validation->messages();
		return false;
	}

}