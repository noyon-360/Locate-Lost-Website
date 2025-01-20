<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missing Person Report Submitted</title>
    @vite('resources/css/app.css')
</head>

@extends('layouts.app')

<body class="bg-police text-police">
    @section('content')
    <div class="container mx-auto p-4 sm:p-6">
        <div class="bg-darkSlate p-6 rounded-lg shadow-lg max-w-4xl mx-auto border border-darkBlue">
            <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-lightGray">
                <i class="fas fa-check-circle"></i> Missing Person Report Submitted Successfully
            </h1>
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                Your missing person report has been submitted successfully.
            </div>
            <div class="mt-6">
                <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray">Report Details</h2>
                <ul class="list-disc list-inside text-lightGray">
                    <li><strong>Full Name:</strong> {{ $missingPerson->fullname }}</li>
                    <li><strong>Date of Birth:</strong> {{ $missingPerson->date_of_birth }}</li>
                    <li><strong>Gender:</strong> {{ $missingPerson->gender }}</li>
                    <li><strong>Permanent Address:</strong> {{ $missingPerson->permanent_address }}</li>
                    <li><strong>Last Seen Location:</strong> {{ $missingPerson->last_seen_location_description }}</li>
                    <li><strong>Father's Name:</strong> {{ $missingPerson->father_name }}</li>
                    <li><strong>Mother's Name:</strong> {{ $missingPerson->mother_name }}</li>
                    <li><strong>Contact Number:</strong> {{ $missingPerson->contact_number }}</li>
                    <li><strong>Email:</strong> {{ $missingPerson->email }}</li>
                    <li><strong>Front Image:</strong> <img src="{{ asset('storage/' . $missingPerson->front_image) }}"
                            alt="Front Image" class="w-32 h-32 object-cover"></li>
                    @if ($missingPerson->additional_pictures)
                    <li><strong>Additional Pictures:</strong>
                        @foreach (json_decode($missingPerson->additional_pictures) as $picture)
                        <img src="{{ asset('storage/' . $picture) }}" alt="Additional Picture"
                            class="w-32 h-32 object-cover inline-block">
                        @endforeach
                    </li>
                    @endif
                </ul>
                <div class="mt-6">
                    <a href="{{ route('edit-missing-person', $missingPerson->id) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        <i class="fas fa-edit"></i> Edit Report
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>

</html>