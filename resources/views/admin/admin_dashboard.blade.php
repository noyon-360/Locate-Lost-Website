<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-600 text-white py-4 px-6 shadow-md">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
            <div class="flex items-center space-x-6">
                <a href="{{ route('welcome') }}" class="hover:bg-blue-700 px-4 py-2 rounded-md text-sm font-medium">
                    Home
                </a>
                <div class="relative">
                    <a href="{{ route('admin.pending_users') }}">
                        <button  class="relative flex items-center px-4 py-2 rounded-md hover:bg-blue-700">
                        Notifications
                        @if($pendingUsersCount > 0)
                        <span class="absolute top-0 right-0 mt-0.5 ml-2 bg-red-500 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $pendingUsersCount }}
                        </span>
                        @endif
                    </button>
                    </a>
                    
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" class="hidden md:inline">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded-md">Logout</button>
                </form>
                <!-- Dropdown for small screens -->
                <div class="relative md:hidden">
                    <button id="menuToggle" class="px-4 py-2 rounded-md hover:bg-blue-700">Menu</button>
                    <div id="menuDropdown" class="hidden absolute right-0 bg-white mt-2 py-2 w-48 rounded shadow-lg">
                        <a href="{{ route('welcome') }}" class="block px-4 py-2 hover:bg-gray-200">Home</a>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-200">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-6">
        <!-- Admin Info -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Welcome, {{ Auth::guard('admin')->user()->name }}!</h2>
            <div class="bg-white p-6 rounded-md shadow-md">
                <h3 class="text-lg font-semibold mb-2">Admin Details</h3>
                <ul class="space-y-2">
                    <li><strong>Name:</strong> {{ Auth::guard('admin')->user()->name }}</li>
                    <li><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</li>
                </ul>
            </div>
        </div>

        <!-- Registered Users Table -->
        <h2 class="text-2xl font-bold mb-4">Registered Users</h2>
        <div class="bg-white rounded-md shadow-md overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Last Seen</th>
                        <th class="py-3 px-6 text-left">Missing Reports</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $user->id }}</td>
                        <td class="py-3 px-6">{{ $user->name }}</td>
                        <td class="py-3 px-6">{{ $user->email }}</td>
                        <td class="py-3 px-6">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-6">{{ $user->last_login_at ?? 'N/A' }}</td>
                        <td class="py-3 px-6">{{ $user->missing_reports_count }}</td>
                        <td class="py-3 px-6">
                            <a href="{{ route('users.profile', $user->id) }}" class="text-blue-600 hover:underline">
                                View Profile
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <!-- Dropdown Toggle Script -->
    <script>
        document.getElementById('menuToggle').addEventListener('click', function () {
            const menu = document.getElementById('menuDropdown');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
