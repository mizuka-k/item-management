@extends('adminlte::page')

@section('title', 'キッチンカー登録')

@section('content_header')
    <h1>キッチンカー登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('item.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">屋号</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="屋号">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{ old('detail') }}</textarea>
                        </div>

                    <!-- 画像 -->
                        <div class="form-group">
                            <label for="image">画像:1MBまで</label>
                            <div>
                                <input type="file" name="image" id="image">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-info">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
