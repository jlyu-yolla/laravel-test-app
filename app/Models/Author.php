<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // MassAssignmentException 
    // fillable allows attribute to be mass asigned when creating/updating author instance
    protected $fillable = ['name'];
    
    public function books()
    {
        return $this->hasMany(Book::class); //Eloquent ORM 1:N relationship
    }
}
