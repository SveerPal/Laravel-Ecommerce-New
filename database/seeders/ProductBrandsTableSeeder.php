<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductBrand;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Str;

class ProductBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('en_EN');
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        ProductBrand::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,$name,false),
           // 'banner'      =>$faker->image(public_path('storage/uploads/ecommerce/product_brand'),1920,605,false,false,false),
            'alt'         =>$name,
            'featured'    =>1,
            'menu'        =>0,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        ProductBrand::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
            //'banner'      =>$faker->image(public_path('storage/uploads/ecommerce/product_brand'),1920,605,false,false,false),
            'alt'         =>$name,
            'featured'    =>1,
            'menu'        =>1,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        ProductBrand::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
            //'banner'      =>$faker->image(public_path('storage/uploads/ecommerce/product_brand'),1920,605,false,false,false),
            'alt'         =>$name,
            'featured'    =>0,
            'menu'        =>0,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
    }
}
