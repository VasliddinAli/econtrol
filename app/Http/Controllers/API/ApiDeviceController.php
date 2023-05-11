<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
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
}
