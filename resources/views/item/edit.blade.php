@extends('adminlte::page')

@section('title', 'キッチンカー情報編集')

@section('content_header')
    <h1>キッチンカー情報編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
        @if(session('alertMessage'))
            <div class="mt-4 alert alert-danger" role="alert">
                {{ session('alertMessage')}}
            </div>
        @elseif(session('successMessage'))
            <div class="mt-4 alert alert-success" role="alert">
                {{ session('successMessage' )}}
            </div>
        @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('item.update',$item) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">屋号</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name',$item->name) }}" placeholder="屋号">
                        </div>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{ old('detail',$item->detail) }}</textarea>
                        </div>
                        @error('detail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    <!-- 画像 -->
                        <div class="form-group text-center">
                            @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" alt="キッチンカーの画像" class="mx-auto m-2" style="height:300px">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">画像(1MBまで)</label>
                            <div>
                                <input type="file" name="image" id="image">
                            </div>
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center m-4">
                        <div class="text-center mb-2">
                            <button type="submit" class="btn btn-info">編集</button>
                        </div>
                        <div class="m-2">
                            <a href="{{ route('item.index',$item) }}"><button type="button" class="btn btn-secondary">戻る</button></a>
                        </div>
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
