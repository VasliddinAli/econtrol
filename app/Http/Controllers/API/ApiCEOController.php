<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CEO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiCEOController extends Controller
{
    public function getCeos()
    {
        $ceo = CEO::where('status', 'active')->get();
        return $this->sendResponse($ceo, true, "");
    }
    public function addCeo(Request $request)
    {
        $phone = Str::after($request->phone, '+');
        $ceo = new CEO();
        $ceo->name = $request->name;
        $ceo->phone = $phone;
        $ceo->password = Hash::make($request->password);
        $ceo->save();
        return $this->sendResponse($ceo, true, "CEO Created");
    }
    public function updateCeo(Request $request, $id)
    {
        $ceo = CEO::where('id', $id)->first();
        $phone = Str::after($request->phone, '+');
        $ceo->name = $request->name;
        $ceo->phone = $phone;
        $ceo->save();
        return $this->sendResponse($ceo, true, "CEO Updated");
    }
    public function deleteCeo($ceo_id)
    {
        $ceo = CEO::findOrFail($ceo_id);
        $ceo->update([
            'status' => 'deleted'
        ]);
        return $this->sendResponse("", true, "CEO deleted");
    }
    // public function ceoLogin(Request $request)
    // {
    //     $ceo = CEO::where('phone', $request->phone)->first();
    //     $hashPassword = Hash::check($request->password);
    //     if ($ceo != null) {
    //         return $this->sendResponse(null, true, "This user is CEO");
    //     } else {
    //         return $this->sendResponse(null, false, "Password is incorrect!");
    //     }
    // }

    public function ceoLogin(Request $request)
    {
        $ceo = CEO::where('phone', $request->phone)->where('status', '!=', 'deleted')->first();
        if ($ceo == null) {
            return $this->sendResponse(null, false, "CEO is not defined", 1);
        } else {
            if (Hash::check($request->password, $ceo->password) === FALSE) {
                return $this->sendResponse(null, false, "Password is incorrect!");
            } else {
                $token = Str::random(30);
                $ceo->update([
                    'token' => $token,
                ]);

                $ceo = CEO::where('id', $ceo->id)->first();

                return $this->sendResponse($ceo, true, "");
            }
        }
    }
}
