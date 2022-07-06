<?php

namespace App\Http\Controllers;

use App\Info;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\InfoRequest;

class InfoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddForm()
    {
        return view('admin.info-add-form');
    }

    /**
     * @param InfoRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(InfoRequest $request)
    {
        $info = new Info();
        $info->content = $request->infocontent;
        $info->expires_at = Carbon::createFromDate($request->expires_at)->addDay();
        $info->active = $request->active;
        $info->save();
        return redirect()->route('infos')->with('status',__('Komunikat dodany poprawnie.'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMainPage()
    {
        $infos = Info::orderBy('id', 'DESC')->paginate(10);
        return view('admin.info')->with('infos', $infos);
    }

    public function showEditForm($id)
    {
        $info = Info::whereId($id)->first();
        if($info) {
            return view('admin.info-edit-form')->with('info',$info);
        }
        return redirect()->back()->with('error',__('Nie znaleziono komunikatu.'));
    }

    public function update(InfoRequest $request)
    {
        Info::where('id',$request->id)->update(
            ['content' => $request->infocontent,
                'active' => $request->active,
                'expires_at' => Carbon::createFromDate($request->expires_at)->addDay()
            ]);
        return redirect()->route('infos')->with('status', __('Nie znaleziono komunikatu.'));
    }

    public function remove(Request $request)
    {
        Info::destroy($request->id);
        return redirect()->route('infos')->with('status',__('Wybrany komunikat został usunięty.'));
    }
}
