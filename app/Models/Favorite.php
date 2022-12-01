<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable=[ 'user_id', 'book_id'];
    use HasFactory;

    public function user(){
        $this->hasMany(User::class);
    }
    public function book(){
        $this->hasMany(Book::class);
    }
}
