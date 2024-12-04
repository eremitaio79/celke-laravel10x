<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // PE79: Providing the table name is a good ideia and good practice.
    protected $table = 'courses';

    // PE79: Columns that can be registered.
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'status',
    ];

    // PE79: The relationship between course and classes. A course has many classes.
    public function classe()
    {
        return $this->hasMany(Classe::class);
    }
}
