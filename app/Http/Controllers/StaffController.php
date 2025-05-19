<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        // スタッフ一覧（role = 'staff'）を取得
        $staffs = User::where('role', 'staff')->get();

        return view('staffs.index', compact('staffs'));
    }
    public function create()
    {
        return view('staffs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:60',
            'username' => 'required|alpha|unique:users,username|max:30',
        ]);

        $plainPassword = Str::random(8);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($plainPassword),
            'role' => 'staff',
            'active' => true,
        ]);

        return redirect()->route('staffs.create')->with([
            'password' => $plainPassword,
            'username' => $user->username,
        ]);
    }

    public function toggle($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);

        $staff->active = !$staff->active; // トグル
        $staff->save();

        return redirect()->route('staffs.index')->with('message', 'ステータスを更新しました');
    }

    public function destroy($id)
    {
        $staff = User::where('role', 'staff')->findOrFail($id);
        $staff->delete();

        return redirect()->route('staffs.index')->with('message', 'スタッフを削除しました');
    }

}

