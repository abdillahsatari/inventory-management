<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectUser() {
        if (auth()->user()->role_id === 5) {
            return redirect('/kasir');
        } else {
            return redirect('/admin');
        }
    }
}
