<?php

use App\Http\Controllers\Api\HostController;
use App\Http\Controllers\Api\PoolController;
use App\Http\Controllers\Api\RegionController;
use Illuminate\Support\Facades\Route;

/**
 * Functions
 * 暴露给用户的函数，由网关进行调用
 * 但是请注意，请求内容不能过大，必须在 5s 内完成请求，否则会导致请求失败。
 * 认证 Guard: api。可以通过 $request->user('api') 获取用户信息。
 */

Route::apiResource('hosts', HostController::class)->except(['show', 'update']);
Route::get('pools', PoolController::class);
Route::get('regions', RegionController::class);
