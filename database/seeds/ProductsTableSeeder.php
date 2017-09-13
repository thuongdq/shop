<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Attachment;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $image = [
        ['p4', 'png', '[{"name":"Screen Size","value":"29.5 cm (11.6\")"},{"name":"Brands","value":"Acer"},{"name":"Screen Resolution","value":"1920 x 1080"},{"name":"Weight (Approximate)","value":"950 g"},{"name":"Operating System","value":"Windows 8 Single Language"}]'],
        ['56', 'jpg', '[{"name":"Type","value":"CMOS Sensor"},{"name":"Brands","value":"Canon"},{"name":"Image Format","value":"Approx. 22.3mm x 14.9mm (APS-C)"},{"name":"Recording Media","value":"SD card, SDHC card, SDXC memory card"},{"name":"Pixels","value":"Effective pixels: Approx. 18.0 megapixels"}]'],
        ['61', 'jpg', '[{"name":"Self-timer","value":"Approx. 10sec."},{"name":"Brands","value":"Sony"},{"name":"Face Detection","value":"Yes"},{"name":"Still Image Playback Options","value":"Slide Show"},{"name":"Color","value":"Black, Blue"}]'],
        ['15', 'jpg', '[{"name":"Weight (kg)","value":"0.26"},{"name":"Brands","value":"Apple"},{"name":"Height (mm)","value":"203mm"},{"name":"Type of Jack","value":"3.5mm"},{"name":"audio cable","value":"3.5mm"},{"name":"Color","value":"Black, Blue, Champagne, Matte Black, Metallic-sky, Pink, Red, Snarkitecture, titanium, White, Yellow"}]'],
        ['12', 'jpg', '[{"name":"Display Panel","value":"Yes"},{"name":"Brands","value":"Sony"},{"name":"Fast Playback","value":"About 5 times\/10 times"},{"name":"Recording pixels (photo, 16:9)","value":"Approx.13,500K pixels(16:9)"},{"name":"Wi-Fi","value":"Yes"},{"name":"Pixel Gross","value":"Approx.18,900K pixels"}]'],
        ['40', 'jpg', '[{"name":"Brands","value":"Fitbit"},{"name":"Depth","value":"1\/4\""},{"name":"width","value":"1\""},{"name":"Height","value":"1-1\/2\""},{"name":"Color","value":"Blue, Charcoal, Lime, Pink"}]'],
        ['53', 'jpg', '[{"name":"Hard disk","value":"Built-in"},{"name":"Brands","value":"Sony"},{"name":"Video","value":"BD6xCAV DVD 8xCAV"},{"name":"Internal Memory","value":"GDDR5 8GB"},{"name":"Processor Technology","value":"Low power x86-64 AMD \"Jaguar\", 8 cores"}]'],
        ['9', 'jpg', '[{"name":"Brands","value":"Sony"},{"name":"Labels","value":"Bestseller"},{"name":"Optical Zoom","value":"20x"},{"name":"Camera Type","value":"Compact zoom digital camera"},{"name":"Pixel Gross","value":"21.1 MP"},{"name":"Color","value":"Black, Red, White"}]'],
        ['27', 'jpg', '[{"name":"Brands","value":"Sony"},{"name":"Frequency Range","value":"2.4GHz (2.4000 \u2013 2.4835GHz)"},{"name":"Dimensions (Approx.)","value":"17 x 67 x 34mm"},{"name":"Weight (Approx.)","value":"26g"}]'],
        ['p25', 'png', '[{"name":"Antenna Terminal (FM 75 Ohm)","value":"Yes"},{"name":"Brands","value":"Sony"},{"name":"Labels","value":"New !"},{"name":"Tuner Type","value":"FM"},{"name":"Tuning","value":"FM: 87.5 MHz-108.0 MHz (100 kHzstep)"},{"name":"Supplied Cable","value":"3 Meters"}]'],
        ['p15', 'png', '[{"name":"Screen Size (measured diagonally)","value":"65\"(64.5\")"},{"name":"Brands","value":"Sony"},{"name":"Display Resolution","value":"QFHD"},{"name":"Viewing Angle (Up\/Down)","value":"89\/89 degree"},{"name":"3D","value":"Active"}]'],
        ['p21', 'png', '[{"name":"internal storage memory","value":"14.5GB"},{"name":"Brands","value":"Nokia"},{"name":"weighs","value":"160 grams"},{"name":"USB 2.0","value":"high-speed"}]'],
        ['p1', 'png', '[{"name":"Brands","value":"Sony"},{"name":"Screen Size","value":"14.0\""},{"name":"Resolution","value":"1920 x 1080"},{"name":"Max. Memory","value":"16GB"},{"name":"Color","value":"White"}]'],
        ['34', 'jpg', '[{"name":"Screen Size","value":"7-inch LCD display"},{"name":"Brands","value":"TVC"},{"name":"Resolution","value":"800 x 480 pixels"},{"name":"Operating System","value":"Windows CE 6.0"},{"name":"Processor","value":"Samsung 533 MHz processor"},{"name":"Memory","value":"128 MB DDRII"}]'],
        ['p23', 'png', '[{"name":"Screen Size (measured diagonally)","value":"50\"(49.5\")"},{"name":"Brands","value":"Sony"},{"name":"Finish (Surface Color)","value":"Black"},{"name":"Speaker Position","value":"Down Firing"},{"name":"3D","value":"Active"}]'],
        ['81', 'jpg', '[{"name":"Labels","value":"New !"},{"name":"Brands","value":"Dell"}]'],
        ['31', 'jpg', '[{"name":"Frequency Response","value":"45 \u2013 50,000 Hz"},{"name":"Brands","value":"Sony"},{"name":"Dimensions (Approx.)","value":"9 7\/16 x 33 7\/16 x 10 3\/8\" (240 x 850x 263mm) each"},{"name":"Weight (Approx.)","value":"24 lb, 14 oz (11.3kg) each"},{"name":"Sensitivity","value":"88 dB"}]'],
        ['p11', 'jpg', '[{"name":"S Operating System","value":"Windows 8 64-bit"},{"name":"Brands","value":"Acer"},{"name":"Processor","value":"Intel Celeron 1007U \/ 1.5 GHz \/ 2 MB Cache"},{"name":"Memory","value":"2 GB DDR3"},{"name":"Storage","value":"320 GB HDD"},{"name":"Display","value":"11.6\" LED backlight 1366 x 768 \/ HD"}]'],
        ['35', 'jpg', '[{"name":"Color","value":"Black, Pink, White"},{"name":"Brands","value":"Sony"},{"name":"Impedance","value":"6 Ohms :"},{"name":"Full Range Speaker Size","value":"Approximately 1-3\/8 in. (34 mm) diameter"},{"name":"Weight (Approx.)","value":"Approximately 4.8 oz. (135 g)"},{"name":"Dimensions (Approx.)","value":"Approximately 2-5\/8 inches x 2-3\/4 inches x 2-5\/8 inches (65 mm x 67.6 mm x 65 mm (w\/h\/d)"}]'],
    ];
    public $count = 0;
    public $list_parent = [];
    public function getCategory(){
        $category = rand(81, 151);
        if(in_array($category, $this->list_parent)){
            return $this->getCategory();
        }else{
            return $category;
        }
    }
    public function run()
    {
//        $list_parent_obj = \App\Category::where([
//            ['id', '<>', 1],
//            ['id', '<>', 2],
//            ['parent', '=', 0]
//        ])->get();
//        foreach ($list_parent_obj as $parent){
//            $this->list_parent_arr[] = $parent->id;
//            $child = \App\Category::where('parent',$parent->id)->get();
//            foreach ($child as $child_parent){
//                $has_child = \App\Category::where('parent',$child_parent->id)->get();
//                if($has_child){
//                    $this->list_parent_arr[] = $parent->id;
//                }
//            }
//        }

        $list_parent_obj = \App\Category::where([
            ['id', '<>', 1],
            ['id', '<>', 2],
            ['parent', '=', 0]
        ])->get();
        foreach ($list_parent_obj as $parent){
            $this->list_parent[] = $parent->id;
            $child = \App\Category::where('parent',$parent->id)->get();
            foreach ($child as $child_parent){
                $has_child = \App\Category::where('parent',$child_parent->id)->get()->toArray();
                if(!empty($has_child)){
                    $this->list_parent[] = $child_parent->id;
                }
            }
        }

        factory(Product::class, 100)->create()->each(function ($product){
            $product->category_id = $this->getCategory();
            $file = $this->image[$this->count];
            $product->image = 'products/'.$file[0].'.'.$file[1];
            $product->attributes = $file[2];
            $product->save();
            $folder = "/uploads";
            for ($i = 1; $i<15; $i++){
                $path = 'products/'.$file[0].'.'.$i.'.'.$file[1];
                if(file_exists(public_path("$folder/$path"))){
                    Attachment::create([
                        'type' => 'image',
                        'mime' => 'image/png',
                        'path' => $path,
                        'product_id' => $product->id
                    ]);
                }else{
                    break;
                }
            }
            $this->count++;
            if($this->count == count($this->image)){
                $this->count = 0;
            }

            $product->save();
            //  Tag
            $arr = [];
            for($i = 0; $i <= rand(0, 2); $i++){
                if($i == 0){
                    $arr[] = rand(1, 15);
                }

                if($i == 1){
                    $arr[] = rand(16, 35);
                }

                if($i == 2){
                    $arr[] = rand(36, 50);
                }
            }
            $product->tags()->sync($arr);
        });
    }
}
