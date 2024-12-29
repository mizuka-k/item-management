@extends('adminlte::page')

@section('title', 'イベント情報編集')

@section('content_header')
    <h1>イベント情報編集</h1>
@stop

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
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ $location->title }}</div>
            <div class="row justify-content-center">
                <div class="card-body">
                    <form method="POST" action="{{ route('location.update',$location) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row mb-3">
                            <label for="id" class="col-md-4 col-form-label text-md-end">ID</label>
                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" value="{{ $location->id }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">イベントタイトル</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $location->title) }}" required autocomplete="title">

                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">現在のステータス</label>
                            <div class="col-md-6 m-2">
                                @if($location->status == 0)
                                <div>募集中</div>
                                @elseif($location->status == 1)
                                <div>締切</div>
                                @endif
                                <div class="mt-2">
                                    <div>
                                        <input id="close" type="radio" class="form-check-input ms-2" name="status" value="1" {{ old('close', $location->status) == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="close">募集を締切る</label>
                                    </div>
                                    <div>
                                        <input id="open" type="radio" class="form-check-input" name="status" value="0" {{ old('open', $location->status) == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="open">応募開始</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 日時 -->
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="start_date">イベント開始日</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" id="start_date" name="start_date" value="{{ old('start_date',$location->start_date) }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="end_date">イベント終了日</label>
                            <div class="col-md-6">
                                <input class="form-control" type="date" id="end_date" name="end_date" value="{{ old('end_date',$location->end_date) }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="start_time">営業開始時間</label>
                            <div class="col-md-6">
                                <input class="form-control" type="time" id="start_time" name="start_time" value="{{ substr($location->start_time,0,5) }}"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end" for="end_time">営業終了時間</label>
                            <div class="col-md-6">
                                <input class="form-control" type="time" id="end_time" name="end_time" value="{{ substr($location->end_time,0,5) }}"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">開催場所</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address', $location->address) }}" required autocomplete="address">

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
                                <textarea name="detail" id="detail" class="form-control" value=""rows="6">{{ old('detail', $location->detail) }}</textarea>
                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- 画像 -->
                        <div class="form-group">
                            @if($location->image)
                            <div class="text-center">
                                <img src="{{ asset('storage/'.$location->image) }}" alt="イベントイメージ" class="mx-auto m-2" style="height:300px">
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="image">画像(1MBまで)</label>
                                <div>
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="text-center m-4">
                            <div class="m-2">
                                <button type="submit" class="btn btn-info">編集する</button>
                            </div>
                            <div class="m-2">
                                <a href="{{ route('location.index',$location) }}"><button type="button" class="btn btn-secondary">戻る</button></a>
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
