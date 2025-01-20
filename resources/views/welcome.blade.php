@extends('layouts.app')

@section('content')
<main class="container mx-auto mt-8 p-4">
    <section class="text-center">
        <h2 class="text-3xl font-bold mb-4">Welcome to Missing Person Finder</h2>
        <p class="mb-8">
            Our mission is to help locate missing persons by providing a platform where verified users can report
            missing individuals and the community can share sightings and updates.
        </p>
        <img alt="A group of people holding hands in a circle, symbolizing community support and unity"
            class="mx-auto mb-8 rounded shadow-lg"
            src="https://storage.googleapis.com/a1aa/image/bkbRtXWODe1QVCex0zXAzitBNL7TDFmdSkYqezT8TWGfGwDQB.jpg"
            width="600" height="400" />
        <a class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" href="{{ route('missing-reports') }}">Get Started</a>
    </section>

    <section class="mt-16">
        <h3 class="text-2xl font-bold mb-4">How It Works</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded shadow">
                <img alt="Icon representing a user adding a report" class="mx-auto mb-4"
                    src="https://storage.googleapis.com/a1aa/image/oXevofdHXfWnBpWFpyq4YI8G1JbCBnJSYFX9uwgrkn8kD4BoA.jpg"
                    width="100" height="100" />
                <h4 class="text-xl font-bold mb-2">Report Missing</h4>
                <p>Verified users can add detailed reports of missing persons, including photos, descriptions, and
                    last known locations.</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <img alt="Icon representing a map with a location pin" class="mx-auto mb-4"
                    src="https://storage.googleapis.com/a1aa/image/adxyO1yB3KLgARF1iQfxUufC2KDIAplWoQVBWc5S1YV0B8AUA.jpg"
                    width="100" height="100" />
                <h4 class="text-xl font-bold mb-2">Share Sightings</h4>
                <p>If you have seen a missing person, you can share the location and any other relevant details to
                    help update their last known whereabouts.</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <img alt="Icon representing a community of people" class="mx-auto mb-4"
                    src="https://storage.googleapis.com/a1aa/image/eGdxdH2gIfqVTUmHd5nYGNEjs5fVBvp7FkK1Vq65tx9jD4BoA.jpg"
                    width="100" height="100" />
                <h4 class="text-xl font-bold mb-2">Community Support</h4>
                <p>Our platform relies on the community to provide support and share information to help locate
                    missing persons.</p>
            </div>
        </div>
    </section>

    <section class="mt-16 bg-gray-200 p-6 rounded shadow">
        <h3 class="text-2xl font-bold mb-4">Why Choose Us?</h3>
        <p class="mb-4">We understand the emotional toll and urgency of locating missing loved ones. Our platform
            offers:</p>
        <ul class="list-disc pl-6 space-y-2">
            <li>Secure and verified user reporting to prevent false information.</li>
            <li>A centralized database to track and update missing persons' last known locations.</li>
            <li>Real-time community support to share sightings and updates effectively.</li>
        </ul>
    </section>
</main>
@endsection

