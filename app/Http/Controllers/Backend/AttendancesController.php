<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Purpose;

class AttendancesController extends Controller
{
    public function AttendanceView()
    {
        $attendances = Attendance::get();
        return view('backend.attendance.attendance_view', compact('attendances'));
    }

    public function AttendanceBotView()
    {
        $attendances = Attendance::orderBy('id', 'DESC')->get();
        
        return view('backend.attendance.bot_view', compact('attendances'));
    }

    public function AttendanceDelete($id)
    {
        $attendace = Attendance::where('id', $id)->first();
        unlink($attendace->image);
        $attendace->delete();
        $notification = array(
            'message' => 'Davomat muvaffaqiyatli o\'chirildi!',
            'alert-type' => 'info'
        );
        return redirect()->route('all.attendance')->with($notification);
    }
}
