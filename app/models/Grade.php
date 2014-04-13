<?php

class Grade extends Eloquent{

	protected $fillable = ['grade'];
	protected $table = 'grades';

	public $errors;
	public static $rules = [];

    public function getItemsByGrade($grade)
    {
        $grade_id = $this->select('id')->where('grade', '=', $grade)->first();

        return Item::where('grade', '=', $grade_id->id)->get();
    }
}