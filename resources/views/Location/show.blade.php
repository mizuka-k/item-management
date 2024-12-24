@extends('adminlte::page')

@section('title', 'イベント詳細')

@section('content_header')
    <h1>イベント詳細</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 p-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $location->title }}</h3>
                </div>
                <div class="table-responsive" style="height:auto">
                    <table class="table align-middle">
                        <tbody>
                            <div class="m-4">
                                @if($location->image)
                                <img src="{{ asset('storage/images/'.$location->image) }}" class="rounded mx-auto d-block" style="height:300px" alt="車両画像">
                                @endif
                            </div>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">ID</th>
                                <td style="width:50%">
                                    <p class="m-0 ">{{ $location->id }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">イベントタイトル</th>
                                <td style="width:50%">
                                    <p class="m-0">{{ $location->title }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">現在のステータス</th>
                                <td class="col-md-6 m-2">
                                    @if($location->status == 0)
                                    <div>募集中</div>
                                    @elseif($location->status == 1)
                                    <div>締切</div>
                                    @endif
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">開催日</th>
                                <td>
                                    <p class="m-0">{{ $location->start_date }} 〜 {{ $location->end_date }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">営業時間</th>
                                <td>
                                    <p class="m-0">{{ substr($location->start_time,0,5) }} 〜 {{ substr($location->end_time,0,5) }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">開催場所</th>
                                <td>
                                    <p class="m-0">{{ $location->address }}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary">詳細</th>
                                <td>
                                    <p class="m-0">{!! nl2br($item->detail) !!}</p>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <th class="text-secondary" style="width:30%">担当者</th>
                                <td style="width:50%">
                                    <p class="m-0">{{ $location->user->name }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <a href="{{ route('location.edit', $location) }}"><button type="button" class="btn btn-primary">編集ページへ</button></a>
                    </div>
                    <div class="text-center m-2">
                        <form method="POST" action="{{ route('location.delete',$location) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
