<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Http\Requests\SmsRequest;
use App\Services\SmsService;
use App\Services\ClientService;
use App\Name;
use App\Sms;
use Illuminate\Http\Request;


class SmsController extends Controller
{
    protected $smsService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->smsService = new SmsService();
    }
    public function index()
    {
        $balance = Balance::first();
        return view('admin.dashboard')->with('balance', $balance);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSmsHistory()
    {
        $allSms = Sms::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.sms')->with('allSms', $allSms);
    }

    /**
     * @param SmsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function sendSms(SmsRequest $request)
    {
        if($request->from == "clients") {
            $redirection_route = "clients";
        }else{
            $redirection_route = "dashboard";
        }

        $name = Name::where('name', $request->name)->first();
        if(!is_object($name)) {
            $name = Name::where('name', 'unknown')->first();
        }
        if($this->smsService->sendSms($name->vocative, $name->sex, $request->recipient))
        {
            if($request->surname) {
                $addNewClient = new ClientService();
                if($addNewClient->addClient($request->name, $request->surname, $request->recipient))
                {
                    return redirect()->route($redirection_route)->with('status', __('Wiadomość wysłana! Dodano nowego klienta do bazy.'));
                }
                return redirect()->route($redirection_route)->with('status', __('Wiadomość wysłana! Nie dodano nowego klienta, gdyż ten już znajduje się bazie.'));
            }
            return redirect()->route($redirection_route)->with('status', __('Wiadomość wysłana! Nie dodano klienta do bazy (brak nazwiska).'));
        }
        return redirect()->route($redirection_route)->with('error', __('Nie udało się wysłać wiadomości!'));
    }

}
