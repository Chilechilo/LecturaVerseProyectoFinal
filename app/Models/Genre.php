<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function readings()
    {
        return $this->hasMany(Reading::class);
    }
}