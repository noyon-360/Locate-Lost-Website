@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div id="map" style="height: 500px;"></div>
</div>


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pass the PHP array to JavaScript
        const locations = @json($info);

        // Initialize the map with the first location as the center
        const map = L.map('map').setView([locations[0].latitude, locations[0].longitude], 8);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add markers for each location
        locations.forEach(location => {
            let submittedBy = location.role === 'user' 
                ? location.user?.name || 'Unknown User' 
                : location.station?.station_name || 'Unknown Station';

            let popupContent = `
                <div style="text-align: center;">
                    <img 
                        src="${location.missing_person.front_image ? '{{ asset('storage') }}/' + location.missing_person.front_image : '{{ asset('images/placeholder.png') }}'}" 
                        alt="Missing Person" 
                        style="width: 30px; height: auto; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);" 
                    />
                    <p><strong>${location.missing_person.fullname}</strong></p>
                    <p><strong>Submitted By:</strong> ${submittedBy}</p>
                </div>
            `;

            // Add marker
            L.marker([location.latitude, location.longitude]).addTo(map)
                .bindPopup(popupContent);
        });
    });
</script>


@endsection