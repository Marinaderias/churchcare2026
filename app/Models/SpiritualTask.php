<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpiritualTask extends Model
{
    protected $fillable = [

        'title',
        'active'
    ];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'task_user',
            'task_id',
            'user_id'
        )->withPivot(
            'completed',
            'completed_at'
        );
    }
}