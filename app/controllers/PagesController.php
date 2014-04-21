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
        return View::make('pages/about', ['active' => 'about', 'title' => 'About']);
    }

    public function test()
    {
        Mail::send('emails.auth.validation', ['token' => 'test', 'id' => 'test'], function($message)
        {
            $message->to('robingjkuiper@gmail.com', 'Robin Kuiper (RobinKuiper)')->subject('Welcome to Pilection!');
        });
    }

}