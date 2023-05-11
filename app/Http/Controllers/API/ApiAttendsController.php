<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class ApiAttendsController extends Controller
{
    public function getAttendance()
    {
        $attendances = Attendance::get();
        return $this->sendResponse($attendances, true, "");
    }

    public function addAttends(Request $request)
    {
        $file = $request->file('image');
        $imageName = time() . '.' . $file->extension();
        $imagePath = public_path() . '/upload/images';
        $image = 'upload/images/' . $imageName;
        $file->move($imagePath, $imageName);

        $attendance = new Attendance();
        $attendance->type = $request->type;
        $attendance->image = $image;
        $attendance->date = $request->date;
        $attendance->employee_id = $request->employee_id;
        $attendance->device_id = $request->device_id;
        $attendance->save();
        return $this->sendResponse(null, true, "");
    }

    public function forLatePurpose(Request $request)
    {
        $attendance = Attendance::where([
            'id' => $request->attendance_id,
            'employee_id' => $request->employee_id,
            'device_id' => $request->device_id
        ])->first();
        if ($attendance != null) {
            $attendance->update(['purpose_id' => $request->purpose_id]);
            return $this->sendResponse(null, true, "");
        } else {
            return $this->sendResponse(null, false, "Mavjud bo'lmagan hisobot");
        }
    }
}
