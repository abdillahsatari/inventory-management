<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (Auth::check())
            return redirect(route('redirect.user'));
        return view('auth.admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $request->session()->regenerate();

            if (auth()->user()->role_id !== 5) {
                return redirect()->intended('/admin');
            } else {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect(route('login'));
            }
        }

        return redirect()->back()->with('error', 'Incorrect Email or Password');
    }

    public function cashierLoginForm()
    {
        if (Auth::guard('cashier')->check())
            return redirect(route('redirect.user'));
        return view('auth.cashier.login');
    }

    public function cashierLogin(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'password' => 'required'
        ]);

        $credentials = $request->only('password');
        $credentials['role_id'] = 5;

        if (auth()->guard('cashier')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route('cashier.index'));
        }

        return redirect()->back()->with(['error' => 'Incorrect Email or Password']);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard("cashier")->check() ?
            auth()->guard('cashier')->logout() : auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
