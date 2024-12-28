@extends('adminlte::page')
@section('title', 'アカウント設定')

@section('content')
<div class="container">
@if(session('alertMessage'))
    <div class="mt-4 alert alert-danger" role="alert">
        {{ session('alertMessage')}}
    </div>
@elseif(session('successMessage'))
    <div class="mt-4 alert alert-success" role="alert">
        {{ session('successMessage' )}}
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード変更</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update',$auth) }}">
                        @csrf
                        @method('patch')
                    <!-- パスワード -->
                    <div class="row mb-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-end">現在のパスワード</label>
                            <div class="col-md-6">
                                <input class="form-control" type="password" id="current_password" name="current_password" placeholder="******">
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-end">新しいパスワード</label>
                            <div class="col-md-6">
                                <input class="form-control" type="password" id="password" name="password" placeholder="******">
                            </div>
                    </div>
                    <div class="row mb-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-end">現在のパスワード(確認)</label>
                            <div class="col-md-6">
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="******">
                            </div>
                    </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="p-4">
                            <div class="d-flex justify-content-center m-2">
                                <button type="submit" class="btn btn-primary">編集する</button>
                            </div>
                            <div class="d-flex justify-content-center m-2">
                                <a href="{{ route('home') }}"><button type="button" class="btn btn-secondary">戻る</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

