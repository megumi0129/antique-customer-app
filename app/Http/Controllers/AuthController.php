<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        // dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if (!$user->active) {
                Auth::logout();
                return back()->withErrors(['username' => 'アカウントは無効です。']);
            }
            return redirect()->intended(route('customers.search'));
        }

        return back()->withErrors(['username' => 'ログイン情報が正しくありません。']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
