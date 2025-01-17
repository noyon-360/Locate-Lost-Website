<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Missing Person Report</title>
    @vite('resources/css/app.css')
</head>

@extends('layouts.app')

<body class="bg-police text-police">
    @section('content')
    <div class="container mx-auto p-4 sm:p-6">
        <div class="bg-darkSlate p-6 rounded-lg shadow-lg max-w-4xl mx-auto border border-darkBlue">
            <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-lightGray">
                <i class="fas fa-edit"></i> Edit Missing Person Report
            </h1>
            <form action="{{ route('update-missing-person', $missingPerson->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Personal Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray">
                        <i class="fas fa-user "></i> Personal Information
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                        <div>
                            <label for="fullname" class="block text-lightGray font-medium mb-1">Full Name</label>
                            <input type="text" id="fullname" name="fullname" value="{{ $missingPerson->fullname }}"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg  text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-lightGray font-medium mb-1">Date of
                                Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                value="{{ $missingPerson->date_of_birth }}"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                        <div>
                            <label for="gender" class="block text-lightGray font-medium mb-1">Gender</label>
                            <select id="gender" name="gender"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                                <option value="male" {{ $missingPerson->gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ $missingPerson->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ $missingPerson->gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                        <!-- Add other form fields as needed -->
                    </div>
                </div>
                <!-- Add other sections as needed -->
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-lightGray text-darkSlate font-bold py-2 rounded-lg hover:bg-darkGray">
                        Update Report
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>

</html>