<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Remote\Api;

/**
 * Functions
 * 暴露给用户的函数，由网关进行调用
 * 但是请注意，请求内容不能过大，必须在 5s 内完成请求，否则会导致请求失败。
 * 认证 Guard: api。可以通过 $request->user('api') 获取用户信息。
 */

Route::apiResource('ips', Api\IpController::class)->only('index', 'update', 'show');
