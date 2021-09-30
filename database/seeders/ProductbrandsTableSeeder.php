<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Productbrand;

class ProductbrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Productbrand::create([
            'name'      =>  'Jockey',
            'slug'      =>  'jockey',
            'description'=>'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.'
        ]);
        Productbrand::create([
            'name'      =>  'Vimal',
            'slug'      =>  'vimal',
            'description'=>'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.'
        ]);
        Productbrand::create([
            'name'      =>  'Raymond',
            'slug'      =>  'raymond',
            'description'=>'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Ciceros De Finibus Bonorum et Malorum for use in a type specimen book.'
        ]);
    }
}
