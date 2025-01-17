<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function showMapForm()
    {
        return view('map');
    }

    public function storeLocation(Request $request)
    {
        $location = $request->only(['latitude', 'longitude']);
        // You can store this information in the database as needed

        return response()->json(['status' => 'success', 'data' => $location]);
    }
}