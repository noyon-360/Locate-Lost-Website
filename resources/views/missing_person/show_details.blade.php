@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white">
        <div class="flex flex-col lg:grid lg:grid-cols-2 gap-6">
            <!-- Left Side -->
            <div>
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
                        <p><strong class="font-medium text-gray-900">Submited by:</strong> {{ $person->submitted_by }}</p>

                        <!-- Add Information Button -->
                        <div class="flex gap-2">
                            <div class="mt-6">
                                <a href="{{ route('missing_person.add_info', $person->id) }}"
                                    class="bg-blue-600 text-white text-lg font-medium px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                                    Add Information
                                </a>
                            </div>

                            @if(auth()->guard('station')->check() || auth()->guard('admin')->check())
                            <div class="mt-6">
                                <a href="{{ route('all-landmarks', $person->id)  }}"
                                    class="bg-blue-600 text-white text-lg font-medium px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                                    Locations
                                </a>
                            </div>
                            @endif
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
                <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center">
                    <div class="relative">
                        <img id="modalImage" src="" alt="Modal Image" class="max-w-full max-h-screen mx-auto">

                        <!-- Previous Button -->
                        <div class="absolute top-1/2 left-0 transform -translate-y-1/2">
                            <button class="text-white text-2xl px-4 py-2 bg-black bg-opacity-50 rounded-full" onclick="prevImage()">&#10094;</button>
                        </div>

                        <!-- Next Button -->
                        <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
                            <button class="text-white text-2xl px-4 py-2 bg-black bg-opacity-50 rounded-full" onclick="nextImage()">&#10095;</button>
                        </div>
                    </div>

                    <!-- Close Button -->
                    <button class="absolute top-4 right-4 text-white bg-red-600 px-3 py-1 rounded" onclick="closeModal()">X</button>
                </div>

            </div>

            <!-- Right Side -->
            <div>
                <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">

                    <form action="{{ route('comment.store', $person->id) }}" method="POST" class="mb-8">
                        @csrf
                        <div>
                            <textarea name="comment" rows="4" placeholder="Write your comment here..."
                                class="w-full border border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="bg-blue-600 text-white text-lg font-medium px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                                Submit Comment
                            </button>
                        </div>
                    </form>
                </div>

                @if(auth()->guard('web')->check())
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 mt-12">Comments</h2>
                <div class="space-y-6">
                    @foreach($person->comments as $comment)
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <p class="text-gray-800">
                                <strong class="font-medium text-gray-900">
                                    @if($comment->commentable_type === 'App\Models\User')
                                    {{ $comment->commentable->name }}
                                    @elseif($comment->commentable_type === 'App\Models\Stations')
                                    {{ $comment->commentable->station_name }}
                                    @endif
                                </strong>
                                <span class="text-sm text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                        <p class="text-gray-700">{{ $comment->content }}</p>
                    </div>
                    @endforeach
                </div>


                @else


                <!-- Tabs -->
                <div class="mt-12 bg-white p-8 rounded-lg shadow-lg">
                    <div x-data="{ activeTab: 0 }">
                        <!-- Tab navigation -->
                        <div class="flex space-x-4 border-b border-gray-200 mb-4">
                            <button class="w-1/2 py-2 text-center text-lg font-medium text-gray-600 hover:text-gray-900 focus:outline-none"
                                :class="{'border-b-2 border-blue-600': activeTab === 0}"
                                x-on:click="activeTab = 0">
                                <span>Information</span>
                            </button>
                            <button class="w-1/2 py-2 text-center text-lg font-medium text-gray-600 hover:text-gray-900 focus:outline-none"
                                :class="{'border-b-2 border-blue-600': activeTab === 1}"
                                x-on:click="activeTab = 1">
                                <span>Comments</span>
                            </button>
                        </div>

                        <!-- Tab content -->
                        <div class="space-y-6">
                            <div x-show="activeTab === 0">
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
                                                @if($info->user)
                                                <a href="{{ route('users.profile', $info->user->id) }}">
                                                    <img src="{{ asset('storage/' . $info->user->profile_picture) }}"
                                                        alt="{{ $info->user->name }}"
                                                        class="w-12 h-12 rounded-full border border-gray-300 hover:border-blue-500 transition-all">
                                                </a>
                                                @elseif($info->station)
                                                <a href="{{ route('station-profile', $info->station->id) }}">
                                                    <img src="{{ asset('storage/' . $info->station->station_picture) }}"
                                                        alt="{{ $info->station->station_name }}"
                                                        class="w-12 h-12 rounded-full border border-gray-300 hover:border-blue-500 transition-all">
                                                </a>
                                                @endif
                                            </div>
                                            <div>
                                                @if($info->user)
                                                <p class="text-gray-800">
                                                    <strong class="font-medium text-gray-900">Submitted By:</strong>
                                                    <a href="{{ route('users.profile', $info->user->id) }}"
                                                        class="text-blue-600 hover:underline">
                                                        {{ $info->user->name }}
                                                    </a>
                                                </p>
                                                <p class="text-gray-600 text-sm">Email: {{ $info->user->email }}</p>
                                                @elseif($info->station)
                                                <p class="text-gray-800">
                                                    <strong class="font-medium text-gray-900">Submitted By:</strong>
                                                    <a href="{{ route('station-profile', $info->station->id) }}"
                                                        class="text-blue-600 hover:underline">
                                                        {{ $info->station->station_name }}
                                                    </a>
                                                </p>
                                                <p class="text-gray-600 text-sm">Email: {{ $info->station->email }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <div x-show="activeTab === 1">
                                <div class="space-y-6">
                                    @foreach($person->comments as $comment)
                                    <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 ease-in-out">
                                        <div class="flex items-start space-x-4">
                                            <!-- Profile Picture with Link -->
                                            @php
                                            $imagePath = $comment->commentable_type === 'App\Models\User'
                                            ? ($comment->commentable->profile_picture ? 'storage/' . $comment->commentable->profile_picture : 'images/default-user.png')
                                            : ($comment->commentable->station_picture ? 'storage/' . $comment->commentable->station_picture : 'images/default-station.png');

                                            // Determine the profile URL based on the commentable type
                                            $profileUrl = $comment->commentable_type === 'App\Models\User'
                                            ? route('users.profile', $comment->commentable->id) // Replace 'user.profile' with your actual route name
                                            : route('station-profile', $comment->commentable->id); // Replace 'station.profile' with your actual route name
                                            @endphp

                                            <a href="{{ $profileUrl }}">
                                                <img src="{{ asset($imagePath) }}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-blue-500 transition-all duration-300 cursor-pointer">
                                            </a>

                                            <!-- Comment Details -->
                                            <div class="flex-1">
                                                <!-- Commenter Name and Email -->
                                                <div class="flex flex-col">
                                                    <strong class="font-semibold text-gray-900">
                                                        @if($comment->commentable_type === 'App\Models\User')
                                                        {{ $comment->commentable->name }}
                                                        @elseif($comment->commentable_type === 'App\Models\Stations')
                                                        {{ $comment->commentable->station_name }}
                                                        @endif
                                                    </strong>
                                                    <span class="text-sm text-gray-500">{{ $comment->commentable->email }}</span>
                                                </div>

                                                <!-- Comment Content -->
                                                <p class="mt-3 text-gray-700 leading-relaxed">{{ $comment->content }}</p>

                                                <!-- Timestamp -->
                                                <span class="text-sm text-gray-500 mt-2">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
            </div>

        </div>
        <!-- Note : update the comment users profiles pictures and link to show there profile -->
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