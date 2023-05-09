<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Purpose;

class ApiPurposeController extends Controller
{
    public function getPurpose()
    {
        $purpose = Purpose::get();
        return $this->sendResponse($purpose, true, "");
    }
}
