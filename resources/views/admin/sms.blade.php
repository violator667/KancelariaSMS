@extends('adminlte::page')

@section('title', 'Historia SMS')

@section('content_header')
    <h1><i class="fas faw fa-mobile-alt"></i> Historia SMS</h1>
@stop

@section('content')
    @include('admin.snippets.messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Twoje SMS</h3>
                    <div class="card-tools">
                        {{ $allSms->links() }}
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 10%">Odbiorca</th>
                            <th style="width: 60%">Treść</th>
                            <th style="width: 20%">Data (wysyłka/dostarczenie)</th>
                            <th style="width: 10%">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allSms as $sms)
                            <tr>
                                <td style="width: 10%">{{ $sms->recipient }}</td>
                                <td style="width: 60%">{{ $sms->text }}</td>
                                <td style="width: 20%">
                                    {{ $sms->created_at }}
                                    @if($sms->last_response_status == "1")
                                        <br>{{ $sms->delivered_at }}
                                    @endif
                                </td>
                                <td style="width: 10%">
                                    @if($sms->first_response_status == "0")
                                        <span class="badge badge-info">
                                    @else
                                        <span class="badge badge-warning">
                                    @endif
                                        {{ $sms->firstResponseStatusTxt() }}
                                    </span>
                                    @if($sms->last_response_status == "1")
                                        <span class="badge badge-info">{{ $sms->lastResponseStatusTxt() }}</span>
                                    @elseif($sms->last_response_status == ("2" || "16"))
                                        <span class="badge badge-warning">{{ $sms->lastResponseStatusTxt() }}</span>
                                    @else
                                        <span class="badge badge-light">{{ $sms->lastResponseStatusTxt() }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer clearfix">
                        {{ $allSms->links() }}
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


