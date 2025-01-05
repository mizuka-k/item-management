@extends('adminlte::page')

@section('title', 'キッチンカー情報')

@section('content_header')
    <h1>キッチンカー情報</h1>
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

        <div class="col-12 p-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $item->name }}</h3>
                </div>
                <div class="table-responsive" style="height:auto">
                    <table class="table align-middle">
                        <!-- <div class="row">
                            <div class="col p-4">
                                @if($item->image) -->
                                <!-- <img src="{{ asset('storage/'.($item->image??'img/kitchen_car_default.jpg')) }}" class="rounded mx-auto d-block" style="height:300px" alt="車両画像"> -->
                                <!-- @endif
                            </div>
                        </div> -->
                        <tbody>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">ID</th>
                                <td style="width:50%">
                                    <p class="m-0 ">{{ $item->id }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">屋号</th>
                                <td style="width:50%">
                                    <p class="m-0">{{ $item->name }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">詳細</th>
                                <td>
                                    <p class="m-0">{{ $item->detail }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">登録日時</th>
                                <td>
                                    <p class="m-0">{{ $item->created_at->format('Y-m-d H:i') }}</p>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    @can('admin')
                    <div class="text-center">
                        <a href="{{ route('item.edit', $item) }}"><button type="button" class="btn btn-outline-info">編集ページへ</button></a>
                    </div>
                    <div class="text-center m-2">
                        <form method="POST" action="{{ route('item.delete',$item) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </div>
                    @endcan 
                </div>
            </div>

@stop

@section('css')
@stop

@section('js')
@stop
