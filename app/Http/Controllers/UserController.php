<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // ユーザー一覧表示
    public function index(User $user, Request $request) {
        $users = User::paginate(10);
        return view('user.index',compact('users'));
    }

    // ユーザー編集画面表示
    public function edit(User $user) {
        return view('user.edit', compact('user'));
    }
    // ユーザー編集処理
    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|alpha_num',
            'email' => 'required','string','email:strict','max:255','unique:users,email,'.$user->email.',email',
            'role' => 'required',
        ]);
        $user->update($validated);
        return back()->with('successMessage','更新しました。');
    }
    // ユーザー情報削除処理
    public function destroy(User $user) {
        $user->delete();
        return back()->with('successMessage','ユーザーを削除しました。');
    }
}
