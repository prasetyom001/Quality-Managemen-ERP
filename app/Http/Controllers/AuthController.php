<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('username','password'))) {
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:4'
        ]);

        User::create([
            'username'=> $request->username,
            'password'=> Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
