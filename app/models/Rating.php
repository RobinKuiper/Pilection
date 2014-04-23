<?php

class Rating extends \Eloquent
{
    protected $fillable = ['user_id', 'item_id', 'rating', 'ip', 'type'];

    public static function getRatingForItem($item_id)
    {
        $ratings = Rating::where('item_id', '=', $item_id)->get();

        return Rating::getRating($ratings);
    }

    public function getRatingByType($type)
    {
        $items = $this->where('type', '=', $type)->get();

        if (count($items) > 0) {
            foreach ($items as $item):
                $rating[$item->item_id]['rating'] = $this->getRatingForItem($item->item_id);
                $rating[$item->item_id]['item'] = Item::where('id', '=', $item->item_id)->first()->toArray();
            endforeach;

            return $rating;
        }
    }

    public static function countRatings($item_id)
    {
        return count(Rating::where('item_id', '=', $item_id)->get());
    }

    private static function getRating($ratings)
    {
        $score = 0;
        if (count($ratings) > 0) {
            foreach ($ratings as $rating):
                $score += $rating->rating;
            endforeach;

            return $score / count($ratings);
        }

        return $score;
    }

    public static function voted($item_id)
    {
        $count = Rating::where('item_id', '=', $item_id)->where('ip', '=', Request::getClientIp())->count();

        if ($count == 0) return false;
        else return true;
    }
}