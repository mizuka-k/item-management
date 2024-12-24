@extends('adminlte::page')

@section('title', 'ホーム画面')

@section('content_header')
    <h1>KitchenCarHub</h1>
@stop

@section('content')
<div class="container">
    <div class="mx-auto h-auto">
        <div class="center-block">    
            <div id="carouselExampleAutoplaying" class="carousel slide img-fluid" data-bs-ride="carousel" >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="{{ asset('img/food_truck1.jpg') }}" class="d-block img-fluid h-50" alt="">
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('img/food_truck2.jpg') }}" class="d-block img-fluid h-50" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="{{ asset('img/food_truck3.jpg') }}" class="d-block img-fluid h-50" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="container-fluid pb-4">
                <div class="row">
                    <h5 class="text-center py-4">New!!</h5>
                    <div class="col px-5 border-end">
                        <h6 class="text-center">KitchenCar</h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($items as $item)
                            <li class="list-group-item"><a class="link-secondary link-offset-2 text-decoration-none link-opacity-25-hover"href="/search/show/{{ $item->id }}" >[{{ $item->name.':'.$item->created_at }}] が追加されました</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col px-5">
                        <h6 class="text-center">event</h6>
                        <ul class="list-group list-group-flush">
                            @foreach ($locations as $location)
                            <li class="list-group-item"><a class="link-secondary link-offset-2 text-decoration-none link-opacity-25-hover"href="/locations/show/{{ $location->id }}" >[{{ $location->title.':'.$location->created_at }}] が追加されました</a></li>
                            @endforeach
                        </ul>
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
@stop
