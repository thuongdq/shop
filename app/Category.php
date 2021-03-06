<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $table = 'tdq68_categories';

    protected $fillable = [
        'name',
        'slug',
        'order',
        'parent',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description'
    ];

    public static function update_data($category ,$data){
        foreach ($data as $key=>$value){
            $category->$key = $value;
        }
        return $category->save();
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent', 'id');
    }

    public function products(){
        return $this->hasMany('App\Product', 'category_id', 'id');
    }
    public function news(){
        return $this->hasMany('App\News', 'category_id', 'id');
    }
}
