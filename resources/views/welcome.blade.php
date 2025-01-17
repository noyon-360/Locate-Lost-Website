<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    @vite('resources/css/app.css')
</head>

@include('layouts.app')

<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-center mb-6">Missing Persons Reports</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($missingPersons as $person)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="{{ asset('storage/' . $person->front_image) }}" alt="Front Image"
                    class="w-full h-80 object-cover rounded-md mb-4">

                <h2 class="text-xl font-bold">{{ $person->fullname }}</h2>
                <p><strong>Date of Birth:</strong> {{ $person->date_of_birth }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($person->gender) }}</p>
                <p><strong>Last Seen:</strong> {{ $person->last_seen_location_description }}</p>
                <p><strong>Missing Date:</strong> {{ $person->missing_date }}</p>

                <a href="{{ route('person.details', ['id' => $person->id]) }}"
                    class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded">View Details</a>
            </div>
            @empty
            <p class="text-center col-span-full">No missing person reports found.</p>
            @endforelse
        </div>
    </div>

</body>

</html>