@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-center mb-6">Pending Users</h1>

    <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Pending User Registrations</h2>
        @forelse($pendingUsers as $user)
        <div class="mb-4 p-4 border border-gray-200 rounded-lg flex items-center">
            <div class="flex-shrink-0 mr-4">
                @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}"
                    class="w-16 h-16 rounded-full object-cover">
                @else
                <img src="{{ asset('storage/uploads/default-profile.jpg') }}" alt="{{ $user->name }}"
                    class="w-16 h-16 rounded-full object-cover">
                @endif
            </div>
            <div class="flex-grow">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ route('admin.users.approve', $user->id) }}"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">Approve</a>
            </div>
        </div>
        @empty
        <p>No pending user registrations.</p>
        @endforelse
    </div>
</div>
@endsection