<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Str;

class BlogsTableSeeder extends Seeder
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
        Blog::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,$name,false),
            'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,false,false,false),
            'alt'         =>$name,
            'blog_category_id'    =>1,
            'blog_tag_id'        =>1,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        Blog::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,$name,false),
            'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,false,false,false),
            'alt'         =>$name,
            'blog_category_id'    =>1,
            'blog_tag_id'        =>2,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        Blog::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,$name,false),
            'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,false,false,false),
            'alt'         =>$name,
            'blog_category_id'    =>2,
            'blog_tag_id'        =>3,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
       

    }
}
