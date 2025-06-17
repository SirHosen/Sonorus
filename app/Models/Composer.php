<?php
// app/Models/Composer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'biography', 'birth_year', 'death_year', 'country', 'photo'
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
