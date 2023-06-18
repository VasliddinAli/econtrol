<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Device;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiEmployeeController extends Controller
{
    public function getEmployees()
    {
        $employees = Employee::where('status', '!=', 'deleted')->get();
        return $this->sendResponse($employees, true, "");
    }

    public function getEmployee($id)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $employee = Employee::get()->each(function ($item) {
            $employee = $item;
            $employee['employee_name'] = $employee->employee->name;
            $employee['purpose_name'] = $employee->purpose == null ? null : $employee->purpose->purpose;
            $employee['device_name'] = $employee->device->name;
            unset($employee->employee, $employee->purpose, $employee->device);
        });
        $warnings = Attendance::where(['employee_id' => $id, 'warning' => 1])->get();
        $employee['warnings'] = $warnings;
        return $this->sendResponse($employee, true, "");
    }

    public function generateEmployeePin()
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $pin_code = rand(1, 9999);
        $pin = Employee::where('pin_code', $pin_code)->first();
        if ($pin == null) {
            return $pin_code;
        } else {
            return $this->generateEmployeePin();
        }
    }

    public function addEmployee(Request $request)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $employee = new Employee();
        $phone = Str::after($request->phone, '+');
        $pin = $this->generateEmployeePin();
        $pin_code = str_pad($pin, 4, "0", STR_PAD_LEFT);
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->status = $request->status;
        $employee->phone = $phone;
        $employee->pin_code = $pin_code;
        $employee->qrcode = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$pin_code";
        $employee->save();
        return $this->sendResponse($employee, true, "Employee Created");
    }

    public function checkEmployeePin($pin_code)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $pin = Employee::where('pin_code', $pin_code)->first();
        if ($pin == null) {
            return $pin_code;
        } else {
            return false;
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        if ($this->checkEmployeePin($request->pin_code) == false) {
            return $this->sendResponse(null, false, "Pin kod avval ishlatilgan qayta uruning");
        } else {
            $employee = Employee::where('id', $id)->first();
            $phone = Str::after($request->phone, '+');
            $pin = $this->checkEmployeePin($request->pin_code);
            $pin_code = str_pad($pin, 4, "0", STR_PAD_LEFT);
            $employee->name = $request->name;
            $employee->position = $request->position;
            $employee->status = $request->status;
            $employee->phone = $phone;
            $employee->pin_code = $pin_code;
            $employee->qrcode = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$pin_code";
            $employee->save();
            return $this->sendResponse($employee, true, "Employee Updated");
        }
    }

    public function deleteEmployee($employee_id)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $employee = Employee::findOrFail($employee_id);
        $employee->update([
            'status' => 'deleted'
        ]);
        return $this->sendResponse("", true, "Employee Deleted");
    }

    public function findEmployeeByPinCode($pin_code)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $employee = Employee::where('pin_code', $pin_code)->select('id', 'name', 'position')->first();
        if ($employee != null) {
            return $this->sendResponse($employee, true, "There is an employee.");
        } else {
            return $this->sendResponse(null, false, "Pin code is incorrect. Try again!");
        }
    }
}
