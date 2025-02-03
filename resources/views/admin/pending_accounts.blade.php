@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6 text-gray-800">Pending Accounts</h1>

    <!-- Tabs -->
    <div class="mb-6">
        <ul class="flex border-b border-gray-300">
            <li class="mr-4">
                <a href="#users" class="text-xl text-blue-500 py-3 px-4 cursor-pointer transition-all hover:text-blue-700 hover:bg-blue-50 rounded-t-lg flex items-center" id="users-tab">
                    <i class="fas fa-users mr-2"></i> Users <span class="font-light">({{ $total_pending_users }})</span>
                </a>
            </li>
            <li class="mr-4">
                <a href="#stations" class="text-xl text-blue-500 py-3 px-4 cursor-pointer transition-all hover:text-blue-700 hover:bg-blue-50 rounded-t-lg flex items-center" id="stations-tab">
                    <i class="fas fa-building mr-2"></i> Stations <span class="font-light">({{ $total_pending_stations }})</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div id="users" class="tab-content">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Pending User Registrations</h2>
            @forelse($pendingUsers as $user)
            <div class="mb-4 p-4 border border-gray-200 rounded-lg hover:shadow-md transition">
                <div class="flex items-center">
                    <!-- Profile Picture -->
                    <div class="mr-4">
                        @if($user->profile_picture)
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover">
                        @else
                        <img src="{{ asset('storage/uploads/default-profile.jpg') }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover">
                        @endif
                    </div>

                    <!-- User Details -->
                    <div class="flex-grow">
                        <p class="text-lg text-gray-700"><strong>Name:</strong> {{ $user->name }}</p>
                        <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="text-sm text-gray-600"><strong>Phone:</strong> {{ $user->phone_number }}</p>
                        <p class="text-sm text-gray-600"><strong>Station Name:</strong> {{ $user->station_name }}</p>
                        <p class="text-sm text-gray-600"><strong>Created At:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y h:i A') }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.user.approve', $user->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg transition-all hover:bg-blue-600">
                            <i class="fas fa-check-circle"></i> Approve
                        </a>
                        <span class="mx-2"></span>
                        <a href="{{ route('admin.user.reject', $user->id) }}" class="bg-red-500 text-white py-2 px-4 rounded-lg transition-all hover:bg-red-600">
                            <i class="fas fa-times-circle"></i> Reject
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500">No pending user registrations.</p>
            @endforelse
        </div>
    </div>

    <div id="stations" class="tab-content hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Pending Stations</h2>
            @forelse($pendingStations as $station)
            <div class="mb-4 p-4 border border-gray-200 rounded-lg hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="mr-4">
                        @if($station->station_picture)
                        <img src="{{ asset('storage/' . $station->station_picture) }}" alt="{{ $station->station_name }}" class="w-16 h-16 rounded-full object-cover">
                        @else
                        <img src="{{ asset('storage/uploads/default-profile.jpg') }}" alt="{{ $station->station_name }}" class="w-16 h-16 rounded-full object-cover">
                        @endif
                    </div>
                    <div class="flex-grow">
                        <p class="text-lg text-gray-700"><strong>Station Name:</strong> {{ $station->station_name }}</p>
                        <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $station->email }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.station.approve', $station->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg transition-all hover:bg-blue-600">
                            <i class="fas fa-check-circle"></i> Approve
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500">No pending stations.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    const userTab = document.getElementById('users-tab');
    const stationTab = document.getElementById('stations-tab');
    const userContent = document.getElementById('users');
    const stationContent = document.getElementById('stations');

    userTab.addEventListener('click', () => {
        userContent.classList.remove('hidden');
        stationContent.classList.add('hidden');
        userTab.classList.add('text-blue-700', 'border-b-2', 'border-blue-500', 'bg-blue-50');
        stationTab.classList.remove('text-blue-700', 'border-b-2', 'border-blue-500', 'bg-blue-50');
    });

    stationTab.addEventListener('click', () => {
        stationContent.classList.remove('hidden');
        userContent.classList.add('hidden');
        stationTab.classList.add('text-blue-700', 'border-b-2', 'border-blue-500', 'bg-blue-50');
        userTab.classList.remove('text-blue-700', 'border-b-2', 'border-blue-500', 'bg-blue-50');
    });

    // Initialize the first tab as active
    userTab.click();
</script>

@endsection