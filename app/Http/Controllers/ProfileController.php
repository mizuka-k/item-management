<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    // プロフィール編集画面表示
    public function edit(Auth $auth, User $user) {
        $user = Auth::user();
        dd($user);
        return view('profile.edit', compact('user'));
    }

    // プロフィール編集
    public function update(Request $request, User $user) {
        // バリデーションチェック
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email:rfc,filter|regex:/^[!-~]+$/|unique:users,email,'.Auth::user()->email.',email',
            'password' => ['nullable','min:6','confirmed','regex:/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]+\z/i']
        ],
        [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は100文字以下で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email' => '有効なメールアドレスではありません。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
            'password.min' => 'パスワードは6字以上255字以下で入力してください。',
            'password.confirmed' => '入力したパスワードがパスワード（確認）と一致しません。',
            'password.regex' => '半角英数字記号それぞれ一文字以上使用してください',
        ]);
        // パスワードの値に入力があれば
        if ($validated['password']) {
            // 現在のパスワードが合っているか確認
            if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
                return back()->with('alertMessage','現在のパスワードが間違っています。');
            }
            // パスワードハッシュ化
            $validated['password'] = Hash::make($validated['password']);
            
        } else {
        // 値が無ければパラメータに含めない
        unset($validated['password']);
    }
    $user->update($validated);
    return redirect()->route('profile.edit','$user->id')->with('successMessage','更新しました。');
}


}
