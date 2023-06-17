<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function getEmployee($id)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $employee = Employee::where('id', $id)->first();
        return $this->sendResponse($employee, true, "show 1 element");
    }

    public function updateEmployee(Request $request, $id)
    {
        // $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        // if ($device == null) {
        //     return $this->sendResponse(null, false, "Not Found Device", 401);
        // }
        $employee = Employee::where('id', $id)->first();
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
        return $this->sendResponse($employee, true, "Employee Updated");
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
