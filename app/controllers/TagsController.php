<?php

class TagsController extends \BaseController {
            
        protected $item;
        protected $views;
        protected $tag;
        
        public function __construct(Item $item, Views $views, Tag $tag)
	{
                $this->beforeFilter('auth', ['only' => ['create', 'edit']]);
		$this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
                
		$this->item = $item;
                $this->views = $views;
                $this->tag = $tag;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($tag)
	{
        $items = $this->tag->getItemsByTag($tag);
        $breadcrumb = 'tags';

        return View::make('items.index', ['title' => $tag,'breadcrumb' => $breadcrumb, 'items' => $items]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}