<?php

class PagesController extends BaseController {
    
        public function home()
        {
            $items['systems']['latest'] = Item::where('type', '=', 'systems')->latest()->take(5)->get();
            $items['scripts']['latest'] = Item::where('type', '=', 'scripts')->latest()->take(5)->get();
            $items['projects']['latest'] = Item::where('type', '=', 'projects')->latest()->take(5)->get();
            
            return View::make('pages/home', ['active' => 'home', 'items' => $items]);
        }

	public function about()
	{
            return View::make('pages/about', ['active' => 'about']);
	}

}