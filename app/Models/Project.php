<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'url',
        'github_url',
        'tags',
        'order',
    ];

    protected $casts = [
        'tags' => 'array',
        'order' => 'integer',
    ];
}
