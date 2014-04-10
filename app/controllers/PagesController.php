<?php

class PagesController extends BaseController {
    
        public function home()
        {
            $items['systems']['latest'] = System::latest()->take(5)->get();
            $items['scripts']['latest'] = Script::latest()->take(5)->get();
            $items['projects']['latest'] = Project::latest()->take(5)->get();
            
            return View::make('pages/home', compact('items'));
        }

	public function about()
	{
            return View::make('pages/about');
	}

}