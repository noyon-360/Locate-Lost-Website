<?php

namespace App\Http\Controllers;

use App\Models\MissingPerson;
use App\Models\SubmittedInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // public function showProfile()
    // {
    //     // print_r($id);
    //     $user = Auth::user();
    //     // echo '<pre>';
    //     // print_r($user);
    //     return view('auth.user_dashboard', compact('user'));
    // }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully.');
    }

    public function deleteAccount()
    {
        $user = User::find(Auth::id());

        // Delete related SubmittedInfo and MissingPerson records
        $user->missingPersons()->delete();
        $user->submittedInfos()->delete();

        // Delete the user
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
