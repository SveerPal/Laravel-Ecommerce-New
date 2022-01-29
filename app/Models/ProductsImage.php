<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    use HasFactory;
     /**
     * @var string
     */
    protected $table = 'products_images';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'thumbnail', 'full'];

    /**
     * @var array
     */
    protected $casts = [
        'product_id'    =>  'integer',
    ];
}
