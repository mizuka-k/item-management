@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ユーザ一覧</h3>
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
                                <th>名前</th>
                                <th>メールアドレス</th>
                                <th>ステータス</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div>
                                            @if($user->role == 0)
                                            <div>一般</div>
                                            @elseif($user->role == 1)
                                            <div>管理者</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <p>
                                            <a href="{{ route('user.edit',$user) }}"><button type="button" class="btn btn-outline-info">編集</button></a>
                                        </p>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('user.delete', $user->id) }}" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $users->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
