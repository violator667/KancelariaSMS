<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Info;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($info = Info::where('active', '=', '1')->where('expires_at', '>', Carbon::now())->orderBy('id','DESC')->first()) {
            $infotext = $info->content;
        }else{
            $infotext = '';
        }

        return view('index')->with('infotext', $infotext);
    }
}
