<?php

use App\Http\Controllers\API\ApiAttendsController;
use App\Http\Controllers\API\ApiCEOController;
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

Route::prefix('ceo')->group(function () {
    Route::get('list', [ApiCEOController::class, 'getCeos']);
    Route::post('add', [ApiCEOController::class, 'addCeo']);
    Route::post('update/{id}', [ApiCEOController::class, 'updateCeo']);
    Route::get('delete/{id}', [ApiCEOController::class, 'deleteCeo']);
    Route::post('login', [ApiCEOController::class, 'ceoLogin']);
});

Route::prefix('device')->group(function () {
    Route::get('list', [ApiDeviceController::class, 'getDevices']);
    Route::post('add', [ApiDeviceController::class, 'addDevice']);
    Route::get('detail/{id}', [ApiDeviceController::class, 'getDevice']);
    Route::post('update/{id}', [ApiDeviceController::class, 'updateDevice']);
    Route::get('delete/{id}', [ApiDeviceController::class, 'deleteDevice']);
    Route::post('find', [ApiDeviceController::class, 'findDeviceByPassword']);
});

Route::prefix('employee')->group(function () {
    Route::get('list', [ApiEmployeeController::class, 'getEmployees']);
    Route::get('warn/list/{id}', [ApiEmployeeController::class, 'getWarningEmployees']);
    Route::get('view/{id}', [ApiEmployeeController::class, 'getEmployee']);
    Route::post('add', [ApiEmployeeController::class, 'addEmployee']);
    Route::post('update/pin/{id}', [ApiEmployeeController::class, 'updatePin']);
    Route::post('update/{id}', [ApiEmployeeController::class, 'updateEmployee']);
    Route::get('delete/{id}', [ApiEmployeeController::class, 'deleteEmployee']);
    Route::get('{pinCode}/find', [ApiEmployeeController::class, 'findEmployeeByPinCode']);
});

Route::prefix('purpose')->group(function () {
    Route::get('list', [ApiPurposeController::class, 'purposeView']);
});

Route::prefix('attendance')->group(function () {
    Route::get('list', [ApiAttendsController::class, 'getAttendance']);
    Route::post('add', [ApiAttendsController::class, 'addAttends']);
    Route::post('add/offline', [ApiAttendsController::class, 'addAttendsOffline']);
    Route::post('late/purpose', [ApiAttendsController::class, 'forLatePurpose']);
    Route::get('delete/{id}', [ApiAttendsController::class, 'AttendanceDelete']);
    Route::post('warning/{id}', [ApiAttendsController::class, 'AttendanceWarning']);
});
