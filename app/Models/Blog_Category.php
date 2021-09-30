<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Category extends Model
{
    use HasFactory;

    protected $table = 'blog_categories';
    
    protected $fillable = [
        'name','slug','parent_id','featured','menu','banner','meta_title','meta_description','meta_keywords','description','alt'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];
}
