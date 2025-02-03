@extends('layouts.app')

@section('content')

<body class="bg-gray-100">


    <main class="pt-12 px-6">
        <!-- User Details Section -->
        <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">User Details</h2>
            <ul class="space-y-3 text-gray-800">
                <li><strong>Name:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                <p class="text-sm  text-gray-800">Created At:
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') }}
                    </p>
                    <p class="text-sm  text-gray-800">Last Login:
                        {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->format('d M Y, H:i') : 'N/A' }}
                    </p>
            </ul>
        </section>

        <!-- Missing Reports Section -->
        <section>
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Missing Reports</h3>
            @if($user->reports->isEmpty())
            <div class="bg-white shadow-lg rounded-lg p-6">
                <p class="text-gray-600">No missing reports found for this user.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($user->reports as $report)
                <div class="bg-white shadow-md rounded-lg p-4 hover:bg-blue-50 cursor-pointer transition">
                    <h4 class="text-lg font-semibold text-gray-800">Response ID: {{ $report->id }}</h4>
                    <p class="text-gray-600"><strong>Report ID:</strong> {{ $report->missing_person_id }}</p>
                    <p class="text-gray-600"><strong>Response:</strong> {{ Str::limit($report->description, 100) }}</p>
                    <p class="text-sm text-gray-500 mt-2"><strong>Response Date:</strong> {{ $report->created_at->format('d M Y, H:i') }}</p>

                    <a href="{{ route('show-location', ['id' => $report->id]) }}" class="text-blue-500 hover:underline mt-2 block">View Location</a>
                </div>
                @endforeach
            </div>
            @endif
        </section>
    </main>
</body>
@endsection