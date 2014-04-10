<?php

class SystemsController extends \BaseController {

	protected $item;
        protected $views;

	public function __construct(System $item, Views $views)
	{
                $this->beforeFilter('auth', ['only' => ['create', 'edit']]);
		$this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
		$this->item = $item;
                $this->views = $views;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = $this->item->all();

		return View::make('systems.index', compact('items'));
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

		if( ! $this->item->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->item->errors);
		}
                
                if( !empty($input['image'])){
                    if( ! $input['image'] = $this->item->saveImage($input['image']))
                    {
                        return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
                    }
                }
                
		$this->item->create($input);

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
		$item = $this->item->findOrFail($id);
                
                // Update viewcount
                $this->views->updateViews($id, 'system');
                
                // Get viewcount
                $item->viewcount = $this->views->getViews($id, 'system');
                
                if($item->image == null){
                    $item->path = 'images/';
                    $item->image = 'system_default.png';
                }else $item->path = 'upload/systems/images/';

		return View::make('systems.show', compact('item'));
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
                
		return View::make('systems.edit', compact('item'));
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
                    'website'   => $input['website'],
                    'download'  => $input['download'],
                ];
                
                if( !empty($input['image'])){
                    if( ! $input['image'] = $this->item->saveImage($input['image']))
                    {
                        return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
                    }
                    
                    $update_fields = ['image' => $input['image']];
                }
              
		$this->item->where('id', '=', $id)->update($update_fields);

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
            $this->item->find($id)->delete();
            
            return Redirect::to('/')
				->with('message', 'System removed!')
				->with('alert_class', 'alert-success');
	}

}