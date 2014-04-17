<?php

class AjaxController extends \BaseController
{

    public function getRating()
    {
        $rating = [
            'item_id' => Input::get('id'),
            'rating' => Input::get('score'),
            'ip' => Request::getClientIp(),
            'type' => Input::get('type')
        ];
        //$user = (Auth::check()) ? 'AND user_id = '.Auth::user()->id : '';
        $count = Rating::where('item_id', '=', $rating['item_id'])->where('ip', '=', $rating['ip'])->count();

        if ($count == 0) {
            Rating::create($rating);
            echo "Your vote is saved, thank you!";
        } else
            echo "You have already voted on this item.";
    }

    public function getTags()
    {
        $q = Input::get('term');

        $search = Item::whereRaw("match(title) against('+{$q}*' IN BOOLEAN MODE)")->get();

        foreach( $search as $results => $item):
            $items[] = ['id' => $item->id, 'value' => $item->title, 'type' => $item->type, 'slug' => $item->slug];
        endforeach;

        return json_encode($items);
    }

}