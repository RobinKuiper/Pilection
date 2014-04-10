<?php

class Script extends Eloquent{

	protected $fillable = ['title', 'body', 'script'];
	protected $table = 'scripts';
        protected $softDelete = true;

	public $errors;
	public static $rules = [
		'title' 	=> 'required|regex:/^[a-zA-Z0-9_\-&@$ ]+$/|min:4',
		//'body' 		=> 'required|regex:/^[a-zA-Z0-9_\-&@$%(),.:+\r\n ]+$/|min:10'
	];

	public function isValid()
	{
		$validation = Validator::make($this->attributes, static::$rules);

		if($validation->passes()) return true;

		$this->errors = $validation->messages();
		return false;
	}

}