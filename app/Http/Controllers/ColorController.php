<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends BaseController
{
    public function getAllColorsAction() {
        return Color::all();
    }
}
