<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Productattribute;


class ProductattributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productattribute::create([
            'name'      =>  'Size',
            'code'      =>  'size'
        ]);
        Productattribute::create([
            'name'      =>  'Color',
            'code'      =>  'color'
        ]);
       
    }
}
