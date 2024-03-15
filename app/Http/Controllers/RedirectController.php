<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function redirectUser() {
        if (Auth::user()->role_id !== 5) {
            return redirect('/admin');
        } elseif(Auth::guard('cashier')->check()) {
            return redirect('/cashier');
        }
    }
}
