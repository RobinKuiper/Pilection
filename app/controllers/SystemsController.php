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
                
                if( !empty($input['image'])){
                    if( ! $input['image'] = $this->system->saveImage($input['image']))
                    {
                        return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
                    }
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
                
                if($system->image == null){
                    $system->path = 'images/';
                    $system->image = 'system_default.png';
                }else $system->path = 'upload/systems/images/';

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
                $system = $this->system->findOrFail($id);
                
		return View::make('systems.edit', compact('system'));
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

		if( ! $this->system->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->system->errors);
		}
                
                $update_fields = [
                    'title'     => $input['title'],
                    'body'      => $input['body'],
                    'website'   => $input['website'],
                    'download'  => $input['download'],
                ];
                
                if( !empty($input['image'])){
                    if( ! $input['image'] = $this->system->saveImage($input['image']))
                    {
                        return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
                    }
                    
                    $update_fields = ['image' => $input['image']];
                }
              
		$this->system->where('id', '=', $id)->update($update_fields);

		return Redirect::to('systems/'.$id)
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
            $this->system->find($id)->delete();
            
            return Redirect::to('/')
				->with('message', 'System removed!')
				->with('alert_class', 'alert-success');
	}

}