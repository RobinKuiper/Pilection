<?php

class Grade extends Eloquent
{

    protected $fillable = ['grade, slug'];
    protected $table = 'grades';

    public $errors;
    public static $rules = [];

    public static $sluggable = array(
        'build_from' => 'grade',
        'save_to'    => 'slug',
    );

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
