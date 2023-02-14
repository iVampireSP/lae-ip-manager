<?php

use App\Http\Controllers\IpController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::resource('regions', RegionController::class)->except(['show']);

Route::resource('pools', PoolController::class);
Route::get('pools/{pool}/generate', [
    PoolController::class,
    'show_generate'
])->name('pools.generate');
Route::post('pools/{pool}/generate', [PoolController::class, 'run_generate']);

Route::resource('ips', IpController::class)->except(['show']);
