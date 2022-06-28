<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
