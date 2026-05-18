<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $fillable = [
        'user_id',
        'genre_id',
        'title',
        'author',
        'type',
        'status',
        'total_units',
        'current_unit',
        'rating',
        'cover_url',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
}