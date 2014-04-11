<?php

class ItemsController extends \BaseController {
    
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
	public function index($type)
	{
            $items = $this->item->where('type', '=', $type)->get();

            return View::make('items.index', ['type' => $type, 'items' => $items, 'active' => $type]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($type)
	{
            return View::make('items.create', ['type' => $type, 'active' => $type]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($type)
	{
            $input = Input::all();
                $input['type'] = $type;

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
                
		$item = $this->item->create($input);
                
                $this->tag->set($input['tags'], $item->id);
                $this->tag->saveTags();

		return Redirect::to($type)
				->with('message', 'New system created!')
				->with('alert_class', 'alert-success');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($type, $id)
	{
            $item = $this->item->findOrFail($id);
                
            // Update viewcount
            $this->views->updateViews($id);

            // Get viewcount
            $item->viewcount = $this->views->getViews($id);

            if($item->image == null){
                $item->path = 'images/';
                $item->image = 'system_default.png';
            }else $item->path = 'upload/items/images/';
            
            $item->tags = $this->tag->getTagsByItem($id);

            return View::make('items.show', ['type' => $type, 'item' => $item, 'active' => $type]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($type, $id)
	{
            $item = $this->item->findOrFail($id);
                
            return View::make('items.edit', ['type' => $type, 'item' => $item, 'active' => $type]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($type, $id)
	{
                $input = Input::all();

		if( ! $this->item->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->item->errors);
		}
                
                $update_fields = [
                    'title'     => $input['title'],
                    'body'      => $input['body'],
                    'website_url'   => $input['website'],
                    'download_url'  => $input['download'],
                ];
                
                if( !empty($input['image'])){
                    if( ! $input['image'] = $this->item->saveImage($input['image']))
                    {
                        return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
                    }
                    
                    $update_fields = ['image' => $input['image']];
                }
              
		$this->item->where('id', '=', $id)->update($update_fields);

		return Redirect::to($type.'/'.$id)
				->with('message', 'System updated!')
				->with('alert_class', 'alert-success');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($type, $id)
	{
            $this->item->find($id)->delete();
            DB::table('items-tags')->where('item_id', '=', $id)->delete();
            
            return Redirect::to($type)
				->with('message', 'System removed!')
				->with('alert_class', 'alert-success');
	}

}