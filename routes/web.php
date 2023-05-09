<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\IndexController;
use App\Http\Controllers\Backend\CEOController;
use App\Http\Controllers\Backend\DeviceController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\PurposeController;
use App\Http\Controllers\Backend\AttendancesController;
use App\Http\Controllers\Bot\BotController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Bot

Route::match(['get', 'post'], '/botecontrol', [BotController::class, 'bot']);

Route::get('/login', function () {
    return redirect(route('index'));
});
Route::get('/', [AdminController::class, 'loginForm'])->name('index');
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::group(['middleware' => ['admin:admin']], function () {
    Route::post('/', [AdminController::class, 'store'])->name('admin.login');
});
Route::middleware(['auth:sanctum,admin', 'verified'])
    ->get('/admin/dashboard', [IndexController::class, 'mainPage'])->name('dashboard');

Route::get('attendance/bot/view', [AttendancesController::class, 'AttendanceBotView'])->name('bot_view');

Route::middleware(['auth:admin'])->group(function () {
    Route::prefix('ceo')->group(function () {
        Route::get('/view', [CEOController::class, 'ceoView'])->name('all.ceo');
        Route::post('/store', [CEOController::class, 'ceoStore'])->name('ceo.store');
        Route::get('/edit/{id}', [CEOController::class, 'ceoEdit'])->name('ceo.edit');
        Route::get('/show/{id}', [CEOController::class, 'ceoShow'])->name('ceo.show');
        Route::post('/update/{id}', [CEOController::class, 'ceoUpdate'])->name('ceo.update');
        Route::post('/update_login/{id}', [CEOController::class, 'ceoUpdateLogin'])->name('ceo_login.update');
        Route::get('/delete/{id}', [CEOController::class, 'ceoDelete'])->name('ceo.delete');
    });
    Route::prefix('device')->group(function () {
        Route::get('/view', [DeviceController::class, 'DeviceView'])->name('all.device');
        Route::post('/store', [DeviceController::class, 'DeviceStore'])->name('device.store');
        Route::get('/edit/{id}', [DeviceController::class, 'DeviceEdit'])->name('device.edit');
        Route::get('/show/{id}', [DeviceController::class, 'DeviceShow'])->name('device.show');
        Route::post('/update/{id}', [DeviceController::class, 'DeviceUpdate'])->name('device.update');
        Route::post('/update_login/{id}', [DeviceController::class, 'DeviceUpdateLogin'])->name('device_login.update');
        Route::get('/delete/{id}', [DeviceController::class, 'DeviceDelete'])->name('device.delete');
    });
    Route::prefix('employee')->group(function () {
        Route::get('/view', [EmployeeController::class, 'EmployeeView'])->name('all.employee');
        Route::post('/store', [EmployeeController::class, 'EmployeeStore'])->name('employee.store');
        Route::get('/edit/{id}', [EmployeeController::class, 'EmployeeEdit'])->name('employee.edit');
        Route::get('/show/{id}', [EmployeeController::class, 'EmployeeShow'])->name('employee.show');
        Route::post('/update/{id}', [EmployeeController::class, 'EmployeeUpdate'])->name('employee.update');
        Route::post('/update_login/{id}', [EmployeeController::class, 'EmployeeUpdateLogin'])->name('employee_login.update');
        Route::get('/delete/{id}', [EmployeeController::class, 'EmployeeDelete'])->name('employee.delete');
    });
    Route::prefix('purpose')->group(function () {
        Route::get('/view', [PurposeController::class, 'PurposeView'])->name('all.purpose');
        Route::post('/store', [PurposeController::class, 'PurposeStore'])->name('purpose.store');
        Route::get('/edit/{id}', [PurposeController::class, 'PurposeEdit'])->name('purpose.edit');
        Route::post('/update/{id}', [PurposeController::class, 'PurposeUpdate'])->name('purpose.update');
        Route::get('/delete/{id}', [PurposeController::class, 'PurposeDelete'])->name('purpose.delete');
    });
    Route::prefix('attendance')->group(function () {
        Route::get('/view', [AttendancesController::class, 'AttendanceView'])->name('all.attendance');
    });
});
