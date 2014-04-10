<?php

class Views extends \Eloquent {
	protected $fillable = ['item_id', 'ip'];
        
        public function updateViews($item_id)
        {
            $ip = Request::getClientIp();
            
            $count = $this->where('item_id', '=', $item_id)
                    ->where('ip', '=', $ip)
                    ->count();
            
            if($count == 0)
                $this->create([
                    'item_id'   => $item_id,
                    'ip'        => $ip
                ]);
        }
        
        public static function getViews($item_id)
        {
            return Views::where('item_id', '=', $item_id)
                    ->count();
        }
}