<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Item::orderBy('updated_at','desc')->take(5)->get();
        $locations = Location::orderBy('updated_at','desc')->take(5)->get();

        return view('home',compact('items','locations'));
        return view('home');
    }
}
