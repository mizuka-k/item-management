@extends('adminlte::page')

@section('title', 'イベント登録')

@section('content_header')
    <h1>イベント登録</h1>
@stop


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
                <div class="card-header">イベント登録</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('location.add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">イベントタイトル</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="title">

                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ステータス -->
                        <!-- <div class="row mb-3">
                            <label for="status" class="col-md-4 col-form-label text-md-end">ステータス</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="open" value="0" {{ old('open') == '0' ? 'checked' : '' }} checked>
                                <label class="form-check-label" for="open">募集中</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="close" value="1" {{ old('close') == '1' ? 'checked' : '' }} >
                                <label class="form-check-label" for="close">募集締切</label>
                            </div>
                        </div>
                        @error('status')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror -->

                        <!-- 日時 -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="start_date">イベント開始日</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" id="start_date" name="start_date" value="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="end_date">イベント終了日</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" id="end_date" name="end_date" value="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="start_time">営業開始時間</label>
                            <div class="col-md-6">
                                <input class="form-control" type="time" id="start_time" name="start_time"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="end_time">営業終了時間</label>
                            <div class="col-md-6">
                                <input class="form-control" type="time" id="end_time" name="end_time"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">開催場所</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="detail" class="col-md-4 col-form-label text-md-end">詳細</label>

                            <div class="col-md-6">
                                <textarea name="detail" id="detail" class="form-control" value="{{ old('address') }}" rows="6"></textarea>
                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- 画像 -->
                        <div class="form-group">
                            <div class="form-group">
                                <label for="image">画像(1MBまで)</label>
                                <div>
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                        </div>


                            <div class="d-flex justify-content-center mt-4 mb2">
                                <button type="submit" class="btn btn-primary">登録</button>
                            </div>
                            <div class="d-flex justify-content-center m-2">
                                <a href="{{ route('location.index') }}"><button type="button" class="btn btn-secondary">キャンセル</button></a>
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
