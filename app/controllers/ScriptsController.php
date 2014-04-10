<?php

class ScriptsController extends \BaseController {

	protected $item;
        protected $views;

	public function __construct(Item $item, Views $views)
	{
                $this->beforeFilter('auth', ['only' => ['create', 'edit']]);
		$this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
		$this->item = $item;
                $this->views = $views;
                
                $this->item->type = 'script';
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = $this->item->where('type', '=', $this->item->type)->get();

		return View::make('scripts.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('scripts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		if( ! $this->item->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->item->errors);
		}
                
		$this->item->create($input);

		return Redirect::to('scripts')
				->with('message', 'New script created!')
				->with('alert_class', 'alert-success');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$item = $this->item->findOrFail($id);
                
                // Update viewcount
                $this->views->updateViews($id);
                
                // Get viewcount
                $item->viewcount = $this->views->getViews($id);

		return View::make('scripts.show', compact('item'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
                $item = $this->item->findOrFail($id);
                
		return View::make('scripts.edit', compact('item'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		if( ! $this->item->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->item->errors);
		}
                
                $update_fields = [
                    'title'     => $input['title'],
                    'body'      => $input['body'],
                ];
              
		$this->item->where('id', '=', $id)->update($update_fields);

		return Redirect::to('scripts/'.$id)
				->with('message', 'System updated!')
				->with('alert_class', 'alert-success');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $this->item->find($id)->delete();
            
            return Redirect::to('scripts')
				->with('message', 'Script removed!')
				->with('alert_class', 'alert-success');
	}

}