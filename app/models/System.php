<?php

class System extends Eloquent{

	protected $fillable = ['title', 'body', 'image'];
	protected $table = 'systems';

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
        
        public function saveImage($image)
        {
            $save_path = 'public/upload/systems/images';
            $filename = $image->getClientOriginalName();
            if( $image->move($save_path, $filename) ) return $filename;
            
            return false;
        }

}