<?php

class AjaxController extends \BaseController {

	public function getRating()
	{
        $rating = [
            'item_id'   => Input::get('id'),
            'rating'     => Input::get('score'),
            'ip'        => Request::getClientIp(),
            'type'      => Input::get('type')
        ];
        //$user = (Auth::check()) ? 'AND user_id = '.Auth::user()->id : '';
        $count = Rating::where('item_id', '=', $rating['item_id'])->where('ip', '=', $rating['ip'])->count();

        if($count == 0){
            Rating::create($rating);
            echo "Your vote is save, thank you!";
        }else
            echo "You have already voted on this item.";
	}

}