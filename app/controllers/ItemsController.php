<?php

class ItemsController extends \BaseController
{

    protected $item;
    protected $views;
    protected $tag;
    protected $grade;
    protected $type;
    protected $rating;
    protected $user;

    public function __construct(Item $item, Views $views, Tag $tag, Grade $grade, Rating $rating, User $user, Type $type)
    {
        $this->beforeFilter('type');
        $this->beforeFilter('auth', ['only' => ['create', 'edit', 'update', 'store']]);
        $this->beforeFilter('user', ['only' => ['update', 'edit', 'destroy']]);
        $this->beforeFilter('csrf', ['only' => ['store', 'destroy', 'update']]);
        $this->user = $user;
        $this->item = $item;
        $this->views = $views;
        $this->tag = $tag;
        $this->grade = $grade;
        $this->rating = $rating;
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($type, $attr=null)
    {
        $items = $this->item->all();
        $tags = Conner\Tagging\Tag::where('count', '>', 0)->get();
        $grades = $this->grade->all();
        $types = $this->type->all();

        $breadcrumb = ($type == 'grade') ? 'grades' : ($type == 'tag') ? 'tags' : 'items';

        $vars = [
            'breadcrumb'    => $breadcrumb,
            'title'         => ($type == 'grade') ? $attr : ($type == 'tag') ? $attr : $type,
            'items'         => $items,
            'active'        => $type,
            'tags'          => $tags,
            'grades'        => $grades,
            'types'         => $types,
            'filter'        => ($type == 'grade') ? $attr : ($type == 'tag') ? $attr : $type,
        ];

        if($type != 'grade' OR $type != 'tag')
            $vars['type'] = $type;

        return View::make('items.index', $vars);
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
        $input['user_id'] = Auth::user()->id;

        if (!$this->item->fill($input)->isValid()) {
            return Redirect::back()->withInput()->withErrors($this->item->errors);
        }

        $item = $this->item->create($input);

        $tags = explode(',', $input['tags']);

        foreach($tags as $tag):
            $tag = trim($tag);
            $item->tag($tag);
        endforeach;

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

        $item = $this->item->findOrFail($id);

        $item->title        = $input['title'];
        $item->body         = $input['body'];
        $item->website_url  = $input['website_url'];
        $item->download_url = $input['download_url'];
        $item->grade_id     = $input['grade_id'];
        $item->type_id      = $input['type_id'];

        if($input['image'] != null)
        {
            $item->image->clear();
            $item->image = $input['image'];
        }

        $tags = explode(',', $input['tags']);
        $old_tags = explode(',', $input['old_tags']);

        foreach($old_tags as $tag):
            $tag = trim($tag);
            $item->untag($tag);
        endforeach;

        foreach($tags as $tag):
            $tag = trim($tag);
            $item->tag($tag);
        endforeach;

        $item->save();

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
        $item = $this->item->find($id);

        foreach($item->tagNames() as $tag):
            $item->untag($tag);
        endforeach;

        $this->item->find($id)->delete();

        return Redirect::to($type)
            ->with('message', 'System removed!')
            ->with('alert_class', 'alert-success');
    }

}
