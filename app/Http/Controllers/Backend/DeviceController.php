<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeviceController extends Controller
{
    public function deviceView()
    {
        $devices = Device::where('status', 'active')->get();
        return view('backend.device.device_view', compact('devices'));
    }

    public function deviceStore(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'phone' => 'required|unique:devices',
                'password' => 'required',
            ],
            [
                'name.required' => 'Device nomini kiriting',
                'phone.required' => 'Telefonni kiriting',
                'phone.unique' => 'Telefon mavjud',
                'password.required' => 'Parolni kiriting',
            ]
        );
        $password = Hash::make($request->password);

        Device::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $password,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Device muvaffaqiyatli qo\'shildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deviceEdit($device_id)
    {
        $device = Device::findOrFail($device_id);
        return view('backend.device.device_edit', compact('device'));
    }

    public function deviceUpdate(Request $request, $device_id)
    {

        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Device nomini kiriting',
            ]
        );
        $device = Device::where('id', $device_id)->first();
        $device->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $notification = array(
            'message' => 'Device muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.device')->with($notification);
    }

    public function deviceDelete($device_id)
    {
        $device = Device::findOrFail($device_id);
        $device->update([
            'status' => 'deleted'
        ]);
        $notification = array(
            'message' => 'Device muvaffaqiyatli o\'chirildi!',
            'alert-type' => 'info'
        );
        return redirect()->route('all.device')->with($notification);
    }

    public function deviceShow($device_id)
    {
        $device = Device::where('id', $device_id)->first();
        return view('backend.device.device_detail', compact('device'));
    }

    public function deviceUpdateLogin(Request $request, $device_id)
    {

        $request->validate(
            [
                'phone' => 'required',
                'password' => 'required',
            ],
            [
                'phone.required' => 'Telefon kiriting',
                'password.required' => 'Parolni kiriting',
            ]
        );
        $password = Hash::make($request->password);

        $device = Device::where('id', $device_id)->first();

        $device->update([
            'phone' => $request->phone,
            'password' => $password,
        ]);

        $notification = array(
            'message' => 'Device logini muvaffaqiyatli o\'zgartirildi!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
