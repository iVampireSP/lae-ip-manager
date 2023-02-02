<?php

use App\Http\Controllers\Remote\Exports;
use Illuminate\Support\Facades\Route;

/**
 * Export functions
 * 导出函数，提供给用户访问。
 * 请求方式将会透传, 您定义了什么请求方式，在前端中就应该使用哪种类型的请求方式。
 */

// 导出函数。用于给其它集成模块调用。做到模块之间相互交换信息或控制。
Route::group(['prefix' => '/exports', 'as' => 'exports.'], function () {
    Route::apiResource('ips', Exports\HostController::class)->only('index', 'update', 'destroy');
    Route::get('pools', Exports\PoolController::class);
    Route::get('regions', Exports\RegionController::class);
});
