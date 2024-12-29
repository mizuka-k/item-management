@extends('adminlte::page')

@section('title', 'メニュー編集')

@section('content_header')
    <h1>{{ $menu->item->name }}</h1>
@stop

@section('content')
@if(session('alertMessage'))
    <div class="mt-4 alert alert-danger" role="alert">
        {{ session('alertMessage')}}
    </div>
@elseif(session('successMessage'))
    <div class="mt-4 alert alert-success" role="alert">
        {{ session('successMessage' )}}
    </div>
@endif
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
                <form method="POST" action="{{ route('menu.update', $menu) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="item_id" value="{{ $menu->item->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">商品名</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="商品名" value="{{ old('name',$menu->name) }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">価格</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="価格" value="{{ old('price',$menu->price) }}">
                        </div>
                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{ old('detail',$menu->detail) }}</textarea>
                        </div>

                    <!-- 画像 -->
                        <div class="form-group">
                            @if($menu->image)
                            <div class="text-center">
                                <img src="{{ asset('storage/menu/'.$menu->image) }}" alt="イベントイメージ" class="mx-auto m-2" style="height:300px">
                            </div>
                            @endif
                            <label for="image">画像:1MBまで</label>
                            <div>
                                <input type="file" name="image" id="image">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">編集する</button>
                        <a href="{{ route('menu.index',$menu) }}"><button type="button" class="btn btn-secondary m-2">戻る</button></a>
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
