<?php

class Item extends Eloquent{

	protected $fillable = ['user_id', 'title', 'body', 'image', 'download', 'website', 'type', 'grade'];
	protected $table = 'items';
    protected $softDelete = true;

	public $errors;
	public static $rules = [
		'title' 	=> 'required|regex:/^[a-zA-Z0-9_\-&@$ ]+$/|min:4',
        'website_url'       => 'url',
        'download_url'      => 'url',
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
        $save_path = 'public/upload/items/images';
        $filename = $image->getClientOriginalName();
        if( $image->move($save_path, $filename) ) return $filename;

        return false;
    }
        
    public static function checkType()
    {
        if(Input::segment(1) != 'systems' && Input::segment(1) != 'scripts' && Input::segment(1) != 'projects') return false;

        return true;
    }
        
    public static function checkUser()
    {
        $item_id = Input::segment(2);
        $user_id = Auth::user()->id;

        if(Item::where('id', '=', $item_id)->where('user_id', '=', $user_id)->count() == 0) return false;

        return true;
    }

}