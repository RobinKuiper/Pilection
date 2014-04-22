<?php

class GradesController extends \BaseController
{

    protected $grade;

    public function __construct(Grade $grade)
    {
        $this->grade = $grade;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($grade)
    {
        $items = $this->grade->getItemsByGrade($grade);
        $breadcrumb = 'grades';

        return View::make('items.index', ['breadcrumb' => $breadcrumb, 'title' => $grade, 'items' => $items, 'filter' => $grade]);
    }
}