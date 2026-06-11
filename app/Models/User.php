<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\ServiceGroup;
use App\Models\Announcement;
use App\Models\Visit;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'address',
        'birth_date',
        'job',
        'confession_father',
        'image'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function serviceGroups()
    {
        return $this->belongsToMany(
            ServiceGroup::class,
            'group_user'
        );
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function members()
   {
    return $this->belongsToMany(
        Member::class,
        'member_user'
    );
   }

   public function spiritualTasks()
{
    return $this->belongsToMany(
        SpiritualTask::class,
        'task_user'
    )
    ->withPivot(
        'completed',
        'completed_at'
    )
    ->withTimestamps();
}

   public function preparations()
{
    return $this->hasMany(
        Preparation::class
    );
}
}