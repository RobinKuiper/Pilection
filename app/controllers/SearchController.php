<?php

class SearchController extends \BaseController {

        protected $views;

	public function __construct(Views $views)
	{
		$this->beforeFilter('csrf', ['only' => ['store']]);
                $this->views = $views;
	}
        
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return view::make('search.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $q = Input::get('q');
           
            $items = Item::where('title', 'LIKE', '%'.$q.'%')->get();

            return View::make('search.store', ['items' => $items]);
	}
}