<?php

namespace App\Models;
use App\Models\ServiceGroup;
use App\Models\Attendance;
use App\Models\Visit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Member extends Model
{
protected $fillable = [
    'name',
    'phone',
    'birth_date',
    'address',
    'school',
    'stage',
    'father_name',
    'mother_name',
    'confession_father',
    'notes',
    'member_code'
];

  public function serviceGroups()
{
    return $this->belongsToMany(
        ServiceGroup::class,
        'member_service_groups'
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

    protected static function booted()
{
    static::creating(function ($member) {

        $lastId = self::max('id') + 1;

        $member->member_code =
            'MEM-' . str_pad($lastId, 6, '0', STR_PAD_LEFT);

    });
}
}
