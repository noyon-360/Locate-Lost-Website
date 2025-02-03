<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Stations;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // public function userProfile($id)
    // {
    //     $user = User::with('missingPersons')->findOrFail($id); // Get user with their missing reports
    //     return view('profile.user_profile', compact('user'));
    // }

    // public function stationProfile($id)
    // {
    //     $user = Stations::with('missingPersons')->findOrFail($id);

    //     // echo '<pre>';
    //     // print_r($user->missingPersons->toArray());

    //     return view('profile.common_profile', compact('user'));
    // }
}