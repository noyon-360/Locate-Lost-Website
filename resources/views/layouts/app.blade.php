<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locate Lost</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>

    @vite('resources/js/imageModal.js')
    @vite('resources/js/toggleDrawer.js')
    @vite('resources/css/app.css')
    <script>
        function toggleDrawer() {
            document.getElementById('drawer').classList.toggle('hidden');
        }
    </script>
</head>

<body>
    <nav class="bg-midnightBlue p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-white text-lg font-bold">
                <a href="{{ url('/') }}">Locate Lost</a>
            </div>
            <button class="md:hidden" onclick="toggleDrawer()">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <div class="hidden md:flex items-center space-x-4 ">
                <!-- Common link for all roles -->

                <!-- Welcome page -->
                <a href="{{ url('/') }}" class="text-white hover:text-gray-300 transition duration-300">Home</a>

                <!-- Missing Report Page -->
                <a href="{{ route('missing-reports') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Missing Reports</a>

                <a href="{{ route('add-missing-person') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Add Missing
                    Report</a>

                @if(Auth::guard('admin')->check())
                <!-- Admin Links -->
                <a href="{{ route('admin.dashboard') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Admin Dashboard
                </a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:bg-red-600 px-3 py-2 rounded-md text-sm font-medium">
                        Logout
                    </button>
                </form>
                @elseif(Auth::guard('web')->check())
                <!-- User Links -->
                <a href="{{ route('user.dashboard') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    User Dashboard
                </a>
                <form action="{{ route('user.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:bg-red-600 px-3 py-2 rounded-md text-sm font-medium">
                        Logout
                    </button>
                </form>
                @else
                <!-- Guest Links -->
                <a href="{{ route('admin.login') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Admin
                </a>
                <a href="{{ route('login') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">
                    Register
                </a>
                @endif
            </div>
        </div>
        <div id="drawer" class="md:hidden hidden">
            <div class="flex flex-col space-y-2 mt-4">

                <a href="{{ route('add-missing-person') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Add Missing
                    Report</a>

                @if(Auth::guard('admin')->check())
                <a href="{{ route('admin.dashboard') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Admin Dashboard</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-white hover:bg-red-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                </form>


                @elseif(Auth::guard('web')->check())
                <a href="{{ route('user.dashboard') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">User Dashboard</a>
                <form action="{{ route('user.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-white hover:bg-red-600 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                </form>


                @else
                <a href="{{ route('admin.login') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Admin</a>
                <a href="{{ route('login') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                <a href="{{ route('register') }}"
                    class="text-white hover:bg-green-700 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container mx-auto p-4">
        @yield('content')
    </div>
</body>

</html>