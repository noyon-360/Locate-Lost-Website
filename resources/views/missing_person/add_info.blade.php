<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($response) ? 'Edit Information' : 'Add Information' }}</title>
    @vite('resources/css/app.css')

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            /* Set the map height */
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-center mb-6">{{ isset($response) ? 'Edit Information' : 'Add Information' }} for {{ $person->fullname }}</h1>

        <form action="{{ isset($response) ? route('response.update', $response->id) : route('missing_person.store_info', $person->id) }}" method="POST">
            @csrf
            @if(isset($response))
                @method('PUT')
            @endif
            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="4" required>{{ isset($response) ? $response->description : '' }}</textarea>
            </div>

            <!-- Map Section -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Select Location</label>
                <div id="map" class="mt-2 rounded-md shadow-sm" style="height: 300px;"></div>
                <input type="hidden" name="latitude" id="latitude" value="{{ isset($response) ? $response->latitude : '' }}" />
                <input type="hidden" name="longitude" id="longitude" value="{{ isset($response) ? $response->longitude : '' }}" />
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md shadow-md transition">
                    {{ isset($response) ? 'Update' : 'Submit' }}
                </button>
            </div>
        </form>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([{{ isset($response) ? $response->latitude : 51.505 }}, {{ isset($response) ? $response->longitude : -0.09 }}], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Marker initialization
        let marker;
        if ({{ isset($response) ? 'true' : 'false' }}) {
            marker = L.marker([{{ $response->latitude }}, {{ $response->longitude }}]).addTo(map);
        }

        // Event listener for map clicks
        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;

            // Update hidden input fields
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Add or update marker
            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });
    </script>
</body>

</html>