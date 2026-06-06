<?php

namespace App\Models;
use App\Models\Member;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
        protected $fillable = [
        'member_id',
        'user_id',
        'visit_date',
        'notes'
    ];

     public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

   
