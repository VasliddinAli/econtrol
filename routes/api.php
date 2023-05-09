<?php

use App\Http\Controllers\API\ApiAttendancesController;
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
    Route::post('add', [ApiDeviceController::class, 'addDevice']);
    Route::get('{id}/detail', [ApiDeviceController::class, 'getDevice']);
    Route::post('{id}/update', [ApiDeviceController::class, 'updateDevice']);
    Route::get('{id}/delete', [ApiDeviceController::class, 'deleteDevice']);
});
Route::prefix('employee')->group(function () {
    Route::get('list', [ApiEmployeeController::class, 'getEmployees']);
    Route::post('add', [ApiEmployeeController::class, 'addEmployee']);
    Route::get('{id}/detail', [ApiEmployeeController::class, 'getEmployee']);
    Route::post('{id}/update', [ApiEmployeeController::class, 'updateEmployee']);
    Route::get('{id}/delete', [ApiEmployeeController::class, 'deleteEmployee']);
    Route::get('{pinCode}/find', [ApiEmployeeController::class, 'findEmployeeByPinCode']);
});
Route::prefix('attendance')->group(function () {
    Route::get('list', [ApiAttendancesController::class, 'getAttendance']);
    Route::post('add', [ApiAttendancesController::class, 'addAttends']);
    Route::post('late/purpose', [ApiAttendancesController::class, 'forLatePurpose']);
});
Route::prefix('purpose')->group(function () {
    Route::get('list', [ApiPurposeController::class, 'getPurpose']);
});
