<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * イベント一覧
     */
    public function index()
    {
        // イベント一覧取得
        $locations = Location::all();
        return view('location.index', compact('locations'));
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
                'detail' => 'max:500',
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
                request()->file('image')->move('storage/images',$name);
                $location->image =  $name;
            }
            $location->save();
            return redirect('/locations/index')->with('successMessage', '保存しました。');
        }
        return view('location.add');

    }

    /**
     *  詳細表示
     */
    public function show(Location $location) {
        return view('location.show',compact('location'));
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
                'detail' => 'max:500',
                'image' => 'image|max:1024',
            ]);
    
                if(request('image')) {
                    $original = $request->file('image')->getClientOriginalName();
                    $name = date('Ymd_His').'_'.$original;
                    request()->file('image')->move('storage/images',$name);
                    $location->image =  $name;
                }
            $validated['user_id'] = Auth::user()->id;
            $location->update($validated);
            return redirect()->route('location.edit', $location)->with('successMessage', '更新しました。');
        }

        return view('location.edit', compact('location'));
    }


    // イベント削除
    public function destroy(Location $location) {
        // $this->authorize('delete', $item);
        // if($item->image) {
        //     Storage::disk('public')->delete('images/'.$item->image);
        // }
        $location->delete();
        return redirect()->route('location.index', $location)->with('alertMessage', '削除しました。');
    }

}
