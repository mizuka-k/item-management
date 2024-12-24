@extends('adminlte::page')

@section('title', 'キッチンカー情報編集')

@section('content_header')
    <h1>キッチンカー情報編集</h1>
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

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" placeholder="詳細説明">{{ old('detail',$item->detail) }}</textarea>
                        </div>

                    <!-- 画像 -->
                        <div class="form-group text-center">
                            @if($item->image)
                            <div>画像ファイル：{{ $item->image }}</div>
                            <img src="{{ asset('storage/images/'.$item->image) }}" alt="キッチンカーの画像" class="mx-auto m-2" style="height:300px">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">画像(1MBまで)</label>
                            <div>
                                <input type="file" name="image" id="image">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-2">
                        <button type="submit" class="btn btn-primary">編集</button>
                    </div>
                </form>
                <div class="text-center mb-4">
                <form method="POST" action="{{ route('item.delete', $item->id) }}" >
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
