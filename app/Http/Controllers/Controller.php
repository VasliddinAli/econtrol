<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // const API_ACCESS_KEY = "AAAASttaBW8:APA91bG5MSbmJu17KSJ6uyrh2phxLwqIVhc4dazGxznNBzgP2Dd-bbBokx5qSptHWaAFhX3y65NgbOI427KzRKlbGr-lSnoIwjhFl7su4VK_ScECykbtKAKmkrJsltLwOxFqD-uRk2pT";
    // const API_KEY = '5989425380:AAHyv9jEf9-rxtXC3g5DRw9JRB8dunpfcvA';


    public function sendResponse($result, $success = NULL, $message = NULL, $error_code = 0)
    {
        $response = [
            'success' => $success,
            'data' => $result,
            'message' => $message,
            'error_code' => $error_code,
        ];
        return response()->json($response, 200);
    }

    public function getApiKey()
    {
        $headers = getallheaders();
        return (isset($headers['Key'])) ? $headers['Key'] : 'no_key';
    }

    public function getLang()
    {
        $headers = getallheaders();
        return (isset($headers['Lang'])) ? $headers['Lang'] : 'uz';
    }

    public function getToken()
    {
        $headers = getallheaders();
        return (isset($headers['Token'])) ? $headers['Token'] : 'no_token';
    }

}
