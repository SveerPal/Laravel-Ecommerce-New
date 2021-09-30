<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Gallery;

class GalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Gallery::create([
            'name'         =>  $faker->company,
            'link'         =>  $faker->url ,
        ]);

        $faker2 = Faker::create();
        Gallery::create([
            'name'         =>  $faker2->company,
            'link'         =>  $faker2->url ,
        ]);

        $faker3 = Faker::create();
        Gallery::create([
            'name'         =>  $faker3->company,
            'link'         =>  $faker3->url ,
        ]);
    }
}
