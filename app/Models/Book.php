<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['name', 'summary', 'ISBN', 'photo', 'pages', 'category_id'];
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function favorite(){
        return $this->belongsTo(Favorite::class);
    }

    public function scopefindByName($query, $name){
        if($name){
            return $query->where('name','like',"%$name%");
        }else
            return $query;
    }

}
