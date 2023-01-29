<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function index() {
        $this->data['latestProducts'] = Product::with('category', 'manufacturer', 'color', 'images', 'reviews')->orderBy('created_at', 'desc')->paginate(6);
        return view('pages.home', $this->data);
    }
}
