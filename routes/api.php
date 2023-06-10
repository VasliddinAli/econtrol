<?php

use App\Http\Controllers\API\ApiAttendsController;
use App\Http\Controllers\API\ApiDeviceController;
use App\Http\Controllers\API\ApiEmployeeController;
use App\Http\Controllers\API\ApiPurposeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('device')->group(function () {
    Route::get('list', [ApiDeviceController::class, 'getDevices']);
    // Route::post('add', [ApiDeviceController::class, 'addDevice']);
    // Route::get('{id}/detail', [ApiDeviceController::class, 'getDevice']);
    // Route::post('{id}/update', [ApiDeviceController::class, 'updateDevice']);
    // Route::get('{id}/delete', [ApiDeviceController::class, 'deleteDevice']);
    Route::post('find', [ApiDeviceController::class, 'findDeviceByPassword']);
});
Route::prefix('employee')->group(function () {
    Route::get('list', [ApiEmployeeController::class, 'getEmployees']);
    Route::post('add', [ApiEmployeeController::class, 'addEmployee']);
    Route::get('detail/{id}', [ApiEmployeeController::class, 'getEmployee']);
    Route::post('update/{id}', [ApiEmployeeController::class, 'updateEmployee']);
    Route::get('delete/{id}', [ApiEmployeeController::class, 'deleteEmployee']);
    Route::get('{pinCode}/find', [ApiEmployeeController::class, 'findEmployeeByPinCode']);
});
Route::prefix('attendance')->group(function () {
    Route::get('list', [ApiAttendsController::class, 'getAttendance']);
    Route::post('add', [ApiAttendsController::class, 'addAttends']);
    Route::post('add/offline', [ApiAttendsController::class, 'addAttendsOffline']);
    Route::post('late/purpose', [ApiAttendsController::class, 'forLatePurpose']);
});
Route::prefix('purpose')->group(function () {
    Route::get('list', [ApiPurposeController::class, 'getPurpose']);
});
