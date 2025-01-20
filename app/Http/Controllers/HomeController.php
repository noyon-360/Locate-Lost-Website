<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MissingPerson;
use App\Models\SubmittedInfo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function view()
    {
        return view('welcome');
    }

    // Missing report controller 
    // public function missingReport()
    // {
    //     return view('missing_report_view');
    // }

    public function index(Request $request)
    {
        $query = MissingPerson::query();


        // Search System
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('fullname', 'like', "%$search%")
                    ->orWhere('father_name', 'like', "%$search%")
                    ->orWhere('mother_name', 'like', "%$search%")
                    ->orWhere('permanent_address', 'like', "%$search%")
                    ->orWhere('gender', 'like', "%$search%");
            });
        }

        $missingPersons = $query->with('user:id,name,email,profile_picture')
            ->withCount('submittedInfos')
            ->select('id', 'fullname', 'front_image', 'missing_date', 'date_of_birth', 'gender', 'permanent_address', 'status', 'user_id', 'user_email')->get();



        // echo "<pre>";
        // print_r($missingPersons->toArray());
        return view('missing_report_view', compact('missingPersons'));
    }
}
