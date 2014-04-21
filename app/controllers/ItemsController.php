<?php

class ItemsController extends \BaseController
{

    protected $item;
    protected $views;
    protected $tag;
    protected $rating;

    public function __construct(Item $item, Views $views, Tag $tag, Rating $rating)
    {
        $this->beforeFilter('type');
        $this->beforeFilter('auth', ['only' => ['create', 'edit', 'update', 'store']]);
        $this->beforeFilter('user', ['only' => ['update', 'edit', 'destroy']]);
        $this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
        $this->item = $item;
        $this->views = $views;
        $this->tag = $tag;
        $this->rating = $rating;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($type)
    {
        $items = $this->item->where('type', '=', $type)->get();
        $breadcrumb = 'items';

        return View::make('items.index', ['breadcrumb' => $breadcrumb, 'title' => $type, 'items' => $items, 'type' => $type, 'active' => $type]);

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
        $input['user_id'] = Auth::user()->id;

        if (!$this->item->fill($input)->isValid()) {
            return Redirect::back()->withInput()->withErrors($this->item->errors);
        }

        if (!empty($input['image'])) {
            if (!$input['image'] = $this->item->saveImage($input['image'])) {
                return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
            }
        }

        $item = $this->item->create($input);

        $this->tag->set($input['tags'], $item->id);
        $this->tag->saveTags();

        return Redirect::to($type . '/' . $item->slug)
            ->with('message', 'New system created!')
            ->with('alert_class', 'alert-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($type, $id)
    {
        if (preg_match('/^[1-9][0-9]*$/', $id)):
            $item = $this->item->findOrFail($id);
        else:
            $item = $this->item->where('slug', '=', $id)->first();
        endif;

        // Update viewcount
        $item->viewcount = $this->views->updateViews($item->id, $type, 1);

        if ($item->image == null) {
            $item->path = 'images/';
            $item->image = 'system_default.png';
        } else $item->path = 'upload/items/images/';

        $item->tags = $this->tag->getTagsByItem($item->id);
        $item->rating = $this->rating->getRatingForItem($item->id);
        $item->voted = $this->rating->voted($item->id);

        return View::make('items.show', ['type' => $type, 'item' => $item, 'active' => $type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return Response
     */
    public function update($type, $id)
    {
        $input = Input::all();

        if (!$this->item->fill($input)->isValid()) {
            return Redirect::back()->withInput()->withErrors($this->item->errors);
        }

        $update_fields = [
            'title' => $input['title'],
            'body' => $input['body'],
            'website_url' => $input['website_url'],
            'download_url' => $input['download_url'],
            'grade' => $input['grade'],
        ];

        if (!empty($input['image'])) {
            if (!$input['image'] = $this->item->saveImage($input['image'])) {
                return Redirect::back()->withInput()->withErrors(['image' => 'Something went wrong with the image, try again or contact the administrator.']);
            }

            $update_fields = ['image' => $input['image']];
        }

        $this->item->where('id', '=', $id)->update($update_fields);

        return Redirect::to($type . '/' . $id)
            ->with('message', 'System updated!')
            ->with('alert_class', 'alert-success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($type, $id)
    {
        $this->item->find($id)->delete();
        DB::table('items-tags')->where('item_id', '=', $id)->delete();
        $this->tag->removeEmpty();

        return Redirect::to($type)
            ->with('message', 'System removed!')
            ->with('alert_class', 'alert-success');
    }

}