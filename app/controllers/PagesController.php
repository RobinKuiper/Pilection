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
        /*$items['systems']['latest'] = Item::where('type', '=', 'systems')->latest()->take(3)->get();
        $items['scripts']['latest'] = Item::where('type', '=', 'scripts')->latest()->take(3)->get();
        $items['projects']['latest'] = Item::where('type', '=', 'projects')->latest()->take(3)->get();

        $items['systems']['top'] = $this->rating->getRatingByType('systems');
        $items['scripts']['top'] = $this->rating->getRatingByType('scripts');
        $items['projects']['top'] = $this->rating->getRatingByType('projects');*/

        $reddit['hot'] = json_decode(file_get_contents('http://www.reddit.com/r/raspberry_pi/hot.json?limit=10'));
        $reddit['top'] = json_decode(file_get_contents('http://www.reddit.com/r/raspberry_pi/top.json?limit=10'));
        $reddit['new'] = json_decode(file_get_contents('http://www.reddit.com/r/raspberry_pi/new.json?limit=10'));
        //$twitter = json_decode(file_get_contents('https://api.twitter.com/1.1/search/tweets.json?q=iphone'));

        return View::make('pages/home3', ['active' => 'home', /*'items' => $items,*/ 'reddit' => $reddit]);
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