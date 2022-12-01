<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=['name'];
    use HasFactory;

    public function book(){
        return $this->hasMany(Book::class);
    }

}
