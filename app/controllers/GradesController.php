<?php

class GradesController extends \BaseController
{

    protected $grade; protected $user;
    protected $views; protected $tag;
    protected $item;

    public function __construct(Grade $grade, Tag $tag, User $user, Views $views, Item $item)
    {
        $this->grade    = $grade;
        $this->tag      = $tag;
        $this->user     = $user;
        $this->views    = $views;
        $this->item     = $item;
    }

    public function index($grade)
    {
        $items = $this->item->all();
        $tags = $this->tag->all();
        $grades = $this->grade->all();

        foreach($items as $item):
            $item_info[$item->id]['tags'] = '';
            foreach($this->tag->getTagsByItem($item->id) as $tag):
                $item_info[$item->id]['tags'] .= $tag->tag . ' ';
            endforeach;

            $item_info[$item->id]['grade'] = $item->hasOne('Grade', 'id', 'grade')->first()->grade;
            $item_info[$item->id]['views'] = $this->views->getViews($item->id, $item->type);

            $user = $this->user->find($item->user_id);
            $item_info[$item->id]['user'] = $user['attributes']['username'];
        endforeach;

        $breadcrumb = 'grades';

        return View::make('items.index', [
            'breadcrumb'    => $breadcrumb,
            'title'         => $grade,
            'items'         => $items,
            'item_info'     => $item_info,
            'tags'          => $tags,
            'grades'        => $grades,
            'filter'        => $grade
        ]);

    }
}