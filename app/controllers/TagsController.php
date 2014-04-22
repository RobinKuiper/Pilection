<?php

class TagsController extends \BaseController
{

    protected $grade; protected $user;
    protected $views; protected $tag;
    protected $item;

    public function __construct(Grade $grade, Tag $tag, User $user, Views $views, Item $item)
    {
        $this->beforeFilter('auth', ['only' => ['create', 'edit']]);

        $this->grade    = $grade;
        $this->tag      = $tag;
        $this->user     = $user;
        $this->views    = $views;
        $this->item     = $item;
    }

    public function index($tag)
    {
        $items = $this->item->all();
        $tags = $this->tag->all();
        $grades = $this->grade->all();

        foreach($items as $item):
            $item_info[$item->id]['tags'] = '';
            foreach($this->tag->getTagsByItem($item->id) as $tag_):
                $item_info[$item->id]['tags'] .= $tag_->tag . ' ';
            endforeach;

            $item_info[$item->id]['grade'] = $item->hasOne('Grade', 'id', 'grade')->first()->grade;
            $item_info[$item->id]['views'] = $this->views->getViews($item->id, $item->type);

            $user = $this->user->find($item->user_id);
            $item_info[$item->id]['user'] = $user['attributes']['username'];
        endforeach;

        $breadcrumb = 'tags';

        return View::make('items.index', [
            'breadcrumb'    => $breadcrumb,
            'title'         => $tag,
            'items'         => $items,
            'item_info'     => $item_info,
            'tags'          => $tags,
            'grades'        => $grades,
            'filter'        => $tag
        ]);

    }
}