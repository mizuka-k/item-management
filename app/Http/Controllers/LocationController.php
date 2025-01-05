<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;
use Illuminate\Support\Facades\storage;

class LocationController extends Controller
{
    /**
     * イベント一覧
     */
    public function index(Location $location)
    {
        $locations = Location::paginate(10);
        return view('Location.index', compact('locations'));
    }

    /**
     * イベント登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'title' => 'required|max:100',
                'address' => 'required|max:255',
                'detail' => 'required|max:1000',
                'start_date' => 'required',
                'end_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'image' => 'image|max:1024',
            ]);

            // イベント登録処理
            $location = new Location();
                $location->user_id = Auth::user()->id;
                $location->title = $request->title;
                $location->start_date = $request->start_date;
                $location->end_date = $request->end_date;
                $location->start_time = $request->start_time;
                $location->end_time = $request->end_time;
                $location->address = $request->address;
                $location->detail = $request->detail;

            if(request('image')) {
                $original = $request->file('image')->getClientOriginalName();
                $name = date('Ymd_His').'_'.$original;
                request()->file('image')->move('storage/',$name);
                $location->image =  $name;
            }
            $location->save();
            return redirect('/locations/index')->with('successMessage', '保存しました。');
        }
        return view('Location.add');

    }

    /**
     *  詳細表示
     */
    public function show(Location $location) {
        return view('Location.show',compact('location'));
    }
    /**
     *  イベント情報編集
     */
    public function edit(Request $request, Location $location) {

        // POSTリクエストのとき
        if ($request->isMethod('patch')) {
        // イベント情報編集処理
            $validated = $request->validate([
                'title' => 'required|max:100',
                'status' => 'integer',
                'start_date' => 'required',
                'end_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'address' => 'required|max:255',
                'detail' => 'required|max:1000',
                'image' => 'image|max:1024',
            ]);
    
                if(request('image')) {
                    // if($location->image !== 'location_default.jpg') {
                    //     $oldlocation = 'public/locations/'.$location->image;
                    //     Storage::delete($oldlocation);
                    // }
                    $original = $request->file('image')->getClientOriginalName();
                    $name = date('Ymd_His').'_'.$original;
                    request()->file('image')->move('storage',$name);
                    $validated['image'] =  $name;
                }
            $validated['user_id'] = Auth::user()->id;
            $location->update($validated);
            return redirect()->route('location.edit', $location)->with('successMessage', '更新しました。');
        }

        return view('Location.edit', compact('location'));
    }


    // イベント削除
    public function destroy(Location $location) {
        // if($location->image !== 'location_default.jpg') {
        //     $oldlocation = 'public/locations/'.$location->image;
        //     Storage::delete($oldlocation);
        // }
        $location->delete();
        return redirect()->route('location.index', $location)->with('alertMessage', '削除しました。');
    }

}
