<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    //allow mass assignment when updating book instance
    protected $fillable = ['title', 'author_id', 'year', 'genre'];

    public function author()
    {
        return $this->belongsTo(Author::class); // N:1 relationship
    }
}
