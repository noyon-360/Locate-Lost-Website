<?php

namespace App\Http\Controllers;

use App\Models\Completion;
use App\Models\MissingPerson;
use App\Models\MissingReports;
use App\Models\SubmittedInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissingPersonController extends Controller
{

    // view add missing person
    public function missiongPersonView()
    {
        return view('missing_person.add_missing_person');
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::guard('admin')->check() && !Auth::guard('station')->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit a missing person report.');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'permanent_address' => 'required|string|max:500',
            'last_seen_location_description' => 'required|string|max:500',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'missing_date' => 'required|date',
            // 'submitted_by' => Auth::guard('station')->user()->email
        ]);

        $data = $validatedData;



        // Handle the front image upload
        if ($request->hasFile('front_image')) {
            $frontImage = $request->file('front_image');
            $data['front_image'] = $frontImage->store('uploads/front_images', 'public');
        }

        // Handle additional pictures upload
        if ($request->hasFile('additional_pictures')) {
            $additionalPictures = $request->file('additional_pictures');
            $data['additional_pictures'] = json_encode(array_map(fn($file) => $file->store('uploads/additional_pictures', 'public'), $additionalPictures));
        }

        $data['submitted_by'] = Auth::guard('station')->user()->email;

        // Store the data in the database
        $missingPerson = MissingPerson::create($data);

        // echo '<pre>';
        // print_r($data);

        return redirect()->route('missing-person-success', $missingPerson->id)->with('success', 'Missing person report submitted successfully.');
    }

    public function showSuccess($id)
    {
        $missingPerson = MissingPerson::findOrFail($id);
        return view('missing_person.missing_person_success', compact('missingPerson'));
    }

    public function edit($id)
    {
        $missingPerson = MissingPerson::findOrFail($id);
        return view('missing_person.edit_missing_person', compact('missingPerson'));
    }

    public function destroy($id)
    {
        $report = MissingPerson::findOrFail($id);
        $report->delete();
        return redirect()->back()->with('success', 'Report deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $missingPerson = MissingPerson::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|max:10',
            'permanent_address' => 'required|string|max:500',
            'last_seen_location_description' => 'required|string|max:500',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'missing_date' => 'required|date',
        ]);

        $data = $validatedData;

        // Handle the front image upload
        if ($request->hasFile('front_image')) {
            $frontImage = $request->file('front_image');
            $data['front_image'] = $frontImage->store('uploads/front_images', 'public');
        }

        // Handle additional pictures upload
        if ($request->hasFile('additional_pictures')) {
            $additionalPictures = $request->file('additional_pictures');
            $data['additional_pictures'] = json_encode(array_map(fn($file) => $file->store('uploads/additional_pictures', 'public'), $additionalPictures));
        }

        // Update the data in the database
        $missingPerson->update($data);

        return redirect()->route('person.details', $missingPerson->id)->with('success', 'Missing person report updated successfully.');
    }

    public function person_details_show($id)
    {
        if (!Auth::guard('admin')->check() && !Auth::guard('station')->check() && !Auth::guard('web')->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view the details of a missing person.');
        }

        $person = MissingPerson::findOrFail($id);
        // $missingPersonAdditionalReports = MissingReports::where('missing_person_id', $id)->get();
        // $missingPersonAdditionalReports = MissingReports::with('missingPerson', 'user')->where('missing_person_id', $id)->get();

        $missingPersonAdditionalReports = MissingReports::with(['missingPerson', 'user', 'station', 'comments'])
            ->where('missing_person_id', $id)
            ->get();



        // echo '<pre>';
        // print_r($missingPersonAdditionalReports->toArray());

        // Fetch user information for each additional report
        // $additionalReportsWithUser = $missingPersonAdditionalReports->map(function ($report) {
        //     $report->user = User::findOrFail($report->user_id);
        //     return $report;
        // });

        // Note :: check there is a problem, wihtout added any missing report resoponse then show the full data, but when add any response then its not show, check the problems

        return view('missing_person.show_details', compact('person', 'missingPersonAdditionalReports'));
    }

    public function addInfo($id)
    {
        $person = MissingPerson::findOrFail($id);
        $response = MissingReports::where('missing_person_id', $id)->first();

        return view('missing_person.add_info', compact('person', 'response'));
    }


    public function storeInfo(Request $request, $id)
    {
        $request->validate([
            // 'missing_person_id' => 'required|exists:missing_people,id',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'seen_at' => 'required|date',
        ]);

        $missingReport = new MissingReports();
        $missingReport->missing_person_id = $id;
        $missingReport->description = $request->description;
        $missingReport->latitude = $request->latitude;
        $missingReport->longitude = $request->longitude;
        $missingReport->seen_at = $request->seen_at;

        if (auth('web')->check()) {
            $missingReport->user_id = auth('web')->id();
            $missingReport->submitted_by = auth('web')->user()->email;
            $missingReport->role = 'user';
        } elseif (auth('station')->check()) {
            $missingReport->station_id = auth('station')->id();
            $missingReport->submitted_by = auth('station')->user()->email;
            $missingReport->role = 'station';
            $missingReport->station_name = auth('station')->user()->station_name;
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // echo '<pre>';
        // print_r($missingReport->toArray());

        $missingReport->save();

        return redirect()->route('person.details', $id)->with('success', 'Information submitted successfully.');
    }

    public function showLocation($id)
    {
        $info = MissingReports::with('missingPerson', 'user', 'station')->findOrFail($id);

        // echo "<pre>";
        // print_r($info->toArray());

        return view('missing_person.show_location', compact('info'));
    }

    public function showAllLandmarks($id)
    {
        $info = MissingReports::with('missingPerson', 'user', 'station')->where('missing_person_id', $id)->get();
        // echo "<pre>";
        // print_r($info->toArray());

        return view('missing_person.all_landmarks', compact('info'));
    }

    // Missing person Completion 
    public function missingPersonCompletion(Request $request, $id)
    {
        $request->validate([
            'found_date' => 'required|date',
            'missing_person_id' => 'required|exists:missing_people,id',
            'found_location' => 'required|string|max:255',
            'recovery_details' => 'required|string',
            'documents.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);



        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('documents', 'public');
                $documentPaths[] = $path;
            }
        }
        
        $missingPerson = MissingPerson::findOrFail($id);
        
        $newCompletion= new Completion([
            'found_date' => $request->found_date,
            'missing_person_id' => $missingPerson->id ?? null,
            'found_location' => $request->found_location,
            'recovery_details' => $request->recovery_details,
            'documents' => $documentPaths,
        ]);
        
        // echo "<pre>";
        // print_r($missingPerson->id);
        $newCompletion->save();

        $missingPerson->update(['status' => 'completed']);

        return back()->with('success', 'Completion details submitted successfully.');
    }
}
