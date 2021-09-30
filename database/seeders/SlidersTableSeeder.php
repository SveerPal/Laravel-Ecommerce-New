<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slider::create([
            'name'      =>  'Slider 1',
            'heaading_first'      =>  'Slider First'
        ]);
        Slider::create([
            'name'      =>  'Slider 2',
            'heaading_first'      =>  'Slider Second'
        ]);
        
    }
}
