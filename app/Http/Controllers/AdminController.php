<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    public function index(Request $request) {
        $userSession = $request->session()->get('user', 'default');

        if ($userSession && isset($userSession['role_id']) && $userSession['role_id'] == 2) {
            return view('pages.adminPanel');
        } else {
            return redirect('/');
        }
    }
}
