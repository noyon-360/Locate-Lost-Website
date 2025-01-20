<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function userProfile($id)
    {
        $user = User::with('missingReports')->findOrFail($id); // Get user with their missing reports
        return view('profile.user_profile', compact('user'));
    }

    public function commonProfile($id)
    {
        $user = User::with('missingReports')->findOrFail($id);
        return view('profile.common_profile', compact('user'));
    }
}