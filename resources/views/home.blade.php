@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Aktualne saldo SMS:') }} {{$balance->balance}} {{ __('PLN (netto)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dodaj klienta do bazy (bez SMS)') }}</div>
                <div class="card-body">
                    <form method="POST" action="/clients/add">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Imię') }}</label>
                            <input id="name" name="name" type="text" class="@error('name') is-invalid @enderror">
                            <small id="nameHelp" class="form-text text-muted"></small>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="surname">{{ __('Nazwisko') }}</label>
                            <input id="surname" name="surname" type="text" class="@error('surname') is-invalid @enderror">
                            <small id="nametHelp" class="form-text text-muted">{{ __('Pole wymagane!') }}</small>
                            @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_number">{{ __('Numer telefonu') }}</label>
                            <input id="phone_number" name="phone_number" type="text" class="@error('phone_number') is-invalid @enderror">
                            <small id="phone_numberHelp" class="form-text text-muted">{{ __('Pole wymagane!') }}</small>
                            @error('phone_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" value="{{ __('Wyślij') }}">
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
                <div class="card-header">{{ __('Wysyłka SMS') }}</div>

                <div class="card-body">
                    <form method="POST" action="/sms">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Imię') }}</label>
                            <input id="name" name="name" type="text" class="@error('name') is-invalid @enderror">
                            <small id="nametHelp" class="form-text text-muted">{{ __('Pole wymagane!') }}</small>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="surname">{{ __('Nazwisko') }}</label>
                            <input id="surname" name="surname" type="text" class="@error('surname') is-invalid @enderror">
                            <small id="nametHelp" class="form-text text-muted">{{ __('(opcjonalnie)') }}</small>
                            @error('surname')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="recipient">{{ __('Numer telefonu') }}</label>
                            <input id="recipient" name="recipient" type="text" class="@error('recipient') is-invalid @enderror">
                            <small id="recipientHelp" class="form-text text-muted">{{ __('Pole wymagane!') }}</small>
                            @error('recipient')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="submit" value="{{ __('Wyślij') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div
@endsection
