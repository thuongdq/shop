<?php

use Illuminate\Database\Seeder;
use App\News;
use App\Attachment;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $list_parent = [];
    public function getCategory(){
        $category = rand(3, 80);
        if(in_array($category, $this->list_parent)){
            return $this->getCategory();
        }else{
            return $category;
        }
    }
    public function run()
    {
        $list_parent_obj = \App\Category::where('parent',2)->get();
        foreach ($list_parent_obj as $parent){
            $has_child = \App\Category::where('parent',$parent->id)->get()->toArray();
            if(!empty($has_child)){
                $this->list_parent[] = $parent->id;
            }
        }
        factory(News::class, 200)->create()->each(function ($news){
            $news->category_id = $this->getCategory();
            $news->save();
        });
    }
}
