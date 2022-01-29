<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsVariations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_variations', function (Blueprint $table) {
            $table->bigIncrements('id');  
            $table->unsignedInteger('product_id'); 
            $table->unsignedInteger('attribute_id')->index()->nullable();
            $table->unsignedInteger('attribute_variation_id')->index()->nullable();
            $table->string('variation_image');            
            $table->unsignedInteger('variation_quantity');
            $table->decimal('variation_price', 8, 2)->nullable();
            $table->decimal('variation_special_price', 8, 2)->nullable();
            $table->text('variation_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_variations');
    }
}
