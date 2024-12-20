<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Support\Facades\storage;


class ItemController extends Controller
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
     * キッチンカー一覧
     */
    public function index()
    {
        // キッチンカー一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * キッチンカー登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'detail' => 'max:500',
                'image' => 'image|max:1024',
            ]);

            // キッチンカー登録処理
            $item = new Item();
                $item->user_id = Auth::user()->id;
                $item->name = $request->name;
                $item->detail = $request->detail;

            if(request('image')) {
                $original = $request->file('image')->getClientOriginalName();
                $name = date('Ymd_His').'_'.$original;
                request()->file('image')->move('storage/images',$name);
                $item->image =  $name;
            }
            $item->save();
            return redirect('/items')->with('successMessage', '保存しました。');
        }

        return view('item.add');
    }

    /**
     *  キッチンカー情報詳細表示
     */
    public function edit(Item $item) {
        return view('item.edit', compact('item'));
    }

    // キッチンカー情報編集処理
    public function update(Request $request, Item $item) {
        $validated = $request->validate(([
            'name' => 'required|max:100',
            'detail' => 'max:500',
            'image' => 'image|max:1024',
        ]));

        if(request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/images',$name);
            $item->image =  $name;
        }
        $validated['user_id'] = Auth::user()->id;
        $item->update($validated);
        return redirect()->route('item.edit', $item)->with('successMessage', '更新しました。');
    }

    // キッチンカー削除
    public function destroy(Item $item) {
        // $this->authorize('delete', $item);
        // if($item->image) {
        //     Storage::disk('public')->delete('images/'.$item->image);
        // }
        $item->delete();
        return redirect()->route('item.index', $item)->with('alertMessage', '削除しました。');
    }

}
