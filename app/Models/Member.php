<?php

namespace App\Models;
use App\Models\ServiceGroup;
use App\Models\Attendance;
use App\Models\Visit;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
       protected $fillable = [
        'name',
        'phone',
        'birth_date',
        'address',
        'school',
        'notes'
    ];

    public function serviceGroups()
    {
        return $this->belongsToMany(
            ServiceGroup::class,
            'member_service_group'
        );
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function users()
    {
    return $this->belongsToMany(
        User::class,
        'member_user'
    );
    }
}
