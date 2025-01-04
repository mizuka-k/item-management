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
        return view('item.index', [
            'items' => Item::paginate(10),
        ]);
    }

    /**
     * キッチンカー登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $validated = $request->validate([
                'name' => 'required|max:100',
                'detail' => 'required|max:1000',
                'image' => 'image|max:1024',
            ]);

            $imagePath = null;
            if ($request->hasFile('image'))
            {
                // ファイルをS3にアップロード
                $imagePath = $request->file('image')->store('item_images', 's3');
                // アップロードしたファイルのアクセスを制限する（デフォルトでprivate）
                Storage::disk('s3')->setVisibility($imagePath, 'private');
        }

            // キッチンカー登録処理
            $item = Item::create([
                'name' => $request->name,
                'detail' => $request->detail,
                'image' => $request->image,
                'user_id' => Auth::user()->id,
            ]);

            return redirect('/items/index')->with('successMessage', '保存しました。');
        }

        return view('item.add');
    }

    /**
     *  キッチンカー情報詳細表示
     */
    public function show(Item $item) {
        return view('item.show', compact('item'));
    }

    // キッチンカー情報編集処理
    public function update(Request $request, Item $item) {
        // POSTリクエストのとき
        if ($request->isMethod('patch')) {
            $validated = $request->validate(([
                'name' => 'required|max:100',
                'detail' => 'required|max:1000',
                'image' => 'image|max:1024',
            ]));

            if(request('image')) {
                // if($item->image !== 'kitchen_car_default.jpg') {
                //     $oldavatar = 'storage/'.$item->image;
                //     Storage::delete($oldavatar);
                // }
                $original = $request->file('image')->getClientOriginalName();
                $name = date('Ymd_His').'_'.$original;
                request()->file('image')->move('storage/',$name);
                $validated['image']  = $name;
            }
            $item->update($validated);
            return redirect()->route('item.edit', $item)->with('successMessage', '更新しました。');
        }

        return view('item.edit',compact('item'));
    }

    // キッチンカー削除
    public function destroy(Item $item) {

        // if($item->image !== 'kitchen_car_default.jpg') {
        //     $avatar = 'storage/'.$item->image;
        //     Storage::delete($avatar);
        // }
        $item->delete();
        return redirect()->route('item.index', $item)->with('alertMessage', '削除しました。');
    }

}
