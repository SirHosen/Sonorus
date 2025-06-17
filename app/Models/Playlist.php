<?php
// app/Models/Playlist.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'description', 'cover_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class)
            ->withPivot('order')
            ->orderBy('order')
            ->withTimestamps();
    }
}
