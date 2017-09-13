<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attachment[] $attachments
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $table = 'tdq68_products';

    protected $fillable = [
        'name',
        'code',
        'slug',
        'content',
        'regular_price',
        'sale_price',
        'original_price',
        'quantity',
        'attributes',
        'image',
        'category_id',
        'user_id',
        'status',
        'views',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'tdq68_product_tag', 'product_id', 'tag_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order', 'tdq68_product_order', 'product_id', 'order_id')->withPivot('quantity')->withTimestamps();
    }

    public function attachments(){
        return $this->hasMany('App\Attachment', 'product_id', 'id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'product_id', 'id');
    }
}
