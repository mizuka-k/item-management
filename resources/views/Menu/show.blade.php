@extends('adminlte::page')

@section('title', 'メニュー詳細')

@section('content_header')
    <h1>メニュー詳細</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 p-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $menu->name }}</h3>
                </div>
                <div class="table-responsive" style="height:auto">
                    <table class="table align-middle">
                        <tbody>
                            <div class="m-4">
                                @if($menu->image)
                                <img src="{{ asset('storage/menu/'.($menu->image??'menu.jpg')) }}" class="rounded mx-auto d-block" style="height:300px" alt="メニュー画像">
                                @endif
                            </div>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">ID</th>
                                <td style="width:50%">
                                    <p class="m-0 ">{{ $menu->id }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">商品名</th>
                                <td style="width:50%">
                                    <p class="m-0">{{ $menu->name }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">価格</th>
                                <td style="width:50%">
                                    <p class="m-0">{{ $menu->price }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">商品説明</th>
                                <td style="width:50%">
                                    <p class="m-0">{{ $menu->detail }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @can('admin')
                    <div class="text-center">
                        <a href="{{ route('menu.edit', $menu) }}"><button type="button" class="btn btn-outline-info">編集ページへ</button></a>
                    </div>
                    <div class="text-center m-2">
                        <form method="POST" action="{{ route('menu.delete',$menu) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </div>
                    @endcan
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
