@extends('adminlte::page')

@section('title', 'アカウント設定')

@section('content_header')
    <h1>アカウント設定</h1>
@stop

@section('content')
<div class="container">
@if(session('alertMessage'))
    <div class="alert alert-danger" role="alert">
        {{ session('alertMessage')}}
    </div>
    @elseif(session('successMessage'))
    <div class="alert alert-success" role="alert">
        {{ session('successMessage' )}}
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール変更</div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', $auth->id) }}" method="POST">
                            @csrf 
                            @method('patch')
                            <div class="row mb-3">
                                <label for="id" class="col-md-4 col-form-label text-md-end" style="width:30%">ユーザーID</label>
                                <div class="col-md-6">
                                    <input id="id" type="text" class="form-control" name="id" value="{{ $auth->id }}" readonly>
                                </div>
                            </div>
                
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $auth->name) }}" required autocomplete="name">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $auth->email) }}" required autocomplete="email">
                                </div>
                            </div>

                            <div class="p-4">
                                <div class="d-flex justify-content-center m-2">
                                    <button type="submit" class="btn btn-info">編集</button>
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
</div>
@stop
@section('footer')
<p class="text-center">©︎2024 MIZUKA KAJITA</p>
@stop

@section('css')
@stop

@section('js')
@stop
