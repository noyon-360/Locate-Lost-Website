@extends('layouts.app')

@section('content')

<body>
    <div class="container mx-auto py-8 px-4 lg:px-8 bg-gray-50 min-h-screen">
        <!-- Page Header -->
        <h1 class="text-4xl font-bold text-center mb-12 text-gray-800">
            Details for {{ $person->fullname }}
        </h1>

        <!-- Main Content -->
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Front Image -->
                <div class="lg:col-span-1">
                    <div class="rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $person->front_image) }}" alt="Front Image"
                            class="w-full h-64 object-cover">
                    </div>
                </div>

                <!-- Details -->
                <div class="lg:col-span-2 space-y-6 text-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        Personal Information
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <p><strong class="font-medium text-gray-900">Full Name:</strong> {{ $person->fullname }}</p>
                        <p><strong class="font-medium text-gray-900">Date of Birth:</strong>
                            {{ $person->date_of_birth }}</p>
                        <p><strong class="font-medium text-gray-900">Gender:</strong> {{ ucfirst($person->gender) }}</p>
                        <p><strong class="font-medium text-gray-900">Last Seen:</strong>
                            {{ $person->last_seen_location_description }}</p>
                        <p><strong class="font-medium text-gray-900">Contact:</strong> {{ $person->contact_number }}</p>
                        <p><strong class="font-medium text-gray-900">Email:</strong> {{ $person->email }}</p>
                    </div>
                    <p><strong class="font-medium text-gray-900">Additional Info:</strong>
                        {{ $person->additional_information }}</p>

                    <!-- Add Information Button -->
                    <div class="mt-6">
                        <a href="{{ route('missing_person.add_info', $person->id) }}"
                            class="bg-blue-600 text-white text-lg font-medium px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                            Add Information
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Pictures -->
        @if($person->additional_pictures)
        <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Additional Pictures</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(json_decode($person->additional_pictures) as $picture)
                <div class="bg-gray-50 p-2 rounded-lg shadow-sm">
                    <img src="{{ asset('storage/' . $picture) }}" alt="Additional Picture"
                        class="w-full h-40 object-cover rounded-md">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Submitted Information -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Submitted Information</h3>
            @if($missingPersonAdditionalReports->isEmpty())
            <p class="text-gray-600">No information submitted yet.</p>
            @else
            <div class="space-y-6">
                @foreach($missingPersonAdditionalReports as $info)
                <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                    <p class="text-gray-800"><strong class="font-medium">Location:</strong> {{ $info->location }}</p>
                    <p class="text-gray-800"><strong class="font-medium">Description:</strong> {{ $info->description }}
                    </p>
                    <p class="text-gray-600"><strong class="font-medium">Submitted At:</strong> {{ $info->created_at }}
                    </p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</body>
@endsection