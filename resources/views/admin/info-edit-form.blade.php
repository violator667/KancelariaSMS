@extends('adminlte::page')

@section('title', 'Komunikacja')

@section('content_header')
    <h1><i class="fas faw fa-comment-medical"></i> Edytuj komunikat dla klientów.</h1>
@stop

@section('content')
    @include('admin.snippets.messages')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas faw fa-user-tie"></i> Edytuj komunikat</h3>
                    <div class="card-tools">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="/panel/infos/edit">
                        @csrf
                        <input type="hidden" name="id" value="{{ $info->id }}">
                        <div class="form-group">
                            <label for="infoContent">Treść komunikatu:</label>
                            <textarea id="infoContent" class="form-control @error('infocontent') is-invalid @enderror" name="infocontent"  rows="5" cols="60" placeholder="np. Szanowni klienci w dniu 30.05.2022 kancelaria jest nieczynna." maxlength="100">{{ $info->content }}</textarea>
                            @error('infocontent')
                            <small id="infoContentHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="infoDate">Wyświetlaj do 23:59 w dniu:</label>
                            <input type="text" class="form-control @error('expires_at') is-invalid @enderror" id="infoDate" name="expires_at" placeholder="RRRR-MM-DD" value="{{ $info->exp }}" data-inputmask="'mask': ['9999-99-99']" data-mask="" required>
                            @error('expires_at')
                            <small id="infoDateHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="infoActive">Wyświetlaj od teraz?</label>
                            <select id="infoActive" name="active">
                                <option value="1" @if($info->active == 1) selected @endif>TAK</option>
                                <option value="0" @if($info->active == 0) selected @endif>NIE</option>
                            </select>
                        </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-warning">Zapisz</button>
                    </form>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas faw fa-info-circle"></i> Wskazówki</h3>
                    <div class="card-tools">
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul>
                        <li>Komunikat może mieć maksymalnie 100 znaków (spacja to też znak ;) )</li>
                        <li>Podaj datę w formacie RRRR-MM-DD. Komunikat zniknie automatycznie gdy wskazany dzień się zakończy - nie musisz wyłączać go samodzielnie.</li>
                        <li>Domyślnie komunikat wyświetla się od razu po dodaniu, jeśli chcesz włączyć go w późniejszym terminie zaznacz "NIE" w ostatnim polu.</li>
                        <li>System wyświetla tylko <b>najnowszy</b> komunikat, jeśli dodasz dwa lub więcej starsze nie będą widoczne.</li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
@stop

@section('css')

@stop

@section('js')
    @include('admin.snippets.inputmask')
@stop
