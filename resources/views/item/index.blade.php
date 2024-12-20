@extends('adminlte::page')

@section('title', 'キッチンカー一覧')

@section('content_header')
    <h1>キッチンカー一覧</h1>
@stop

@section('content')
    <div class="row">
    @if(session('alertMessage'))
        <div class="mt-4 alert alert-danger" role="alert">
            {{ session('alertMessage')}}
        </div>
    @elseif(session('successMessage'))
        <div class="mt-4 alert alert-success" role="alert">
            {{ session('successMessage' )}}
        </div>
    @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">キッチンカー一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">キッチンカー登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>屋号</th>
                                <th>詳細</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>
                                        <p>
                                            <a href="{{ route('item.edit',$item) }}"><button type="button" class="btn btn-outline-info">詳細</button></a>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
