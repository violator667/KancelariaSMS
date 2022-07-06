@extends('adminlte::page')

@section('title', 'Pulpit')

@section('content_header')
    <h1><i class="fas faw fa-tachometer-alt"></i> Pulpit</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas faw fa-mobile-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Wysłanych SMSów</span>
                    <span class="info-box-number">{{ $smsNumber ?? '' }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far faw fa-money-bill-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pozostałe środki na wysyłkę (zł)</span>
                    <span class="info-box-number">{{ $balance->balance }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-gradient-warning"><i class="fas faw fa-user-tie"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Klientów w bazie</span>
                    <span class="info-box-number">{{ $costumersNumber }}</span>
                </div>
            </div>
        </div>
    </div>
    @include('admin.snippets.messages')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas faw fa-mobile-alt"></i> Wyślij SMS</h3>
                    <div class="card-tools">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="/panel/sms">
                        @csrf
                        <div class="form-group">
                            <label for="smsName">Imię</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="smsName" name="name" placeholder="Podaj imię (wymagane)" value="{{ old('name') }}" required>
                            @error('name')
                                <small id="smsNameHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="smsSurname">Nazwisko</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="smsSurname" name="surname" placeholder="Podaj nazwisko" value="{{ old('surname') }}">
                            @error('surname')
                            <small id="smsSurnameHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="smsRecipient">Telefon</label>
                            <input type="text" class="form-control @error('recipient') is-invalid @enderror" id="smsRecipient" name="recipient" value="{{ old('recipient') }}" placeholder="Podaj telefon (wymagane)" data-inputmask="'mask': ['999999999']" data-mask="" required>
                            @error('recipient')
                                <small id="smsRecipientHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-info">Wyślij SMS</button>
                    </form>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas faw fa-user-tie"></i> Dodaj klienta</h3>
                    <div class="card-tools">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="/panel/clients/add">
                        @csrf
                        <div class="form-group">
                            <label for="clientName">Imię</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="clientName" name="name" placeholder="Podaj imię (wymagane)" value="{{ old('name') }}" required>
                            @error('name')
                             <small id="clientNameHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="clientSurname">Nazwisko</label>
                            <input type="text" class="form-control @error('surname') is-invalid @enderror" id="clientSurname" name="surname" placeholder="Podaj nazwisko (wymagane)" value="{{ old('surname') }}" required>
                            @error('surname')
                                <small id="clientSurnametHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="clientRecipient">Telefon</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="clientRecipient" name="phone_number" placeholder="Podaj numer telefonu (wymagane)" value="{{ old('phone_number') }}"  data-inputmask="'mask': ['999999999']" data-mask="" required>
                            @error('phone_number')
                                <small id="clientRecipientHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-warning">Dodaj klienta</button>
                    </form>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')
    @include('admin.snippets.inputmask')


@stop
