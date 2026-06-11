<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    protected $fillable = [

        'user_id',

        'title',

        'content',

        'type',

        'media'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}