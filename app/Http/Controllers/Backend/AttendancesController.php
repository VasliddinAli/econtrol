<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Device;
use App\Models\Purpose;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{

    public function AttendanceBotView()
    {
        $attendances = Attendance::get()->each(function ($item) {
            $attendance = $item;
            $type = $attendance->type;
            if ($type == 'input') {
                $type = "Keldi";
            } elseif ($type == 'output') {
                $type = "Ketdi";
            }
            $attendance['type'] = $type;
        });
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
        $attendance_device = $request->attendance_device;
        $attendance_purpose_id = $request->attendance_purpose_id;
        $first_type = $request->first_type;
        $full_date = $start_date . " - " . $end_date;
        $attendances = Attendance::orderBy('id', 'desc');
        if ($first_type != null) {
            if ($attendance_type != "null") {
                if ($attendance_type != 'all') {
                    $attendances = $attendances->where('type', $attendance_type);
                }
            }
            if ($attendance_device != "null") {
                if ($attendance_device != 'all') {
                    $attendances = $attendances->where('device_id', $attendance_device);
                }
            }
            if ($attendance_purpose_id != "null") {
                if ($attendance_purpose_id != 'all') {
                    $attendances = $attendances->where('purpose_id', $attendance_purpose_id);
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

        $devices = Device::all();
        $purposes = Purpose::all();

        return view('backend.attendance.attendance_view', compact('attendances', 'start_date', 'full_date', 'attendance_type', 'attendance_device', 'attendance_purpose_id', 'devices', 'purposes'));
    }

    public function AddWarning(Request $request)
    {
        $attendance = Attendance::where('id', $request->id)->first();
        if ($attendance->warning != true) {
            $attendance->warning = true;
            $attendance->save();
            $notification = array(
                'message' => 'Hodimga ogohlantirish berildi!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $attendance->warning = null;
            $attendance->save();
            $notification = array(
                'message' => 'Ogohlantirish qaytarildi!',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    }
}
