<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 font-sans">
    <div x-data="{ drawerOpen: window.innerWidth >= 768 }" class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 bg-blue-600 text-white z-40 transform transition-all duration-300 ease-in-out"
            :class="{'w-64': drawerOpen, 'w-16': !drawerOpen}" x-cloak>
            <div class="p-6 flex items-center justify-between" x-show="drawerOpen" x-transition>
                <h1 class="text-2xl font-bold">Dashboard</h1>

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
                        <a href="{{ route('user.profile', Auth()->user()->id) }}" class="flex items-center p-3 hover:bg-blue-700 rounded transition">
                            <i class="fas fa-user"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="" class="flex items-center p-3 hover:bg-blue-700 rounded transition">
                            <i class="fas fa-book"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Resources</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('missing-reports') }}" class="flex items-center p-3 hover:bg-blue-700 rounded transition">
                            <i class="fas fa-file-alt"></i>
                            <span class="ml-3" x-show="drawerOpen" x-transition>Missing Reports</span>
                        </a>
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
        <div class="flex-1 flex flex-col transition-all duration-300 ease-in-out" :class="{'ml-64': drawerOpen, 'ml-16': !drawerOpen}">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex items-center justify-between sticky top-0 z-50">
                <div class="flex items-center">
                    <button class="text-gray-600 hover:text-gray-800 focus:outline-none" @click="drawerOpen = !drawerOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                    <span class="ml-4 text-lg font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</span>
                </div>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center focus:outline-none">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://placehold.co/40x40?text=Profile' }}"
                            alt="Profile picture of {{ Auth::user()->name }}"
                            class="w-10 h-10 rounded-full object-cover border border-gray-300">
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
                        <a href="{{ route('user.profile', Auth::user()->id) }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                        <form action="{{ route('user.logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6">
                <!-- User Details -->
                <section class="mb-8">
                    <h3 class="text-xl font-bold text-gray-700">Your Details</h3>
                    <ul class="mt-4 bg-white shadow rounded p-4 space-y-2">
                        <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    </ul>
                </section>

                <!-- Missing Reports -->
                <section>
                    <h3 class="text-xl font-bold text-gray-700 mb-4">Your Missing Reports</h3>
                    @if($missing->isEmpty())
                    <div class="bg-white shadow rounded p-4">
                        <p class="text-gray-600">You have no missing reports.</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($missing as $report)
                        <div class="bg-white shadow rounded p-4">
                            <a href="{{ route('person.details', ['id' => $report->id]) }}" class="block rounded-lg p-1 hover:bg-blue-50 cursor-pointer transition">
                                <div class="flex items-center space-x-4 mb-4">
                                    <img src="{{ $report->front_image ? asset('storage/' . $report->front_image) : 'https://placehold.co/128x128?text=Missing+Person' }}"
                                        alt="Profile picture of {{ $report->fullname }}"
                                        class="w-16 h-16 object-cover rounded-full shadow-md">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">{{ $report->fullname }}</h4>
                                        <p class="text-gray-500 text-sm">Reported on: {{ \Carbon\Carbon::parse($report->created_at)->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
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

                                <!-- Additional Pictures Section -->
                                <div class="mt-6 grid grid-cols-3 gap-2">
                                    @foreach(json_decode($report->additional_pictures) as $picture)
                                    <img src="{{ asset('storage/' . $picture) }}"
                                        alt="Additional picture of {{ $report->fullname }}"
                                        class="w-full h-20 object-cover rounded-md border border-gray-200">
                                    @endforeach
                                </div>
                            </a>
                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <a href="{{ route('edit-missing-person', ['id' => $report->id]) }}">
                                    <div class="bg-blue-500 text-white px-4 py-2 rounded text-center shadow hover:bg-blue-600">
                                        Edit
                                    </div>
                                </a>

                                <div class="bg-red-500 text-white px-4 py-2 rounded text-center shadow hover:bg-red-600 cursor-pointer">
                                    <form action="{{ route('report.delete', ['id' => $report->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
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
                </section>
            </main>
        </div>
    </div>
</body>

</html>