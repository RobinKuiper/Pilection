<?php

class Tag extends Eloquent
{

    protected $fillable = ['tag, s;ug'];
    protected $table = 'tags';

    public $errors;
    public static $rules = [];

    protected $tags = array();
    protected $item_id;

    public static $sluggable = array(
        'build_from' => 'tag',
        'save_to'    => 'slug',
    );

    public function itemcount($tag_id)
    {
        return count(DB::table('items-tags')->where('tag_id', '=', $tag_id)->get());
    }


    public function set($tags, $item_id)
    {
        $this->tags = explode(',', $tags);
        $this->item_id = $item_id;
    }

    public function saveTags()
    {
        foreach ($this->tags as $tag):
            $tag = trim($tag);
            if ($this->where('tag', '=', $tag)->count() == 0):
                $this->create(['tag' => $tag]);
            endif;

            $tag_id = $this->select('id')->where('tag', '=', $tag)->first()->id;

            DB::table('items-tags')->insert([
                'tag_id' => $tag_id,
                'item_id' => $this->item_id
            ]);
        endforeach;
    }

    public static function getTagsByItem($id)
    {
        $tags = DB::table('tags')
            ->join('items-tags', 'items-tags.tag_id', '=', 'tags.id')
            ->join('items', function ($join) use ($id) {
                $join->on('items.id', '=', 'items-tags.item_id')
                    ->where('items.id', '=', $id);
            })
            ->select('tags.*')
            ->get();

        return $tags;
    }

    public function getItemsByTag($tag)
    {
        $items = DB::table('items')
            ->join('items-tags', 'items-tags.item_id', '=', 'items.id')
            ->join('tags', function ($join) use ($tag) {
                $join->on('tags.id', '=', 'items-tags.tag_id')
                    ->where('tags.tag', '=', $tag);
            })
            ->select('items.*')
            ->get();

        return $items;
    }

    public function removeEmpty()
    {
        $tags = $this->all();

        foreach ($tags as $tag):
            if (DB::table('items-tags')->where('tag_id', '=', $tag->id)->count() == 0)
                $this->find($tag->id)->delete();
        endforeach;
    }
}
