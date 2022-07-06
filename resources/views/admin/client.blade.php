@extends('adminlte::page')

@section('title', 'Baza klientów')

@section('content_header')
    <h1><i class="fas faw fa-user-tie"></i> Baza klientów</h1>
@stop

@section('content')
    @include('admin.snippets.messages')
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="/panel/clients">
                @csrf
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" name="lastname" placeholder="Wprowadź nazwisko">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Twoi klienci</h3>
                    <div class="card-tools">
                        {{ $clients->links() }}
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 2%">Nazwisko</th>
                            <th style="width: 20%">Imię</th>
                            <th style="width: 20%">Telefon</th>
                            <th style="width: 20%">Posiada notatkę?</th>
                            <th style="width: 10%"> </th>
                            <th style="width: 5%"> </th>
                            <th style="width: 5%"> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td style="width: 20%">{{ $client->surname }}</td>
                                <td style="width: 20%">{{ $client->name }}</td>
                                <td style="width: 20%">{{ $client->phone_number }}</td>
                                <td style="width: 20%">
                                    @if($client->has_note)
                                        <a role="button" href="/panel/clients/edit/{{ $client->id }}" class="btn btn-sm btn-default"><i class="fa fa-check-circle" style="color: #006400;"></i> TAK -> Zobacz</a>
                                    @else
                                        <a role="button" class="btn btn-sm btn-default"><i class="fas fa-times-circle" style="color: #FF0000;"></i> NIE</a>
                                    @endif
                                </td>
                                <td style="width: 10%">
                                    <form method="POST" action="/panel/sms">
                                        @csrf
                                        <input type="hidden" name="from" value="clients">
                                        <input type="hidden" name="name" value="{{ $client->name }}">
                                        <input type="hidden" name="surname" value="{{ $client->surname }}">
                                        <input type="hidden" name="recipient" value="{{ $client->phone_number }}">
                                        <button type="submit" class="btn btn-sm btn-info">Wyślij SMS</button>
                                    </form>
                                </td>
                                <td style="width: 5%">
                                    <a role="button" href="/panel/clients/edit/{{ $client->id }}" class="btn btn-sm btn-default">Edytuj</a>
                                </td>
                                <td style="width: 5%">
                                    <form method="POST" action="/panel/clients/delete">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $client->id }}">
                                        <button type="submit" class="btn btn-sm btn-default" name="delete_item">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer clearfix">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.snippets.delete-modal')
@stop



@section('css')

@stop

@section('js')
    @include('admin.snippets.delete-js')
@stop


