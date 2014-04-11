<?php

class Tag extends Eloquent{

	protected $fillable = ['tag'];
	protected $table = 'tags';

	public $errors;
	public static $rules = [	];
        
        protected $tags = array();
        protected $item_id;


        public function set($tags, $item_id)
        {
            $this->tags = explode(',', $tags);
            $this->item_id = $item_id;
        }
        
        public function saveTags() 
        {
            foreach($this->tags as $tag):                
                if($this->where('tag', '=', $tag)->count() == 0):
                    $this->create(['tag' => $tag]);
                endif;
                
                $tag_id = $this->select('id')->where('tag', '=', $tag)->first()->id;
                
                DB::table('items-tags')->insert([
                   'tag_id'     => $tag_id,
                   'item_id'    => $this->item_id
               ]);
            endforeach;
        }
        
        public function getTagsByItem($id)
        {
            $tag_ids = DB::table('items-tags')->select('tag_id')->where('item_id', '=', $id)->get();
            
            foreach($tag_ids as $tag_id):
                $tags[] = $this->select('tag')->where('id', '=', $tag_id->tag_id)->first();
            endforeach;
            
            return $tags;
        }
        
        public function getItemsByTag($tag)
        {
            $tag_id = $this->select('id')->where('tag', '=', $tag)->first();
            $item_ids = DB::table('items-tags')->select('item_id')->where('tag_id', '=', $tag_id->id)->get();
            
            foreach($item_ids as $item):
                $items[] = Item::where('id', '=', $item->item_id)->first()->toArray();
            endforeach;
            
            return $items;
        }
}