<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm() {
        if (Auth::check()) return redirect(route('redirect.user'));
        return view('auth.admin.login');
    }

    public function login(Request $request) {
        // validasi
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {

            // buat ulang session login
            $request->session()->regenerate();

            if (auth()->user()->role_id === 2) {
                // jika user admin
                return redirect()->intended('/admin');
            } elseif(auth()->user()->role_id === 5){
                // jika user kasir
                return redirect()->intended('/kasir');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        return back()->with('error', 'email atau password salah');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
