<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Message;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function index(){
        $houses = House::with('user', 'messages', 'images', 'services', 'sponsors')->paginate(12);
        return response()->json($houses);
    }
}
