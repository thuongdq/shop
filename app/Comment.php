<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'tdq68_comments';

    protected $fillable = [
        'name',
        'email',
        'content',
        'product_id',
        'rating'
    ];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function news(){
        return $this->belongsTo('App\News', 'new_id', 'id');
    }
}
