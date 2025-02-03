<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MissingReports;
use App\Models\SubmittedInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function edit($id)
    {
        $response = MissingReports::with('missingPerson')->findOrFail($id);
        $person = $response->missingPerson;
        // echo "<pre>";
        // print_r($person->toArray());
        return view('missing_person.update_info', compact('response', 'person'));
    }

    public function update(Request $request, $id)
    {
        // check which user is logged in in there two user can log in station and web user and then provide the route name
        if (!Auth::guard('admin')->check() && !Auth::guard('station')->check() && !Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to update a response.');
        }
        
        $response = MissingReports::findOrFail($id);
        $response->update($request->all());

        // check which user is logged then provide the route name
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('success', 'Response updated successfully.');
        }
        elseif (Auth::guard('station')->check()) {
            return redirect()->route('station.dashboard')->with('success', 'Response updated successfully.');
        }
        elseif (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard')->with('success', 'Response updated successfully.');
        }
        else {
            return redirect()->route('welcome')->with('success', 'Response updated successfully.');
        }
    }

    public function destroy($id)
    {
        // check which user is logged in in there two user can log in station and web user and then provide the route name
        if (!Auth::guard('admin')->check() && !Auth::guard('station')->check() && !Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to update a response.');
        }

        $response = MissingReports::findOrFail($id);
        $response->delete();

         // check which user is logged then provide the route name
         if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard')->with('success', 'Response updated successfully.');
        }
        if (Auth::guard('station')->check()) {
            return redirect()->route('station.dashboard')->with('success', 'Response updated successfully.');
        }
        if (Auth::guard('web')->check()) {
            return redirect()->route('web.dashboard')->with('success', 'Response updated successfully.');
        }
        // return redirect()->route('user.dashboard')->with('success', 'Response deleted successfully.');
    }
}
