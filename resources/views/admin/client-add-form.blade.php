@extends('adminlte::page')

@section('title', 'Baza klientów')

@section('content_header')
    <h1><i class="fas faw fa-user-plus"></i> Dodaj klienta</h1>
@stop

@section('content')
    @include('admin.snippets.messages')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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

                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas faw fa-info-circle"></i> Wskazówki</h3>
                        <div class="card-tools">
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        Tu możesz zapisać dodatkowe informacje o kliencie, kolejny numer telefonu - np. stacjonarny.
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas faw fa-paperclip"></i> Notatki</h3>
                        <div class="card-tools">
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="form-group">
                                <textarea name="notes" class="form-control" rows="4" cols="5" id="clientNotes"></textarea>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        </form>&nbsp;
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    @include('admin.snippets.inputmask')
@stop
