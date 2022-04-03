<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends HomeController
{
    public function showLoginForm() {
        return view('pages/login');
    }
    public function showRegisterForm()
    {
        return view('pages/register');
    }
    public function register(Request $request){

    }
    public function login(Request $request)
    {

    }
}
