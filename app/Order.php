<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $table = 'tdq68_orders';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'email',
        'phone'
    ];
    public function products(){
        return $this->belongsToMany('App\Product', 'tdq68_product_order', 'order_id', 'product_id')->withPivot('quantity')->withTimestamps();
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
