<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends BaseController
{
    public function getAllWarehousesAction() {
        return Warehouse::all();
    }
}
