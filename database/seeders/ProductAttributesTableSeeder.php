<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        ProductAttribute::create([
            'name'        =>'Color' ,
            'code'        =>'color',
        ]);
        ProductAttribute::create([
            'name'        =>'Size' ,
            'code'        =>'size',
        ]);
    }
}
