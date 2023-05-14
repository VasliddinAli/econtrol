<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Purpose;

class ApiPurposeController extends Controller
{
    public function getPurpose()
    {
        $device = Device::where(['status' => 'active', 'token' => $this->getToken()])->first();
        if ($device == null) {
            return $this->sendResponse(null, false, "Not Found Device", 401);
        }
        $purpose = Purpose::get();
        return $this->sendResponse($purpose, true, "");
    }
}
