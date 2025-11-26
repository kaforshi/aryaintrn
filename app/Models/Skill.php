<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'icon_class',
        'color_class',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
