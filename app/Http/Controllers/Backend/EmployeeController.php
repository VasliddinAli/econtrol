<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function employeeView()
    {
        $employees = Employee::where('status', '!=', 'deleted')->get();
        return view('backend.employee.employee_view', compact('employees'));
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

    public function employeeStore(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'position' => 'required',
                'status' => 'required',
                'phone' => 'required|unique:employees',
            ],
            [
                'name.required' => 'Employee nomini kiriting',
                'position.required' => 'Holatni belgilang',
                'status.required' => 'Status kiriting',
                'phone.required' => 'Telefon nomer kiriting',
                'phone.unique' => 'Telefon mavjud',
            ]
        );

        $pin = $this->checkEmployeePin();
        $pin_code = str_pad($pin, 4, "0", STR_PAD_LEFT);
        $phone = Str::after($request->phone, '+');

        Employee::create([
            'name' => $request->name,
            'position' => $request->position,
            'status' => $request->status,
            'phone' => $phone,
            'pin_code' => $pin_code,
            'qrcode' => "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$pin_code",
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Xodim muvaffaqiyatli qo\'shildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function employeeEdit($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        return view('backend.employee.employee_edit', compact('employee'));
    }

    public function employeeUpdate(Request $request, $employee_id)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Xodim nomini kiriting',
            ]
        );
        $employee = Employee::where('id', $employee_id)->first();
        $phone = Str::after($request->phone, '+');
        $employee->update([
            'name' => $request->name,
            'position' => $request->position,
            'status' => $request->status,
            'phone' => $phone,
        ]);

        $notification = array(
            'message' => 'Xodim muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.employee')->with($notification);
    }

    public function employeeDelete($employee_id)
    {
        $device = Employee::findOrFail($employee_id);
        $device->update([
            'status' => 'deleted'
        ]);
        $notification = array(
            'message' => 'Xodim muvaffaqiyatli o\'chirildi!',
            'alert-type' => 'info'
        );
        return redirect()->route('all.employee')->with($notification);
    }

    public function employeeShow($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $warnings = Attendance::where(['employee_id' => $employee_id, 'warning' => 1])->get();
        return view('backend.employee.employee_detail', compact('employee', 'warnings'));
    }

    public function employeeUpdateLogin(Request $request, $employee_id)
    {
        $request->validate(
            [
                'phone' => 'required',
                'pin_code' => 'required|unique:employees',
            ],
            [
                'phone.required' => 'Telefon kiriting',
                'pin_code.required' => 'Parolni kiriting',
                'pin_code.unique' => 'Ushbu pin koddan avval foydalanilgan!',
            ]
        );

        $employee = Employee::where('id', $employee_id)->first();
        $pin = Employee::where('pin_code', $request->pin_code)->first();
        $pin_str = str_pad($request->pin_code, 4, "0", STR_PAD_LEFT);

        if ($pin == null) {
            $employee->update([
                'phone' => $request->phone,
                'pin_code' => $pin_str,
                'qrcode' => "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$pin_str"
            ]);
        }
        //  else {
        //     $notification = array(
        //         'message' => 'Ushbu pin koddan avval foydalanilgan!',
        //         'alert-type' => 'warning'
        //     );
        //     return redirect()->back()->with($notification);
        // }

        $notification = array(
            'message' => 'Xodim logini muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.employee')->with($notification);
    }
}
