<?php

namespace App\Http\Controllers;

use App\Services\SmsService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $smsService;

    public function __construct()
    {
        $this->smsService = new SmsService();
    }

    /**
     * @param Request $request
     */
    public function getReportsFromApi(Request $request)
    {
        $this->smsService->storeExternalReport($request);
        /*
         * This API requires "OK" in plain text as a response
         */
        echo "OK";
    }
}
