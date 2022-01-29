<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('product_type');
            $table->string('sku')->unique();
            $table->string('image');
            $table->string('gallery')->nullable();
            $table->unsignedInteger('brand_id')->index()->nullable();
            $table->string('category_id')->index()->nullable();
            $table->decimal('price', 8, 2);
            $table->decimal('special_price', 8, 2)->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->decimal('weight', 8, 2)->nullable();            
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->boolean('featured')->default(0)->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            //$table->foreign('brand_id')->references('id')->on('product_brands')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
