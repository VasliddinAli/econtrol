<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Purpose;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{

    public function AttendanceBotView()
    {
        $attendances = Attendance::get();
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


    public function AttendanceView(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $attendance_type = $request->attendance_type;
        $first_type = $request->first_type;
        $full_date = $start_date . " - " . $end_date;
        $attendances = Attendance::orderBy('id', 'desc');
        if ($first_type != null) {
            if ($attendance_type != "null") {
                if ($attendance_type != 'all') {
                    $attendances = $attendances->where('type', $attendance_type);
                }
            }
            if ($first_type == 'date') {
                $attendances = $attendances->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . " 23:59:59"]);
            }
        }
        $attendances = $attendances->get()->each(function ($item) {
            $attendance = $item;
            $type = $attendance->type;
            if ($type == 'input') {
                $type = "Keldi";
            } elseif ($type == 'output') {
                $type = "Ketdi";
            }
            $attendance['type'] = $type;
        });

        return view('backend.attendance.attendance_view', compact('attendances', 'start_date', 'full_date', 'attendance_type'));
    }
}
