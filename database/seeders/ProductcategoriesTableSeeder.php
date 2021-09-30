<?php

namespace Database\Seeders;

use App\Models\Productcategory;

use Illuminate\Database\Seeder;

class ProductcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productcategory::create([
            'name'      =>  'Cloths',
            'slug'      =>  'cloths',
            'description'=>'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.'
        ]);
        Productcategory::create([
            'name'      =>  'Electronics',
            'slug'      =>  'electronics',
            'description'=>'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.'
        ]);
        Productcategory::create([
            'name'      =>  'Groccery',
            'slug'      =>  'groccery',
            'description'=>'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.'
        ]);
    }
}
