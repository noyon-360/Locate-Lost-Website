<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Station Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</head>

<body class="bg-gray-100 font-sans">
    <div x-data="{ drawerOpen: window.innerWidth >= 768, currentPage: localStorage.getItem('currentPage') || 'home' }" class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 bg-blue-600 text-white z-40 transform transition-all duration-300 ease-in-out"
            :class="{'w-72': drawerOpen, 'w-16': !drawerOpen}" x-cloak>
            <div class="p-6 flex items-center justify-between" x-show="drawerOpen" x-transition>
                <h1 class="text-2xl font-bold">Station Dashboard</h1>

            </div>
            <nav class="mt-2">
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('welcome') }}" class="flex items-center p-3 hover:bg-blue-700 rounded transition">
                            <i class="fas fa-home"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('missing-reports') }}" class="flex items-center p-3 hover:bg-blue-700 rounded transition">
                            <i class="fas fa-file-alt"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Missing Reports</span>
                        </a>
                    </li>

                    <!-- Divider Line -->
                    <li>
                        <hr class="border-t border-gray-300 my-2">
                    </li>

                    <li>
                        <a href="javascript:void(0)" @click="currentPage = 'home'; localStorage.setItem('currentPage', 'home')" class="flex items-center p-3 hover:bg-blue-700 rounded transition"
                            :class="{'bg-blue-700': currentPage === 'home'}">
                            <i class="fas fa-dashboard"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0)" @click="currentPage = 'profile'; localStorage.setItem('currentPage', 'profile')" class="flex items-center p-3 hover:bg-blue-700 rounded transition"
                            :class="{'bg-blue-700': currentPage === 'profile'}">
                            <i class="fas fa-user"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" @click="currentPage = 'Responses'; localStorage.setItem('currentPage', 'Responses')" class="flex items-center p-3 hover:bg-blue-700 rounded transition"
                            :class="{'bg-blue-700': currentPage === 'Responses'}">
                            <i class="fas fa-book"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Responses</span>
                        </a>
                    </li>
                    <!-- User Accounts list -->
                    <li>
                        <a href="javascript:void(0)" @click="currentPage = 'Accounts'; localStorage.setItem('currentPage', 'Accounts')" class="flex items-center p-3 hover:bg-blue-700 rounded transition"
                            :class="{'bg-blue-700': currentPage === 'Accounts'}">
                            <i class=" fas fa-users"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>User Accounts</span>
                        </a>
                    </li>

                    <!-- Divider Line -->
                    <li>
                        <hr class="border-t border-gray-300 my-2">
                    </li>

                    <li>
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center p-3 w-full text-left hover:bg-blue-700 rounded transition">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="ml-3" x-show="drawerOpen" x-transition>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out" :class="{'ml-72': drawerOpen, 'ml-16': !drawerOpen}">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex items-center justify-between sticky top-0 z-50">
                <div class="flex items-center">
                    <button class="text-gray-600 hover:text-gray-800 focus:outline-none" @click="drawerOpen = !drawerOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                    <span class="ml-4 text-lg font-bold text-gray-800">Welcome, Station Dashboard</span>
                </div>

                <div class="flex items-center">
                    <strong>
                        {{ Auth::guard('station')->user()->station_name }}
                    </strong>
                    <div class="ml-4">
                        @include('layouts.station_profile_dropdown')
                    </div>
                </div>

                <!-- // Note :: Add the missing data, it make some problems -->

            </header>

            <!-- Home Tab -->
            <template x-if="currentPage === 'home'">
                <!-- Content -->
                <div class="flex-1 p-10" id="main-content">
                    <!-- User Details -->
                    <section class="mb-8">
                        <h3 class="text-xl font-bold text-gray-700">Your Details</h3>
                        <ul class="mt-4 bg-white shadow rounded p-4 space-y-2">
                            <li><strong>Name:</strong> {{ Auth::guard('station')->user()->station_name }}</li>
                            <li><strong>Email:</strong> {{ Auth::guard('station')->user()->email }}</li>
                        </ul>
                    </section>

                    <!-- Your Missing Reports -->
                    <section>
                        <h3 class="text-xl font-bold text-gray-700 mb-4">Your Missing Reports : {{ $missing->count() ?? "" }}</h3>
                        @if($missing->isEmpty())
                        <div class="bg-white shadow rounded p-4">
                            <p class="text-gray-600">You have no missing reports.</p>
                        </div>
                        @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($missing as $report)
                            <div class="bg-white shadow rounded p-4">

                                <a href="{{ route('person.details', ['id' => $report->id]) }}" class="block relative rounded-lg p-1 hover:bg-blue-50 cursor-pointer transition">
                                    <!-- Delete Icon Button -->

                                    <div class="absolute top-2 right-2">

                                        <form action="{{ route('report.delete', ['id' => $report->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-500 text-lg bg-slate-100 px-2 py-1 rounded hover:text-red-700" type="submit">
                                                <i class="fas fa-trash-alt">
                                                </i>
                                            </button>

                                    </div>
                                    <!-- Complete (Edit) Button -->

                                    <div class="flex items-center space-x-4 mb-4">
                                        <img src="{{ $report->front_image ? asset('storage/' . $report->front_image) : 'https://placehold.co/128x128?text=Missing+Person' }}"
                                            alt="Profile picture of {{ $report->fullname }}"
                                            class="w-16 h-16 object-cover rounded-full shadow-md">
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $report->fullname }}</h4>
                                            <p class="text-gray-500 text-sm">Reported on: {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Report ID:</strong> {{ $report->id }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Date of Birth:</strong> {{ $report->date_of_birth }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Gender:</strong> {{ $report->gender }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Permanent Address:</strong> {{ $report->permanent_address }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Last Seen Location:</strong> {{ $report->last_seen_location_description }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Father's Name:</strong> {{ $report->father_name }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Mother's Name:</strong> {{ $report->mother_name }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Contact Number:</strong> {{ $report->contact_number }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Email:</strong> {{ $report->email }}</p>
                                        <p class="text-gray-500 text-sm mt-2 truncate"><strong>Date Reported:</strong> {{ $report->created_at->format('d M Y') }}</p>
                                    </div>

                                    <!-- button for the all-landmarks -->
                                    @if($report->reports_count > 0)
                                    <button class="mt-2 ml-1">
                                        <a href="{{ route('all-landmarks', $report->id) }}" class="text-blue-500 hover:underline inline-block">
                                            View Locations
                                        </a>
                                    </button>



                                    @else
                                    <p class="mt-4 text-gray-500 text-sm">No locations reported yet.</p>
                                    @endif

                                    <!-- Additional Pictures Section -->
                                    <div class="flex-grow mt-6 grid grid-cols-3 gap-2">
                                        @if($report->additional_pictures)
                                        @foreach(json_decode($report->additional_pictures) as $picture)
                                        <img src="{{ asset('storage/' . $picture) }}"
                                            alt="Additional picture of {{ $report->fullname }}"
                                            class="w-full h-20 object-cover rounded-md border border-gray-200">
                                        @endforeach
                                        @else
                                        <p class="text-gray-500 text-sm">No additional pictures available.</p>
                                        @endif
                                    </div>
                                </a>

                                <!-- Action Buttons -->
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <a href="{{ route('edit-missing-person', ['id' => $report->id]) }}">
                                        <div class="bg-blue-500 text-white px-4 py-2 rounded text-center shadow hover:bg-blue-600">
                                            Edit
                                        </div>
                                    </a>

                                    <div class="bg-green-500 text-white px-4 py-2 rounded text-center shadow hover:bg-green-600 cursor-pointer">
                                        <button onclick="document.getElementById('showCompletionDetails').showModal()" class="w-full h-full text-white">
                                            Completion
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </section>



                </div>
            </template>


            <!-- Profile Tab -->
            <template x-if="currentPage === 'profile'">
                <div class="container p-10">
                    <div class="bg-white shadow rounded p-6 mb-6">
                        <h2 class="text-xl font-semibold">Your Information</h2>
                        <ul class="mt-4">
                            <li><strong>Name:</strong> {{ Auth::guard('station')->user()->station_name }}</li>
                            <li><strong>Email:</strong> {{ Auth::guard('station')->user()->email }}</li>
                            <li><strong>Profile Picture:</strong></li>
                            <li>
                                <img src="{{ Auth::guard('station')->user()->station_picture ? asset('storage/' . Auth::guard('station')->user()->station_picture) : 'https://placehold.co/100x100?text=Profile' }}" alt="Profile Picture" class="w-24 h-24 rounded-full">
                            </li>
                        </ul>
                    </div>

                    <!-- Update User Info -->
                    <div class="bg-white shadow rounded p-6 mb-6">
                        <h2 class="text-xl font-semibold">Update Your Information</h2>
                        <form action="{{ route('station.profile.update', Auth::guard('station')->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ Auth::guard('station')->user()->station_name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ Auth::guard('station')->user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="station_picture" class="block text-gray-700">Profile Picture</label>
                                <input type="file" name="station_picture" id="station_picture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                        </form>
                    </div>

                    <div class="bg-white shadow rounded p-6">
                        <h2 class="text-xl font-semibold">Delete Your Account</h2>
                        <form action="{{ route('station.profile.delete', Auth::guard('station')->user()->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <p class="text-red-600">Warning: This action cannot be undone.</p>
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete Account</button>
                        </form>
                    </div>
                </div>
            </template>


            <!-- Responses Tab -->
            <template x-if="currentPage === 'Responses'">
                <div class="container p-10">
                    <h2 class="text-2xl font-bold mb-4">Responses</h2>
                    <p class="mb-6">Access your Responses here.</p>
                    <!-- Show the submitted info -->
                    <div class="bg-white shadow rounded p-6">
                        <h2 class="text-xl font-semibold mb-4">Your Responses</h2>
                        @if($submittedInfo->isEmpty())
                        <p class="text-gray-600">You have no responses.</p>
                        @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($submittedInfo as $response)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold mb-2">Response ID: {{ $response->id }}</h3>
                                <p class="text-gray-700"><strong>Report ID:</strong> {{ $response->missing_person_id }}</p>
                                <p class="text-gray-700"><strong>Response:</strong> {{ $response->description }}</p>
                                <p class="text-gray-700"><strong>Response Date:</strong> {{ $response->created_at->format('d M Y, H:i') }}</p>
                                <p class="mb-1"><strong>Total Submitted Info:</strong> {{ $response->submittedInfos->count() ?? "" }}</p>

                                <a href="{{ route('show-location', ['id' => $response->id]) }}" class="text-blue-500 hover:underline mt-2 inline-block">View Location</a>
                                <!-- Action Buttons -->
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <a href="{{ route('edit-response', ['id' => $response->id]) }}">
                                        <div class="bg-blue-500 text-white px-4 py-2 rounded text-center shadow hover:bg-blue-600">
                                            Edit
                                        </div>
                                    </a>
                                    <div class="bg-red-500 text-white px-4 py-2 rounded text-center shadow hover:bg-red-600 cursor-pointer">
                                        <form action="{{ route('response.delete', ['id' => $response->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this response?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full h-full text-white">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </template>


            <!-- User Accounts Tab -->
            <template x-if="currentPage === 'Accounts'">
                <div class="container p-10" x-data="{
                        searchQuery: '',
                        filterStatus: 'all',
                        users: {{ $users->toJson() }},
                        
                        get filteredUsers() {
                            return this.users.filter(user => {
                                const matchesSearch = user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                                    user.email.toLowerCase().includes(this.searchQuery.toLowerCase());
                                
                                const matchesStatus = this.filterStatus === 'all' || 
                                                    user.status === this.filterStatus;
                                
                                return matchesSearch && matchesStatus;
                            });
                        }
                    }">
                    <h2 class="text-2xl font-bold mb-4">User Accounts</h2>
                    <p class="mb-6">Manage users under this station.</p>

                    <!-- Search and Filter Bar -->
                    <div class="mb-6 flex flex-col md:flex-row gap-4">
                        <input type="text"
                            x-model="searchQuery"
                            placeholder="Search by name or email..."
                            class="w-full md:w-64 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <select x-model="filterStatus"
                            class="w-full md:w-48 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all">All Users</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>

                    <!-- List of Users -->
                    <div class="">
                        <h2 class="text-xl font-semibold mb-4">Users Under This Station</h2>

                        <template x-if="filteredUsers.length === 0">
                            <p class="text-gray-600">No users found matching your criteria.</p>
                        </template>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="user in filteredUsers" :key="user.id">
                                <div class="bg-gray-50 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                                    <a :href="`/user-profile/${user.id}`">

                                        <div class="flex justify-center">
                                            <img :src="user.profile_picture ? '/storage/' + user.profile_picture : 'https://placehold.co/128x128?text=No+Image'"
                                                alt="Profile picture"
                                                class="w-24 h-24 object-cover rounded-full shadow-md">
                                        </div>

                                        <div class="mb-4 text-center">
                                            <div class="mt-2">
                                                <span class="px-2 py-1 rounded-full text-xs font-semibold"
                                                    :class="{'bg-yellow-100 text-yellow-800': user.status === 'pending', 'bg-green-100 text-green-800': user.status === 'approved'}"
                                                    x-text="user.status.charAt(0).toUpperCase() + user.status.slice(1)">
                                                </span>
                                            </div>
                                            <h3 class="text-lg font-semibold text-gray-800" x-text="user.name"></h3>
                                            <p class="text-sm text-gray-600" x-text="user.email"></p>
                                            <p class="text-sm text-gray-600" x-text="user.phone_number"></p>
                                        </div>
                                    </a>
                                    <!-- Action Buttons -->
                                    <div class="grid grid-cols-2 gap-4 mt-4">
                                        <!-- Approve Button (only show for pending users) -->
                                        <a x-show="user.status === 'pending'"
                                            :href="`/users/${user.id}/approve`"
                                            class="bg-blue-500 text-white px-4 py-2 rounded text-center shadow hover:bg-blue-600">
                                            Approve
                                        </a>

                                        <!-- View Profile Button (show for approved users) -->
                                        <a x-show="user.status !== 'pending'"
                                            :href="`/user-profile/${user.id}`"
                                            class="bg-green-500 text-white px-4 py-2 rounded text-center shadow hover:bg-green-600">
                                            View Profile
                                        </a>

                                        <!-- Reject Button (always visible) -->
                                        <a :href="`/users/${user.id}/reject`"
                                            class="bg-red-500 text-white px-4 py-2 rounded text-center shadow hover:bg-red-600">
                                            Reject
                                        </a>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>


        </div>

    </div>

    @foreach($missing as $report)
    <dialog id="showCompletionDetails">
        <!-- Completion Details Modal -->
        <div x-show="showCompletionDetails" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
            x-cloak>
            <div class="bg-white rounded-lg w-full max-w-2xl p-6" @click.outside="showCompletionDetails = false">
                <h3 class="text-xl font-bold mb-4">Completion Details</h3>
                <div x-show="showCompletionModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
                    x-cloak>
                    <div class="bg-white rounded-lg w-full max-w-2xl p-6" @click.outside="showCompletionModal = false">
                        <h3 class="text-xl font-bold mb-4">Complete Missing Report</h3>
                        <form id="completionForm" method="POST" action="{{ route('complete-missing-report', ['id' => $report->id]) }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Hidden Input for missing_person_id -->
                            <input type="hidden" name="missing_person_id" value="{{ $report->id }}">

                            <!-- Found Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Found Date *</label>
                                <input type="date" name="found_date" required
                                    class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Found Location -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Found Location *</label>
                                <input type="text" name="found_location" required
                                    class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Enter exact location or landmark">
                            </div>

                            <!-- Recovery Details -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Recovery Details *</label>
                                <textarea name="recovery_details" rows="3" required
                                    class="w-full p-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Describe how the person was found"></textarea>
                            </div>

                            <!-- Supporting Documents -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Supporting Documents</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload files</span>
                                                <input type="file" name="documents[]" multiple class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF, DOC, JPG up to 10MB</p>
                                    </div>
                                </div>
                            </div>


                            <!-- Form Actions -->
                            <div class="mt-6 flex justify-end space-x-3">
                                <button onclick="document.getElementById('showCompletionDetails').close()"
                                    class="px-4 py-2 border rounded-md hover:bg-gray-50">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                                    Submit Completion
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </dialog>
    @endforeach

    <script>
        $(document).ready(function() {
            $('.ajax-link').on('click', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $('#main-content').html($(response).find('#main-content').html());
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>


</body>

</html>