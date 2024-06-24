<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function sponsors(House $house, Sponsor $sponsors){

        if (Auth::id() !== $house->user_id) {
            abort('404');
        }
        $sponsors = Sponsor::all();
        return view('admin.houses.sponsors', compact('sponsors', 'house'));
    }


}
