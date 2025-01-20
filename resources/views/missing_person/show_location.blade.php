@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Location Details</h2>
    <p><strong>Missing Person:</strong> {{ $info->missingPerson->fullname }}</p>
    <p><strong>Submitted By:</strong> {{ $info->user->name }}</p>
    <div id="map" style="height: 500px;"></div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the map
        const map = L.map('map').setView([{{ $info->latitude }}, {{ $info->longitude }}], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add marker
        L.marker([{{ $info->latitude }}, {{ $info->longitude }}]).addTo(map)
            .bindPopup('Location of the missing person')
            .openPopup();
    });
</script>
@endsection