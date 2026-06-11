<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiritualTask extends Model
{
    protected $fillable = [

        'title',

        'week_number',

        'month',

        'year',

        'created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'task_user'
        )
        ->withPivot(
            'completed',
            'completed_at'
        )
        ->withTimestamps();
    }
}