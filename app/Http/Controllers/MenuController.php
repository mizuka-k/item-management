<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Menu $menu)
    {
        return view('Menu.index', [
            'menus' => Menu::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Menu.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = request()->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|integer|min:0',
            'detail' => 'string|max:500',
            'image' => 'image|max:1024',
        ]);

        $menu = Menu::create([
            'name' => $inputs['name'],
            'price' => $inputs['price'],
            'detail' => $inputs['detail'],
            'item_id' => $request->item_id,
        ]);
        if(request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His').'_'.$original;
            request()->file('image')->move('storage/menu',$name);
            $menu->image =  $name;
        }
        $menu->save();

        return back()->with('successMessage','メニューを登録しました');
    }


    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('Menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request ,Menu $menu)
    {
                // POSTリクエストのとき
                if ($request->isMethod('patch')) {
                    $validated = $request->validate(([
                        'name' => 'required|max:100',
                        'detail' => 'max:1000',
                        'image' => 'image|max:1024',
                    ]));
        
                    if(request('image')) {
                        // if($menu->image !== 'menu.jpg') {
                        //     $oldavatar = 'public/menu/'.$menu->image;
                        //     Storage::delete($oldavatar);
                        // }
                        $original = $request->file('image')->getClientOriginalName();
                        $name = date('Ymd_His').'_'.$original;
                        request()->file('image')->storeAs('public/menu',$name);
                        $validated['image']  = $name;
                    }
                    $validated['item_id'] = $request->item_id;

                    $menu->update($validated);
                    return redirect()->route('menu.edit', $menu)->with('successMessage', '更新しました。');
                }
        
                return view('Menu.edit',compact('menu'));
            }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index', $menu)->with('alertMessage', '削除しました。');
    }
}
