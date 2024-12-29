@extends('adminlte::page')

@section('title', 'メニューリスト')

@section('content_header')
    <h1></h1>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title ">メニューリスト</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <th style="width:20%">商品名</th>
                        <th style="width:10%">画像</th>
                        <th style="width:10%">価格</th>
                        <th style="width:50%">説明</th>
                        <th style="width:10%"></th>
                        <tbody>
                            @foreach ($menus as $menu)
                            <tr>
                                <td style="width:20%">{{ $menu->name }}</td>
                                <td style="width:10%">
                                    <img src="{{ asset('storage/'.($menu->image??'menu.jpg')) }}" class="rounded mx-auto d-block" style="height:30px" alt="メニュー画像">
                                </td>
                                <td style="width:10%">{{ $menu->price."円" }}</td>
                                <td>{{ Str::limit($menu->detail,200,'...') }}</td>
                                <td style="width:5%">
                                    <p>
                                        <a href="{{ route('menu.show',$menu) }}"><button type="button" class="btn btn-outline-info">詳細</button></a>
                                    </p>
                                </td>
                                @can('admin')
                                <td style="width:5%"> 
                                    <form method="POST" action="{{ route('menu.delete', $menu->id) }}" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </td>
                                @endcan
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $menus->links('vendor.pagination.bootstrap-5') }}
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
