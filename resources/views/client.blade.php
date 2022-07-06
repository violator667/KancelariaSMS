@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Wyszkukaj po nazwisku:') }}</div>

                    <div class="card-body">
                        <div class="col-md-6">
                            <form method="POST" action="/clients">
                                @csrf
                                <div class="form-group">
                                    <label for="lastname">{{ __('Nazwisko') }}</label>
                                    <input id="lastname" name="lastname" type="text" class="@error('lastname') is-invalid @enderror">
                                </div>

                        </div>
                        <div class="col-md-2"><input type="submit" value="{{ __('Szukaj') }}"></div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Zestawienie klientów.') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table>
                            <tr>
                                <td width="30%"><b>{{ __('Nazwisko') }}</b></td>
                                <td width="20%"><b>{{ __('Imię') }}</b></td>
                                <td width="30%"><b>{{ __('Telefon') }}</b></td>
                                <td width="20%"><b>{{ __('SMS')  }}</b></td>
                            </tr>
                            @foreach($clients as $client)
                                <tr>
                                    <td width="30%">{{ $client->surname }}</td>
                                    <td width="20%">{{ $client->name }}</td>
                                    <td width="30%">{{ $client->phone_number }}</td>
                                    <td width="20%">
                                        <form method="POST" action="/sms">
                                        @csrf
                                            <input type="hidden" name="from" value="clients">
                                            <input type="hidden" name="name" value="{{ $client->name }}">
                                            <input type="hidden" name="surname" value="{{ $client->surname }}">
                                            <input type="hidden" name="recipient" value="{{ $client->phone_number }}">
                                            <input type="submit" value="{{ __('Wyślij SMS') }}">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
