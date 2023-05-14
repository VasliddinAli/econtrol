<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Device;
use App\Models\Employee;
use App\Models\Purpose;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiAttendsController extends Controller
{
    public function getAttendance()
    {
        $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Not Found Device", 401);
        }
        $attendances = Attendance::get();
        return $this->sendResponse($attendances, true, "");
    }

    public function checkDate()
    {
        $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Not Found Device", 401);
        }
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
        $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Not Found Device", 401);
        }
        $moment = true;
        $date = $this->checkdate();
        $purposes = [];
        if (!$date && $request->type == 'input') {
            $moment = false;
            $purposes = Purpose::select('id', 'purpose')->get();
        }
        $employee = Employee::where('id', $request->employee_id)->select('id', 'name', 'position')->first();
        $files = $request->file('image');
        $file = Str::random(20);
        $ext = strtolower($files->getClientOriginalExtension());
        $file_full_name = $file . '.' . $ext;
        $upload_path = 'upload/images/';
        $save_url_file = $upload_path . $file_full_name;
        $success = $files->move($upload_path, $file_full_name);

        $attendance = new Attendance();
        $attendance->type = $request->type;
        $attendance->image = $save_url_file;
        $attendance->date = Carbon::now();
        $attendance->late = $moment == true ? true : null;
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

    public function addAttendsOffline(Request $request)
    {
        $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Not Found Device", 401);
        }
        $files = $request->file('image');
        $file = Str::random(20);
        $ext = strtolower($files->getClientOriginalExtension());
        $file_full_name = $file . '.' . $ext;
        $upload_path = 'upload/images/';
        $save_url_file = $upload_path . $file_full_name;
        $success = $files->move($upload_path, $file_full_name);

        Attendance::insert([
            'type' => $request->type,
            'image' => $save_url_file,
            'date' => $request->date,
            'employee_id' => $request->employee_id,
            'device_id' => $request->device_id,
            'purpose_id' => $request->purpose_id > 0 ? $request->purpose_id : null
        ]);
        return $this->sendResponse(null, true, "");
    }

    public function forLatePurpose(Request $request)
    {
        $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Not Found Device", 401);
        }
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
