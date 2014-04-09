<?php

class SystemsController extends \BaseController {

	protected $system;

	public function __construct(System $system)
	{
		$this->beforeFilter('csrf', ['on' => 'post']);
		$this->system = $system;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$systems = $this->system->all();

		return View::make('systems.index', compact('systems'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('systems.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		if( ! $this->system->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->system->errors);
		}
                
                if( ! $input['image'] = $this->system->saveImage($input['image']))
                {
                    return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
                }
                
		$this->system->create($input);

		return Redirect::to('/')
				->with('message', 'New system created!')
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
		$system = $this->system->findOrFail($id);

		return View::make('systems.show', compact('system'));
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