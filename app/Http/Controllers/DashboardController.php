<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance;
use App\Client;
use App\Sms;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showMainPage()
    {
        $balance = Balance::first();
        $customersNumber = Client::count();
        $smsNumber = Sms::where('first_response_status', '=', '0')->count();
        return view('admin.dashboard')
            ->with('balance', $balance)
            ->with('costumersNumber', $customersNumber)
            ->with('smsNumber', $smsNumber);
    }
}
