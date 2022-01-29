<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog_Tag;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Str;
class Blog_TagsTableSeeder extends Seeder
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
        Blog_Tag::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,$name,false),
          //  'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,false,false,false),
            'alt'         =>$name,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        Blog_Tag::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,false,false,false),
            'alt'         =>$name,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
        $name=$faker->sentence;
        $description=$faker->text;
        $name=$faker->sentence;
        Blog_Tag::create([
            'name'        =>$name ,
            'slug'        =>str_slug($name),
            'description' => $description.$description,
           // 'banner'      =>$faker->image(public_path('storage/uploads/blogs'),1920,605,false,false,false),
            'alt'         =>$name,
            'meta_title'  =>$name,
            'meta_description' =>$description,
            'meta_keywords' =>implode(',',$faker->words($nb = 3, $asText = false)),
        ]);
    }
}
