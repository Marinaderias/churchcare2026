<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Preparation;
use App\Models\Member;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return response()->json([

            'members' => Member::count(),

            'servants' => User::count(),

            'attendance_today' => Attendance::whereDate(
                'date',
                today()
            )->count(),

            'preparations' => Preparation::count()

        ]);
    }
}