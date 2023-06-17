<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiDeviceController extends Controller
{
    public function getDevices()
    {
        $devices = Device::where('status', 'active')->get();
        return $this->sendResponse($devices, true, "");
    }
    public function addDevice(Request $request)
    {
        $phone = Str::after($request->phone, '+');
        $post = new Device();
        $post->name = $request->name;
        $post->phone = $phone;
        $post->password = $request->password;
        $post->save();
        return $this->sendResponse($post, true, "Device Created");
    }
    public function getDevice($id)
    {
        $device = Device::where('id', $id)->first();
        return $this->sendResponse($device, true, "show 1 element");
    }
    public function updateDevice(Request $request, $id)
    {
        $post = Device::where('id', $id)->first();
        $phone = Str::after($request->phone, '+');
        $post->name = $request->name;
        $post->phone = $phone;
        $post->password = $request->password;
        $post->save();
        return $this->sendResponse($post, true, "Device Updated");
    }
    public function deleteDevice($device_id)
    {
        $device = Device::findOrFail($device_id);
        $device->update([
            'status' => 'deleted'
        ]);
        return $this->sendResponse("", true, "Device Updated");
    }

    public function findDeviceByPassword(Request $request)
    {
        $device = Device::where('id', $request->id)->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Device is not found");
        } else {
            if (Hash::check($request->password, $device->password) === FALSE) {
                return $this->sendResponse(null, false, "Password is incorrect");
            } else {
                $token = Str::random(30);
                $device->update([
                    'token' => $token,
                ]);
                $device = Device::where('id', $device->id)->select('id', 'name', 'token')->first();
                return $this->sendResponse($device, true, "");
            }
        }
    }
}
