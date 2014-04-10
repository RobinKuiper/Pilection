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
            
            $query = "(SELECT id, title, body FROM systems WHERE title LIKE '%".$q."%')
                        union
                      (SELECT id, title, body FROM scripts WHERE title LIKE '%".$q."%')
                        union
                      (SELECT id, title, body FROM projects WHERE title LIKE '%".$q."%')";
            
            $results = DB::select( DB::raw($query) );
            
            return View::make('search.store', ['results' => $results]);
	}
}