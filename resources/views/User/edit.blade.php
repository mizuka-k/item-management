@extends('adminlte::page')

@section('title', 'ユーザー一覧')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if(session('alertMessage'))
        <div class="mt-4 alert alert-danger" role="alert">
            {{ session('alertMessage')}}
        </div>
    @elseif(session('successMessage'))
        <div class="mt-4 alert alert-success" role="alert">
            {{ session('successMessage' )}}
        </div>
    @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザー情報</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',$user) }}">
                        @csrf
                        @method('patch')
                        <div class="row mb-3">
                            <label for="id" class="col-md-4 col-form-label text-md-end">ユーザーID</label>
                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" value="{{ $user->id }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">現在のステータス</label>
                            <div class="col-md-6 m-2">
                                @if($user->role == 0)
                                <div>一般</div>
                                @elseif($user->role == 1)
                                <div>管理者</div>
                                @endif
                            </div>
                        </div>
                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-end">ステータス付与</label>
                                <div class="col-md-3">
                                    <input id="general" type="radio" class="form-check-input" name="role" value="0" {{ old('general', $user->role) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="general">管理者権限を外す</label>
                                </div>
                                <div class="col-md-3">
                                    <input id="admin" type="radio" class="form-check-input" name="role" value="1" {{ old('admin', $user->role) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="admin">管理者権限を付与する</label>
                                </div>
                            </div>


                        <div class="p-4">
                            <div class="d-flex justify-content-center m-2">
                                <button type="submit" class="btn btn-primary">編集する</button>
                            </div>
                            <div class="d-flex justify-content-center m-2">
                                <a href="{{ route('user.index',$user) }}"><button type="button" class="btn btn-secondary">戻る</button></a>
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

