<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Purpose;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiAttendancesController extends Controller
{
    public function getAttendance()
    {
        $attendances = Attendance::get();
        return $this->sendResponse($attendances, true, "");
    }

    public function checkDate()
    {
        $time = Carbon::now();
        $now_time = Carbon::now()->timestamp;
        $check_time = Carbon::create($time->year, $time->month, $time->day, 8, 0, 0)->timestamp;
        if ($now_time > $check_time) {
            return false;
        } else {
            return true;
        }
    }

    public function addAttends(Request $request)
    {
        $moment = true;
        $date = $this->checkdate();
        $purposes = [];

        if(!$date && $request->type == 'input'){
            $moment = false;
            $purposes = Purpose::select('id', 'purpose')->get();
        }
        $employee = Employee::where('id', $request->employee_id)->select('id', 'name', 'position')->first();
        $file = $request->file('image');
        $imageName = time() . '.' . $file->extension();
        $imagePath = public_path() . '/upload/images';
        $image = 'upload/images/' . $imageName;
        $file->move($imagePath, $imageName);

        $attendance = new Attendance();
        $attendance->type = $request->type;
        $attendance->image = $image;
        $attendance->date = Carbon::now();
        $attendance->employee_id = $request->employee_id;
        $attendance->device_id = $request->device_id;
        $attendance->save();
        
        $response = [
            'employee' => $employee,
            'now_time' => Carbon::now()->format('H:i'),
            'moment' => $moment,
            'purposes' => $purposes,
            'attendance_id' => $attendance->id,
        ];
        return $this->sendResponse($response, true, "");
    }

    public function forLatePurpose(Request $request){
        $attendance = Attendance::where([
            'id' => $request->attendance_id,
            'employee_id' => $request->employee_id,
            'device_id' => $request->device_id
        ])->first();
        if($attendance != null){
            $attendance->update(['purpose_id' => $request->purpose_id]);
            return $this->sendResponse(null, true, "");
        }else{
            return $this->sendResponse(null, false, "Mavjud bo'lmagan hisobot");
        }
    }
}
