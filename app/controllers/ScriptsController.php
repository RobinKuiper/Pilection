<?php

class ScriptsController extends \BaseController {

	protected $script;

	public function __construct(Script $script)
	{
                $this->beforeFilter('auth', ['only' => ['create', 'edit']]);
		$this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
		$this->script = $script;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$scripts = $this->script->all();

		return View::make('scripts.index', compact('scripts'));
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

		if( ! $this->script->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->script->errors);
		}
                
		$this->script->create($input);

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
		$script = $this->script->findOrFail($id);

		return View::make('scripts.show', compact('script'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
                $script = $this->script->findOrFail($id);
                
		return View::make('scripts.edit', compact('script'));
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

		if( ! $this->script->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->script->errors);
		}
                
                $update_fields = [
                    'title'     => $input['title'],
                    'body'      => $input['body'],
                    'script'    => $input['script']
                ];
              
		$this->script->where('id', '=', $id)->update($update_fields);

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
            $this->script->find($id)->delete();
            
            return Redirect::to('scripts')
				->with('message', 'Script removed!')
				->with('alert_class', 'alert-success');
	}

}