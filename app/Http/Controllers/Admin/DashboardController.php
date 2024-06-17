<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
   public function index(){

    $house_number=House::where('user_id', Auth::user()->id)->count();
    $last_house=House::where('user_id', Auth::user()->id)->orderByDesc('id')->first();



    return view('admin.home',compact('house_number','last_house'));
   }
}
