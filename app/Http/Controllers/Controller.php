<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use ivampiresp\Cocoa\Helpers\ApiResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    protected PendingRequest $http;

    public function __construct()
    {
        $this->http = Http::remote()->asForm();
    }
}
