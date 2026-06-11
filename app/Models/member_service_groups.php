<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member_service_groups extends Model
{
    
    public function members()
{
    return $this->belongsToMany(
        Member::class,
        'member_service_groups'
    );
}
}

