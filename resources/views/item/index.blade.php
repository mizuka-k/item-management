@extends('adminlte::page')

@section('title', 'キッチンカー一覧')

@section('content_header')
    <h1>キッチンカー一覧</h1>
@stop

@section('content')
@if(session('alertMessage'))
    <div class="mt-4 alert alert-danger" role="alert">
        {{ session('alertMessage')}}
    </div>
@elseif(session('successMessage'))
    <div class="mt-4 alert alert-success" role="alert">
        {{ session('successMessage' )}}
    </div>
@endif
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">キッチンカー一覧</h3>
                    <div class="card-tools">
                        @can('admin')
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">キッチンカー登録</a>
                            </div>
                        </div>
                        @endcan
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
                                    <td>{{ Str::limit($item->detail,100,'...') }}</td>
                                    <td style="width: 35px">
                                        <p>
                                            <a href="{{ route('item.show',$item) }}"><button type="button" class="btn btn-outline-info">詳細</button></a>
                                        </p>
                                    </td>
                                    @can('admin')
                                    <td style="width: 35px"> 
                                        <form method="POST" action="{{ route('item.delete', $item->id) }}" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                        </form>
                                    </td>
                                    @endcan
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
