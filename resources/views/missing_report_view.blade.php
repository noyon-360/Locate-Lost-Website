<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    @vite('resources/css/app.css')
</head>

@include('layouts.app')

<body class="bg-gray-100 text-gray-900">

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-center mb-6">Missing Persons Reports</h1>

        <!-- Filter and Search Form -->
        <div class="mb-6">
            <form method="GET" action="{{ route('missing-reports') }}" class="max-w-lg mx-auto flex items-center space-x-2">
                <label for="search" class="sr-only">Search</label>
                <div class="relative flex-grow">
                    <!-- Search Icon -->
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" aria-hidden="true">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>

                    <!-- Search Input -->
                    <input
                        type=""
                        id="simple-search"
                        name="search"
                        value="{{ request('search') }}"
                        class="block w-full p-4 pl-10 pr-14 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search by ID, Full Name, Father Name, Mother Name"
                        required />

                    <!-- Clear Button -->
                    <button
                        type="button"
                        id="clear-search"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700"
                        aria-label="Clear Search">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" aria-hidden="true">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l8 8M6 14L14 6" />
                        </svg>
                    </button>
                </div>

                <!-- Search Button -->
                <button
                    type="submit"
                    class="flex items-center h-12 p-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <span>Search</span>
                </button>
            </form>
        </div>

        <!-- JavaScript -->
        <script>
            document.getElementById('clear-search').addEventListener('click', function() {
                const searchInput = document.getElementById('simple-search');
                searchInput.value = '';
                window.location.href = "{{ route('missing-reports') }}";
            });
        </script>


        <!-- Tab Buttons -->
        <div class="flex justify-center mb-4">
            <button class="tab-button px-4 py-2 mx-2 bg-blue-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" data-tab="pending">Pending</button>
            <button class="tab-button px-4 py-2 mx-2 bg-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" data-tab="all">All</button>
            <button class="tab-button px-4 py-2 mx-2 bg-gray-300 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" data-tab="found">Complete</button>
        </div>

        <!-- Missing Persons Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($missingPersons as $person)
            <div class="missing-person bg-white p-6 rounded-lg shadow-md relative {{ $person->status }}">
                <!-- Front Image Container -->
                <div class="relative w-full h-64 mb-4 rounded-md overflow-hidden">
                    <img src="{{ asset('storage/' . $person->front_image) }}" alt="Front image of {{ $person->fullname }}" class="w-full h-full object-cover">

                    <!-- User Profile Image -->
                    @if($person->user)
                    <a href="{{ route('common-profile', ['id' => $person->user->id]) }}" class="absolute top-0 right-0 m-2">
                        <img src="{{ asset('storage/' . $person->user->profile_picture) }}" alt="Profile picture of {{ $person->user->name }}" class="w-8 h-8 rounded-full border-2 border-white shadow-md hover:opacity-75" title="{{ $person->user->name }}">
                    </a>
                    @endif
                </div>

                <h2 class="text-xl font-bold mb-2">{!! highlight($person->fullname, request('search')) !!}</h2>
                <p class="mb-1"><strong>Date of Birth:</strong> {!! highlight($person->date_of_birth, request('search')) !!}</p>
                <p class="mb-1"><strong>Gender:</strong> {!! highlight(ucfirst($person->gender), request('search')) !!}</p>
                <p class="mb-1"><strong>Address:</strong> {!! highlight($person->permanent_address, request('search')) !!}</p>
                <p class="mb-1"><strong>Missing Date:</strong> {!! highlight($person->missing_date, request('search')) !!}</p>
                <p class="mb-1"><strong>Total Submitted Info:</strong> {{ $person->submittedInfos->count() }}</p>

                <a href="{{ route('person.details', ['id' => $person->id]) }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-800">View Details</a>
            </div>

            @empty
            <p class="text-center col-span-full">No missing person reports found.</p>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.tab-button');
            const persons = document.querySelectorAll('.missing-person');

            function showTab(tab) {
                persons.forEach(person => {
                    if (tab === 'all' || person.classList.contains(tab)) {
                        person.style.display = 'block';
                    } else {
                        person.style.display = 'none';
                    }
                });

                buttons.forEach(button => {
                    if (button.dataset.tab === tab) {
                        button.classList.add('bg-blue-600', 'text-white');
                        button.classList.remove('bg-gray-300');
                    } else {
                        button.classList.add('bg-gray-300');
                        button.classList.remove('bg-blue-600', 'text-white');
                    }
                });
            }

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    showTab(this.dataset.tab);
                });
            });

            // Initial display
            showTab('pending');
        });
    </script>

</body>

</html>