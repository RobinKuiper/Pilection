<?php

class PagesController extends BaseController
{

    protected $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function home()
    {
        $items['systems']['latest'] = Item::where('type', '=', 'systems')->latest()->take(3)->get();
        $items['scripts']['latest'] = Item::where('type', '=', 'scripts')->latest()->take(3)->get();
        $items['projects']['latest'] = Item::where('type', '=', 'projects')->latest()->take(3)->get();

        /*$items['systems']['top'] = $this->rating->getRatingByType('systems');
        $items['scripts']['top'] = $this->rating->getRatingByType('scripts');
        $items['projects']['top'] = $this->rating->getRatingByType('projects');*/

        return View::make('pages/home2', ['active' => 'home', 'items' => $items]);
    }

    public function about()
    {
        return View::make('pages/about', ['active' => 'about']);
    }

    public function test()
    {
        $rating = [
            'item_id' => 1,
            'score' => 4,
            'ip' => Request::getClientIp()
        ];

        $result = Rating::where('item_id', '=', $rating['item_id'])->where('ip', '=', $rating['ip'])->count();

        if ($result == 0)
            Rating::create($rating);
    }

}