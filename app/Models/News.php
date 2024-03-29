<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function news_category(){
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'news_id');
    }
}
