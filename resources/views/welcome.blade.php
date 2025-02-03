<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-blue-900 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">Reuniting Loved Ones Through Community</h1>
        <p class="text-xl mb-8">Help locate missing persons by reporting sightings and contributing information</p>
        <div class="flex justify-center space-x-4">
            @guest
            <a href="{{ route('register') }}" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors">Get Started</a>
            <a href="{{ route('login-view') }}" class="border border-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-900 transition-colors">Login</a>
            @else
            <a href="{{ route('user.dashboard') }}" class="bg-white text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-blue-50 transition-colors">Go to Dashboard</a>
            @endguest
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-3">Report Sightings</h3>
                <p class="text-gray-600">Share location details and descriptions of missing persons you've encountered</p>
            </div>

            <!-- Add two more feature cards similarly -->
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div class="p-6">
                <div class="text-4xl font-bold text-blue-900 mb-2">1,234+</div>
                <div class="text-gray-600">Successful Reunions</div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-blue-900 mb-2">5,678+</div>
                <div class="text-gray-600">Active Volunteers</div>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold text-blue-900 mb-2">89%</div>
                <div class="text-gray-600">Success Rate</div>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action Section -->
<div class="bg-blue-50 py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Join Our Community Effort</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Your contribution could be the key to reuniting a family. Every piece of information matters.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('missing-reports') }}" class="bg-blue-900 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-800 transition-colors">View Active Cases</a>
            <a href="{{ route('station.dashboard') }}" class="border border-blue-900 text-blue-900 px-8 py-3 rounded-full font-semibold hover:bg-blue-100 transition-colors">For Stations</a>
        </div>
    </div>
</div>

<!-- Recent Cases Section -->
<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Recently Reported Cases</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($recentCases as $case)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $case->front_image) }}" alt="Missing person" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $case->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Last seen: {{ $case->last_seen_location_description }}
                    </p>
                    <a href="{{ route('person.details', $case->id) }}" class="text-blue-600 hover:underline">View Details →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Locate Lost</h3>
                <p class="text-gray-400">Connecting communities to bring loved ones home</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('missing-reports') }}" class="text-gray-300 hover:text-white">Active Cases</a></li>
                    <li><a href="{{ route('station.register-view') }}" class="text-gray-300 hover:text-white">Station Registration</a></li>
                </ul>
            </div>
            <!-- Add more footer columns -->
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2023 Locate Lost. All rights reserved.</p>
        </div>
    </div>
</footer>
@endsection