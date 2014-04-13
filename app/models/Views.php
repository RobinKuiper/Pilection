<?php

class Views extends \Eloquent
{
    protected $fillable = ['item_id', 'ip', 'type'];

    public function updateViews($item_id, $type, $get = false)
    {
        $ip = Request::getClientIp();

        $count = $this->where('item_id', '=', $item_id)
            ->where('type', '=', $type)
            ->where('ip', '=', $ip)
            ->count();

        if ($count == 0)
            $this->create([
                'item_id' => $item_id,
                'type' => $type,
                'ip' => $ip
            ]);

        if ($get)
            return Views::getViews($item_id, $type);
    }

    public static function getViews($item_id, $type)
    {
        return Views::where('item_id', '=', $item_id)
            ->where('type', '=', $type)
            ->count();
    }
}