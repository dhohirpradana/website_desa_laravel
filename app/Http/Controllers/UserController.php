<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profil()
    {
        return view('user.profil');
    }

    public function update(User $user)
    {
        # code...
    }

    public function pengaturan(User $user)
    {
        # code...
    }
}
