<?php

class PagesController extends BaseController {
    
        public function home()
        {
            /*$items['systems']['latest'] = Items::getLatest('systems')->take(5)->get();
            $items['scripts']['latest'] = Items::getLatest('scripts')->take(5)->get();
            $items['projects']['latest'] = Items::getLatest('projects')->take(5)->get();
            
            return View::make('pages/home', compact('items'));*/
            return 'home';
        }

	public function about()
	{
            return View::make('pages/about', ['active' => 'about']);
	}

}