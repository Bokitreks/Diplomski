<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index() {
        return view('pages.home',$this->data);
    }
}
