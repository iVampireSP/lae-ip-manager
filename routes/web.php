<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IpController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [IndexController::class, 'index'])->name('login');
Route::post('/login', [IndexController::class, 'login']);


// 登入后的路由
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    Route::resource('users', UserController::class);
    // Route::resource('servers', ServerController::class);
    Route::resource('hosts', HostController::class);
    Route::resource('admins', AdminController::class);
    // Route::resource('devices', DeviceController::class);
    Route::resource('work-orders', WorkOrderController::class);
    Route::resource('work-orders.replies', ReplyController::class);

    Route::resource('regions', RegionController::class)->except(['show']);

    Route::resource('pools', PoolController::class);
    Route::get('pools/{pool}/generate', [
        PoolController::class,
        'show_generate'
    ])->name('pools.generate');
    Route::post('pools/{pool}/generate', [PoolController::class, 'run_generate'])->name('pools.generate');

    Route::resource('ips', IpController::class);


    // Route::get('devices/{device}/allows', [DeviceController::class, 'allows'])->name('devices.allows.index');
    // Route::post('devices/{device}/allows', [DeviceController::class, 'store_allow'])->name('devices.allows.store');
    // Route::delete('devices/allows/{allow}', [DeviceController::class, 'allow_destroy'])->name('devices.allows.destroy');

    Route::post('/logout', [IndexController::class, 'logout'])->name('logout');
});
