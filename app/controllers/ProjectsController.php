<?php

class ProjectsController extends \BaseController {

	protected $project;

	public function __construct(Project $project)
	{
                $this->beforeFilter('auth', ['only' => ['create', 'edit']]);
		$this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
		$this->project = $project;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->project->all();

		return View::make('projects.index', compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		if( ! $this->project->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->project->errors);
		}
                
		$this->project->create($input);

		return Redirect::to('projects')
				->with('message', 'New project created!')
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
		$project = $this->project->findOrFail($id);

		return View::make('projects.show', compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
                $project = $this->project->findOrFail($id);
                
		return View::make('projects.edit', compact('project'));
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

		if( ! $this->project->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->project->errors);
		}
                
                $update_fields = [
                    'title'     => $input['title'],
                    'body'      => $input['body'],
                ];
              
		$this->project->where('id', '=', $id)->update($update_fields);

		return Redirect::to('projects/'.$id)
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
            $this->project->find($id)->delete();
            
            return Redirect::to('projects')
				->with('message', 'Project removed!')
				->with('alert_class', 'alert-success');
	}

}