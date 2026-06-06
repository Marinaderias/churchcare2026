<?php

namespace App\Models;
use App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     protected $fillable = [
        'member_id',
        'date',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
