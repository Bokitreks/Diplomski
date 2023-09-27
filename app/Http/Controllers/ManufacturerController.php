<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends BaseController
{
    public function getAllManufacturersAction() {
        return Manufacturer::all();
    }
}
