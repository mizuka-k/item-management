<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    // プロフィール表示
    public function edit() {
        $auth = Auth::user();
        return view('profile.edit', compact('auth'));
    }

    // プロフィール編集
    public function update(Request $request, User $user) {
        $user = Auth::user();
        // バリデーションチェック
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|max:255|unique:users,email,'.Auth::user()->email.',email',
        ],
        [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は100文字以下で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email' => '有効なメールアドレスではありません。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
        ]);
        $user->update($validated);
        return redirect()->route('profile.edit','$user->id')->with('successMessage','更新しました。');
    }

    // パスワード編集表示
    public function passwordEdit() {
        $auth = Auth::user();
        return view('profile.password_edit', compact('auth'));
    }

    // パスワード更新
    public function passwordUpdate(Request $request, User $user) {
        $user = Auth::user();
        // 現在のパスワードが合っているか確認
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return back()->with('alertMessage','現在のパスワードが間違っています。');
        }
        $validated = $request->validate([
            'password' => 'required|min:8|string|confirmed',
        ],
        [
            'password.min' => 'パスワードは6字以上255字以下で入力してください。',
            'password.confirmed' => '入力したパスワードがパスワード（確認）と一致しません。',
        ]);

        // パスワードハッシュ化
        $validated['password'] = Hash::make($validated['password']);

        $user->update($validated);
        return redirect()->route('password.edit','$user->id')->with('successMessage','更新しました。');
        }


}
