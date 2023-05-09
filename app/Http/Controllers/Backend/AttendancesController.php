<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendancesController extends Controller
{
    public function AttendanceView()
    {
        $attendances = Attendance::get();
        return view('backend.attendance.attendance_view', compact('attendances'));
    }
    public function AttendanceBotView()
    {
        $attendances = Attendance::get();
        return view('bot_view', compact('attendances'));
    }
}
