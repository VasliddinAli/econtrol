<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiEmployeeController extends Controller
{
    public function getEmployees()
    {
        $employees = Employee::where('status', 'active')->get();
        return $this->sendResponse($employees, true, "");
    }
    public function checkEmployeePin()
    {
        $pin_code = rand(1, 9999);
        $pin = Employee::where('pin_code', $pin_code)->first();
        if ($pin == null) {
            return $pin_code;
        } else {
            return $this->checkEmployeePin();
        }
    }
    public function addEmployee(Request $request)
    {
        $employee = new Employee();
        $pin = $this->checkEmployeePin();
        $pin_code = str_pad($pin, 4, "0", STR_PAD_LEFT);
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->status = $request->status;
        $employee->phone = $request->phone;
        $employee->pin_code = $pin_code;
        $employee->save();
        return $this->sendResponse($employee, true, "Employee Created");
    }
    public function getEmployee($id)
    {
        $employee = Employee::where('id', $id)->first();
        return $this->sendResponse($employee, true, "show 1 element");
    }
    public function updateEmployee(Request $request, $id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->status = $request->status;
        $employee->phone = $request->phone;
        $employee->pin_code = $request->pin_code;
        $employee->save();
        return $this->sendResponse($employee, true, "Employee Updated");
    }
    public function deleteEmployee($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $employee->update([
            'status' => 'deleted'
        ]);
        return $this->sendResponse("", true, "Employee Deleted");
    }
    public function findEmployeeByPinCode($pin_code)
    {
        $employee = Employee::where('pin_code', $pin_code)->select('id', 'name', 'position')->first();
        if ($employee != null) {
            return $this->sendResponse($employee, true, "There is an employee.");
        } else {
            return $this->sendResponse(null, false, "Pin code is incorrect. Try again!");
        }
    }
}
