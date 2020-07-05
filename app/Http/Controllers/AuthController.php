<?php

namespace App\Http\Controllers;

use App\Rules\LoginRule;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.masuk');
    }

    public function masuk(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'max:64', 'required_with:password', new LoginRule($request->password)],
            'password'  => ['required']
        ]);

        return redirect()->route('home.index');
    }

    public function keluar()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
