<?php

class Grade extends Eloquent
{

    protected $fillable = ['grade'];
    protected $table = 'grades';

    public $errors;
    public static $rules = [];

    /* REWRITTEN BELOW
    public function getItemsByGrade($grade)
    {
        $grade_id = $this->select('id')->where('grade', '=', $grade)->first();

        return Item::where('grade', '=', $grade_id->id)->get();
    }
    */

    public static function getGradeByItem($id)
    {
        $tags = DB::table('grades')
            ->join('items', function ($join) use ($id) {
                $join->on('items.grade', '=', 'grades.id')
                    ->where('items.id', '=', $id);
            })
            ->select('grades.grade')
            ->get();

        return $tags;
    }

    public function getItemsByGrade($grade)
    {
        $items = DB::table('items')
            ->join('grades', function ($join) use ($grade) {
                $join->on('grades.id', '=', 'items.grade')
                    ->where('grades.grade', '=', $grade);
            })
            ->select('items.*')
            ->get();

        return $items;
    }
}