<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tag
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @mixin \Eloquent
 */
class Tag extends Model
{
    protected $table = 'tdq68_tags';

    protected $fillable = [
        'name',
        'slug'
    ];
    public function products(){
        return $this->belongsToMany('App\Product', 'tdq68_product_tag', 'tag_id', 'product_id');
    }
    public function news(){
        return $this->belongsToMany('App\News', 'tdq68_news_tag', 'tag_id', 'news_id');
    }
}
