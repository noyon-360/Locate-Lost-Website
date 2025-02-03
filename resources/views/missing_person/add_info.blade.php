<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Information</title>
    @vite('resources/css/app.css')

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-center mb-6">Add Information for {{ $person->fullname }}</h1>

        <form action="{{ route('missing_person.store_info', $person->id) }}" method="POST">
            @csrf

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="4" required>{{ old('description', $response->description ?? '') }}</textarea>
            </div>

            <!-- Seen at Date and Time -->
            <div class="mb-4">
                <label for="seen_at" class="block text-sm font-medium text-gray-700">Seen at Date and Time</label>
                <input type="datetime-local" name="seen_at" id="seen_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('seen_at', $response->seen_at ?? '') }}" required>
            </div>

            <!-- Map Section -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Select Location</label>
                <div id="map" class="mt-2 rounded-md shadow-sm"></div>
                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $response->latitude ?? '') }}" />
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $response->longitude ?? '') }}" />
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md shadow-md transition">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Safely pass server-side variables to JavaScript
        const defaultCoords = @json([$response->latitude ?? 51.505, $response->longitude ?? -0.09]);
        const hasResponseCoords = @json(!empty($response->latitude) && !empty($response->longitude));

        // Initialize the map
        const map = L.map('map').setView(defaultCoords, 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Initialize Marker
        let marker;
        if (hasResponseCoords) {
            marker = L.marker(defaultCoords).addTo(map);
        }

        // Map click event
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;

            // Update hidden inputs
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Add or move marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });

        // Locate the user
        map.locate({ setView: true, maxZoom: 16 });

        map.on('locationfound', function (e) {
            const { lat, lng } = e.latlng;

            // Set marker at location if not already set
            if (!marker) {
                marker = L.marker([lat, lng]).addTo(map);
            }
        });

        map.on('locationerror', function () {
            console.error('Location access denied or unavailable');
            alert('Unable to access your location. Please enable location services or select a point on the map.');
        });
    </script>
</body>

</html>
