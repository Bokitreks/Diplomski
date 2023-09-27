<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends BaseController
{
    public function getAllMaterialsAction() {
        return Material::all();
    }
}
