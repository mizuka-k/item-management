@extends('adminlte::page')

@section('title', 'イベント一覧')

@section('content_header')
    <h1>イベント一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">イベント一覧</h3>
                    <div class="card-tools">
                        @can('admin')
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('locations/add') }}" class="btn btn-default">イベント登録</a>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
                @if(session('alertMessage'))
                    <div class="mt-4 alert alert-danger" role="alert">
                        {{ session('alertMessage')}}
                    </div>
                @elseif(session('successMessage'))
                    <div class="mt-4 alert alert-success" role="alert">
                        {{ session('successMessage' )}}
                    </div>
                @endif
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>タイトル</th>
                                <th>ステータス</th>
                                <th>開催場所</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                                <tr>
                                    <td>{{ $location->id }}</td>
                                    <td>{{ $location->title }}</td>
                                    <td>
                                        <div>
                                            @if($location->status == 0)
                                            <div>募集中</div>
                                            @elseif($location->status == 1)
                                            <div>募集締切</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($location->address,100,'...') }}</td>
                                    <td style="width: 35px">
                                        <a href="{{ route('location.show',$location) }}"><button type="button" class="btn btn-outline-info">詳細</button></a>
                                    </td>
                                    @can('admin')
                                    <td style="width: 35px"> 
                                        <form method="POST" action="{{ route('location.delete', $location->id) }}" >
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
            <div class="d-flex justify-content-center">
                {{ $locations->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@stop
@section('footer')
<p class="text-center">©︎2024 MIZUKA KAJITA</p>
@stop

@section('css')
@stop

@section('js')
@stop
