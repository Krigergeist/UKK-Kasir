<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    // Tampilan register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'usr_name' => 'required|string|max:100',
            'usr_email' => 'required|email|unique:users,usr_email',
            'usr_password' => 'required|string|min:6|confirmed',
            'usr_shp_name' => 'required|string|max:100',
            'usr_phone' => 'required|string|max:100',
        ]);

        User::create($request->all());

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Tampilan login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usr_email' => 'required|email',
            'usr_password' => 'required|string',
        ]);

        // Ambil remember me
        $remember = $request->has('remember');

        if (Auth::attempt(['usr_email' => $credentials['usr_email'], 'password' => $credentials['usr_password']], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'usr_email' => 'Email atau password salah!',
        ]);
    }


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
