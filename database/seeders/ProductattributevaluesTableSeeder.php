<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productattributevalue;

class ProductattributevaluesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productattributevalue::create([
            'productattribute_id'      =>  1,
            'value'                    =>'S'
        ]);
        Productattributevalue::create([
            'productattribute_id'      =>  1,
            'value'                    =>'M'
        ]);
        Productattributevalue::create([
            'productattribute_id'      =>  2,
            'value'                    =>'Blue'
        ]);
        Productattributevalue::create([
            'productattribute_id'      =>  2,
            'value'                    =>'Red'
        ]);
    }
}
