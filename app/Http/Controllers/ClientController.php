<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Services\ClientService;

class ClientController extends Controller
{
    protected $client_service;
    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->client_service = new ClientService();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMainPage()
    {
            $clients = Client::paginate(10);
            return view('admin.client')->with('clients',$clients);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        if(!empty($request->lastname)) {
            $clients = Client::where('surname','like', $request->lastname . '%')->paginate(15);
            return view('admin.client')->with('clients',$clients)->with('lastname',$request->lastname);
        }
        return redirect()->route('clients');
    }

    /**
     * @param ClientRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ClientRequest $request)
    {
        if($this->client_service->addClient($request->name, $request->surname, $request->phone_number, $request->notes))
        {
            return redirect()->route('dashboard')->with('status', __('Dodano klienta do bazy!'));
        }
        return redirect()->route('dashboard')->with('error', __('Klient z takim numerem telefonu już istnieje w bazie.'));
    }

    public function showEditForm($id)
    {
        $client = $this->client_service->getClient($id);
        if($client) {
            return view('admin.client-edit-form')->with('client', $client);
        }
        return redirect()->route('clients')->with('error',__('Nie znaleziono klienta!'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAddForm()
    {
        return view('admin.client-add-form');
    }

    /**
     * @param ClientRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClientRequest $request)
    {
        if($this->client_service->updateClient($request))
        {
            return redirect()->back()->with('status',__('Edycja zakończona poprawnie.'));
        }
        return redirect()->back()->with('error',__('Błąd podczas edycji.'));
    }

    public function remove(Request $request)
    {
        if($this->client_service->removeClient($request->id))
        {
            return redirect()->route('clients')->with('status',__('Wybrany klient został usunięty z bazy.'));
        }
        return redirect()->back()->with('error',__('Wystąpił błąd podczas usuwania klienta.'));
    }

}
