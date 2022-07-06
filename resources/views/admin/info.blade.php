@extends('adminlte::page')

@section('title', 'Komunikacja')

@section('content_header')
    <h1><i class="fas faw fa-comment"></i> Lista komunikatów</h1>
@stop

@section('content')
    @include('admin.snippets.messages')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Twoje komunikaty</h3>
                    <div class="card-tools">
                        {{ $infos->links() }}
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 60%">Treść</th>
                            <th style="width: 20%">Widoczny do</th>
                            <th style="width: 10%">Status</th>
                            <th style="width: 5%"> </th>
                            <th style="width: 5%"> </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($infos as $info)
                            <tr>
                                <td style="width: 60%">{{ $info->content }}</td>
                                <td style="width: 20%">{{ $info->exp }} 23:59</td>
                                <td style="width: 10%">
                                    @if($info->status == 0)
                                        <span class="badge badge-warning">nieaktywny</span>
                                    @elseif($info->status == 1)
                                        <span class="badge badge-info">aktywny</span>
                                    @else
                                        <span class="badge badge-dark">zakończony</span>
                                    @endif
                                </td>
                                <td style="width: 5%">
                                    <a role="button" href="/panel/infos/edit/{{ $info->id }}" class="btn btn-sm btn-default">Edytuj</a>
                                </td>
                                <td style="width: 5%">
                                    <form method="POST" action="/panel/infos/delete">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $info->id }}">
                                        <button type="submit" class="btn btn-sm btn-default" name="delete_item">Usuń</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer clearfix">
                        {{ $infos->links() }}
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


