<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";
    protected $fillable = [
        'title','description','meta_tags','meta_description','image','content','status','user_id','category_id'
    ];
    use HasFactory;
}
