<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
       protected $fillable = [
        'name',
        'description',
        'servant_name'
    ];

       public function users()
    {
        return $this->belongsToMany(
            User::class,
            'group_user'
        );
    }

    public function members()
    {
        return $this->belongsToMany(
            Member::class,
            'member_service_group'
        );
    }
}
