<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(SlidersTableSeeder::class);
        $this->call(TestimonialsTableSeeder::class);
        $this->call(ClientelesTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
        $this->call(GalleriesTableSeeder::class);
        $this->call(Blog_CategoriesTableSeeder::class);
        $this->call(Blog_TagsTableSeeder::class);
        $this->call(BlogsTableSeeder::class);
        /*$this->call(ProductcategoriesTableSeeder::class);
        $this->call(ProductbrandsTableSeeder::class);
        $this->call(ProductattributesTableSeeder::class);
        $this->call(ProductattributevaluesTableSeeder::class);*/
    }
}
