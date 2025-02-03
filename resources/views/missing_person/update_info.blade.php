<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
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
        <h1 class="text-2xl  text-center mb-6">Edit Information for <strong>{{ $person->fullname }}</strong> </h1>

        <form action="{{ route('response.update', $response->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="4" required>{{ $response->description }}</textarea>
            </div>

            <!-- Seen at date and time -->
            <div class="mb-4">
                <label for="seen_at" class="block text-sm font-medium text-gray-700">Seen at Date and Time</label>
                <input type="datetime-local" name="seen_at" id="seen_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ $response->seen_at }}" required>
            </div>

            <!-- Map Section -->
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Select Location</label>
                <div id="map" class="mt-2 rounded-md shadow-sm" style="height: 500px;"></div>
                <input type="hidden" name="latitude" id="latitude" value="{{ $response->latitude }}" />
                <input type="hidden" name="longitude" id="longitude" value="{{ $response->longitude }}" />
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md shadow-md transition">
                    Update
                </button>
            </div>
        </form>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([{{ $response->latitude ?? 51.505 }}, {{ $response->longitude ?? -0.09 }}], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Marker initialization
        let marker;
        if ({{true}}) {
            marker = L.marker([{{ $response->latitude ?? 51.505 }}, {{ $response->longitude ?? -0.09 }}]).addTo(map);
        }


    // Use Leaflet's locate method to get the user's current location
    map.locate({ setView: true, maxZoom: 16 });

        // Event fired when location is found
        map.on('locationfound', function (e) {
            const { lat, lng } = e.latlng;

            // Set the marker to the user's location
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            // Update hidden input fields
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });

    

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