@extends('layouts.app')

@section('content')

<body class="bg-gray-50">
    <!-- Main Content -->
    <main class="pt-20 p-6">
        <!-- User Details Section -->
        <section class="max-w mx-auto rounded-lg mb-8">
            <div class="gap-6">
                <div class="flex flex-col items-start py-2 space-y-4">
                    <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : 'https://placehold.co/128x128?text=Profile+Picture' }}"
                        alt="Profile picture of {{ $user->name }}"
                        class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                </div>

                <div>
                    <p class="text-lg font-semibold text-gray-800"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="font-semibold text-gray-800"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="text-sm  text-gray-800">Created At:
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') }}
                    </p>
                    <p class="text-sm  text-gray-800">Last Login:
                        {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, H:i') : 'N/A' }}
                    </p>
                </div>
            </div>
        </section>

        <!-- Missing Reports Section -->
        <section>
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Missing Reports</h3>
            @if($user->missingReports->isEmpty())
            <div class="bg-white shadow rounded p-4">
                <p class="text-gray-600">No reports found.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($user->missingReports as $report)
                <a href="{{ route('person.details', ['id' => $report->id]) }}"
                    class="block bg-white shadow-md rounded-lg p-4 hover:bg-blue-50 cursor-pointer transition">
                    <div class="flex items-center space-x-4 mb-4">
                        <!-- Front Image as Profile Picture -->
                        <img src="{{ $report->front_image ? asset('storage/' . $report->front_image) : 'https://placehold.co/128x128?text=Missing+Person' }}"
                            alt="Profile picture of {{ $report->fullname }}"
                            class="w-16 h-16 object-cover rounded-full shadow-md">
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">{{ $report->fullname }}</h4>

                            <p class="text-sm text-gray-500">Last Seen: {{ \Illuminate\Support\Str::limit($report->last_seen_location_description, 30) }}</p>

                            <p class="text-gray-500 text-sm mt-2">Reported on:
                                {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>

                    <p class="text-gray-500 text-sm mt-2">Father 's Name: {{ $report->father_name }}</p>
                    <p class="text-gray-500 text-sm mt-2">Mother 's Name: {{ $report->mother_name }}</p>
                    <p class="text-gray-500 text-sm mt-2">Date of Birth: {{ \Carbon\Carbon::parse($report->date_of_birth)->format('d M Y') }}</p>
                    <!-- missing daate -->
                    <p class="text-gray-500 text-sm mt-2">Missing Date: {{ \Carbon\Carbon::parse($report->missing_date)->format('d M Y') }}</p>
                    <!-- status -->
                    <p class="text-gray-500 text-sm mt-2">Status: {{ $report->status }}</p>

                    <!-- Additional Pictures Section -->
                    <div class="mt-10 grid grid-cols-3 gap-2 self-end">
                        @foreach(json_decode($report->additional_pictures) as $picture)
                        <img src="{{ asset('storage/' . $picture) }}"
                            alt="Additional picture of {{ $report->fullname }}"
                            class="w-full h-20 object-cover rounded-md">
                        @endforeach
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </section>
    </main>

    <style>
        .truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</body>

@endsection