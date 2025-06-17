<?php
// app/Models/Song.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'composer_id', 'year', 'duration', 'description', 'audio_file', 'cover_image'
    ];

    public function composer()
    {
        return $this->belongsTo(Composer::class);
    }
}
