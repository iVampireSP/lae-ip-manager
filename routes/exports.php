<?php

use App\Http\Controllers\Remote\Exports;
use Illuminate\Support\Facades\Route;

/**
 * Exports
 * 导出函数，提供给其他模块访问，进行模块联调。
 * 例如，你可以在这里导出一个函数，让其他模块调用，从而实现模块间的数据交互。
 * 但是请注意，请求内容不能过大，必须在 5s 内完成请求，否则会导致请求失败。
 */
Route::apiResource('ips', Exports\HostController::class)->only('index', 'update', 'destroy');
Route::get('pools', Exports\PoolController::class);
Route::get('regions', Exports\RegionController::class);
