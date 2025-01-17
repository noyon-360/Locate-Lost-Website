<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    @vite('resources/css/app.css')
    <!-- Include Tailwind CSS -->
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-600 text-white flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Dashboard</h1>
            </div>
            <nav class="flex-1">
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="{{ route('welcome') }}"
                            class="flex items-center p-2 rounded bg-blue-700 hover:bg-blue-800">
                            <span class="ml-2">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-800">
                            <span class="ml-2">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-800">
                            <span class="ml-2">Missing Reports</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full text-left p-2 rounded hover:bg-blue-800">
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header -->
            <header class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h2>
                <form action="{{ route('user.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 text-white rounded">Logout</button>
                </form>
            </header>

            <!-- User Details -->
            <section class="mb-8">
                <h3 class="text-xl font-bold text-gray-700">Your Details</h3>
                <ul class="mt-4 bg-white shadow rounded p-4 space-y-2">
                    <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                    <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
                    <li><strong>Role:</strong> {{ ucfirst(Auth::user()->role) }}</li>
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
                        <p><strong>Report ID:</strong> {{ $report->id }}</p>
                        <p><strong>Full Name:</strong> {{ $report->fullname }}</p>
                        <p><strong>Date of Birth:</strong> {{ $report->date_of_birth }}</p>
                        <p><strong>Gender:</strong> {{ $report->gender }}</p>
                        <p><strong>Permanent Address:</strong> {{ $report->permanent_address }}</p>
                        <p><strong>Last Seen Location:</strong> {{ $report->last_seen_location_description }}</p>
                        <p><strong>Father's Name:</strong> {{ $report->father_name }}</p>
                        <p><strong>Mother's Name:</strong> {{ $report->mother_name }}</p>
                        <p><strong>Contact Number:</strong> {{ $report->contact_number }}</p>
                        <p><strong>Email:</strong> {{ $report->email }}</p>
                        <p><strong>Date Reported:</strong> {{ $report->created_at->format('d M Y') }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </section>
        </main>
    </div>
</body>

</html>