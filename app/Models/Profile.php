<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'username',
        'avatar',
        'description',
        'typewriter_words',
        'email',
        'views',
        'verified',
        'status_online',
        'footer_text',
    ];

    protected $casts = [
        'typewriter_words' => 'array',
        'verified' => 'boolean',
        'status_online' => 'boolean',
        'views' => 'integer',
    ];

    public static function getActive()
    {
        return self::first() ?? self::create([
            'name' => 'Rae',
            'username' => 'sleepyrae',
            'description' => 'Just a sleepy developer making things on the web. Into anime, coffee, and dark mode.',
            'typewriter_words' => ['Web Developer', 'Sleepy', 'UI/UX Designer', 'Gamer'],
            'email' => 'contact@sleepyrae.dev',
            'verified' => true,
            'status_online' => true,
            'footer_text' => '© 2024 hypeproject.dev style clone',
        ]);
    }
}
