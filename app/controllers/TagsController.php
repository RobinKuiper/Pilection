<?php

class TagsController extends \BaseController
{

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
    public function index($tag)
    {
        $items = $this->tag->getItemsByTag($tag);
        $breadcrumb = 'tags';

        return View::make('items.index_grid', ['breadcrumb' => $breadcrumb, 'title' => $tag, 'items' => $items]);
    }
}