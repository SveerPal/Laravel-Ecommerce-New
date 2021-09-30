<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Tag extends Model
{
    use HasFactory;
    protected $table = 'blog_tags';

    protected $fillable = [
        'name','slug','featured','menu','banner','meta_title','meta_description','meta_keywords','description','alt'
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
