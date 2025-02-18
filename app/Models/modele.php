<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modele extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'modeles' => 'array',
        'images' => 'array',
    ];
}
