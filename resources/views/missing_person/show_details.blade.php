@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Picture -->
            <div class="lg:col-span-1">
                <img src="{{ asset('storage/' . $person->front_image) }}" alt="Profile picture of {{ $person->fullname }}"
                    class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            <!-- Details -->
            <div class="lg:col-span-2 space-y-6 text-gray-700">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Personal Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <p><strong class="font-medium text-gray-900">Full Name:</strong> {{ $person->fullname }}</p>
                    <p><strong class="font-medium text-gray-900">Date of Birth:</strong> {{ $person->date_of_birth }}</p>
                    <p><strong class="font-medium text-gray-900">Gender:</strong> {{ ucfirst($person->gender) }}</p>
                    <p><strong class="font-medium text-gray-900">Permanent Address:</strong> {{ $person->permanent_address }}</p>
                    <p><strong class="font-medium text-gray-900">Last Seen:</strong> {{ $person->last_seen_location_description }}</p>
                    <p><strong class="font-medium text-gray-900">Father's Name:</strong> {{ $person->father_name }}</p>
                    <p><strong class="font-medium text-gray-900">Mother's Name:</strong> {{ $person->mother_name }}</p>
                    <p><strong class="font-medium text-gray-900">Contact:</strong> {{ $person->contact_number }}</p>
                    <p><strong class="font-medium text-gray-900">Email:</strong> {{ $person->email }}</p>
                    <p><strong class="font-medium text-gray-900">Missing Date:</strong> {{ $person->missing_date }}</p>
                </div>
                <p><strong class="font-medium text-gray-900">Additional Info:</strong> {{ $person->additional_information }}</p>

                <!-- Add Information Button -->
                <div class="mt-6">
                    <a href="{{ route('missing_person.add_info', $person->id) }}"
                        class="bg-blue-600 text-white text-lg font-medium px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                        Add Information
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Pictures -->
        @if($person->additional_pictures)
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Additional Pictures</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach(json_decode($person->additional_pictures) as $index => $picture)
                <img src="{{ asset('storage/' . $picture) }}" alt="Additional picture of {{ $person->fullname }}"
                    class="w-full h-32 object-cover rounded-md cursor-pointer" onclick="openModal({{ $index }})">
                @endforeach
            </div>
        </div>
        @endif

        <!-- Modal -->
        <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 items-center justify-center">
            <div class="relative">

                <img id="modalImage" src="" alt="Modal Image" class="max-w-full max-h-full">
                <div class="absolute top-1/2 left-0 transform -translate-y-1/2">
                    <button class="text-white text-2xl" onclick="prevImage()">&#10094;</button>
                </div>
                <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
                    <button class="text-white text-2xl" onclick="nextImage()">&#10095;</button>
                </div>
            </div>

            <button class="absolute top-0 right-0 mt-2 mr-2 text-white bg-red-600 px-2 py-1 rounded" onclick="closeModal()">X</button>
        </div>

        <!-- Submitted Information -->
        <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-semibold text-gray-800 mb-6">Submitted Information</h3>
            @if($missingPersonAdditionalReports->isEmpty())
            <p class="text-gray-600">No information submitted yet.</p>
            @else
            <div class="space-y-6">
                @foreach($missingPersonAdditionalReports as $info)
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-gray-800">
                            <strong class="font-medium text-gray-900">Location:</strong>
                            <a href="{{ route('show-location', $info->id) }}" class="text-blue-600 hover:underline">
                                View on Map
                            </a>
                        </p>
                        <span class="text-sm text-gray-500">{{ $info->created_at->diffForHumans() }}</span>
                    </div>

                    <p class="text-gray-800 mb-4">
                        <strong class="font-medium text-gray-900">Description:</strong> {{ $info->description }}
                    </p>

                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <!-- User Avatar -->
                            <a href="{{ route('common-profile', $info->user->id) }}">
                                <img src="{{ asset('storage/' . $info->user->profile_picture) }}"
                                    alt="{{ $info->user->name }}"
                                    class="w-12 h-12 rounded-full border border-gray-300 hover:border-blue-500 transition-all">
                            </a>
                        </div>
                        <div>
                            <p class="text-gray-800">
                                <strong class="font-medium text-gray-900">Submitted By:</strong>
                                <a href="{{ route('common-profile', $info->user->id) }}"
                                    class="text-blue-600 hover:underline">
                                    {{ $info->user->name }}
                                </a>
                            </p>
                            <p class="text-gray-600 text-sm">Email: {{ $info->user->email }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    let currentIndex = 0;
    const pictures = @json(json_decode($person -> additional_pictures));

    function openModal(index) {
        currentIndex = index;
        document.getElementById('modalImage').src = `/storage/${pictures[currentIndex]}`;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    function prevImage() {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : pictures.length - 1;
        document.getElementById('modalImage').src = `/storage/${pictures[currentIndex]}`;
    }

    function nextImage() {
        currentIndex = (currentIndex < pictures.length - 1) ? currentIndex + 1 : 0;
        document.getElementById('modalImage').src = `/storage/${pictures[currentIndex]}`;
    }
</script>
@endsection