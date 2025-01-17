<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MissingPerson;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function view()
    {
        return view('welcome');
    }

    public function index()
    {
        // Fetch all records from the database
        // $missingPersons = MissingPerson::all();
        // $missingPersons = MissingPerson::select('fullname',)->get();
        $missingPersons = MissingPerson::select('id', 'fullname', 'front_image', 'missing_date', 'date_of_birth', 'gender', 'last_seen_location_description')->get();


        // Pass the data to the view
        return view('welcome', compact('missingPersons'));
    }
}