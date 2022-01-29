<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_variation extends Model
{
    use HasFactory;
    protected $table = 'products_variations';
    /**
     * @var array
     */
    protected $fillable = [
        'product_id', 'attribute_id', 'attribute_variation_id', 'variation_image', 'variation_quantity','variation_price', 'variation_description','variation_special_price',
    ];

    /**
     * @var array
     */
    protected $casts = [
        
    ];
}
