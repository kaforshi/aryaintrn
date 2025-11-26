<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'name',
        'icon_class',
        'url',
        'color_class',
        'type',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
