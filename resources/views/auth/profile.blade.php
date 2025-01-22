<!-- @extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">User Profile</h1>

    <div class="bg-white shadow rounded p-6 mb-6">
        <h2 class="text-xl font-semibold">Your Information</h2>
        <ul class="mt-4">
            <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
            <li><strong>Profile Picture:</strong></li>
            <li>
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://placehold.co/100x100?text=Profile' }}" alt="Profile Picture" class="w-24 h-24 rounded-full">
            </li>
        </ul>
    </div>

    <div class="bg-white shadow rounded p-6 mb-6">
        <h2 class="text-xl font-semibold">Update Your Information</h2>
        <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-semibold">Delete Your Account</h2>
        <form action="{{ route('user.profile.delete', Auth::user()->id) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <p class="text-red-600">Warning: This action cannot be undone.</p>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Account</button>
        </form>
    </div>
</div>
@endsection -->