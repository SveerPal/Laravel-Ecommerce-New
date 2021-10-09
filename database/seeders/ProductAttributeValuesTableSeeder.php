<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductAttributeValue;

class ProductAttributeValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductAttributeValue::create([
            'product_attribute_id'    =>  1,
            'name'                    =>'Red',
            'code'                    =>'red'
        ]);
        ProductAttributeValue::create([
            'product_attribute_id'    =>  1,
            'name'                    =>'Blue',
            'code'                    =>'blue'
        ]);
        ProductAttributeValue::create([
            'product_attribute_id'    =>  2,
            'name'                    =>'X',
            'code'                    =>'x'
        ]);
        ProductAttributeValue::create([
            'product_attribute_id'    =>  2,
            'name'                    =>'M',
            'code'                    =>'m'
        ]);
    }
}
