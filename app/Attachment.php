<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Attachment
 *
 * @property-read \App\Product $product
 * @mixin \Eloquent
 */
class Attachment extends Model
{
    protected $table = 'tdq68_attachments';
    protected $fillable = [
        'type',
        'mime',
        'path',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
