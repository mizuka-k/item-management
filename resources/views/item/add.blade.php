@extends('adminlte::page')

@section('title', 'キッチンカー登録')

@section('content_header')
    <h1>キッチンカー登録</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">キッチンカー登録</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('item.add') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">屋号</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="屋号" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="detail">詳細</label>
                                    <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{ old('detail') }}</textarea>
                                    @error('detail')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- 画像 -->
                                <!-- <div class="form-group">
                                    <label for="image">画像:1MBまで</label>
                                    <div>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> -->

                                <div class="d-flex justify-content-center mt-4 mb">
                                    <button type="submit" class="btn btn-info">登録</button>
                                </div>
                                <div class="d-flex justify-content-center m-2">
                                    <a href="{{ route('item.index') }}"><button type="button" class="btn btn-secondary">キャンセル</button></a>
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
