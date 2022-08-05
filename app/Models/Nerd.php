<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nerd extends Model
{
    protected $fillable = [
        'type',
        'code',
        'name',
        'nick',
        'email',
        'photo',
        'oauth',
    ];

    protected $casts = [
        'oauth' => 'json',
        'meta' => 'json',
        'info' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}
