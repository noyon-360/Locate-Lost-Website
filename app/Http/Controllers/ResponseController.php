<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubmittedInfo;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function edit($id)
    {
        $response = SubmittedInfo::findOrFail($id);
        $person = $response->missingPerson;
        return view('missing_person.add_info', compact('response', 'person'));
    }

    public function update(Request $request, $id)
    {
        $response = SubmittedInfo::findOrFail($id);
        $response->update($request->all());
        return redirect()->route('user.dashboard')->with('success', 'Response updated successfully.');
    }

    public function destroy($id)
    {
        $response = SubmittedInfo::findOrFail($id);
        $response->delete();
        return redirect()->route('user.dashboard')->with('success', 'Response deleted successfully.');
    }
}
