<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data['navigation'] = Navigation::all();
    }
}
