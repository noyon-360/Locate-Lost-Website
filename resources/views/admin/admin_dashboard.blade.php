<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <!-- Include Tailwind CSS -->
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white py-4 px-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('welcome') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Home</a>

                <div class="relative">
                    <a href="{{ route('admin.pending_users') }}"
                        class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">
                        Notifications
                        @if($pendingUsersCount > 0)
                        <span class="absolute top-0 right-0 inline-block w-3 h-3 bg-red-500 rounded-full"></span>
                        @endif
                    </a>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <main class="p-6">
        <h2 class="text-2xl font-bold">Welcome, {{ Auth::guard('admin')->user()->name }}!</h2>
        <p class="mt-2">Here are your details:</p>
        <ul class="mt-4">
            <li><strong>Name:</strong> {{ Auth::guard('admin')->user()->name }}</li>
            <li><strong>Email:</strong> {{ Auth::guard('admin')->user()->email }}</li>
        </ul>

        <h2 class="text-2xl font-bold mt-8">Registered Users</h2>
        <table class="min-w-full bg-white mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Created At</th>
                    <th class="py-2 px-4 border-b">Last Seen</th>
                    <th class="py-2 px-4 border-b">Missing Reports</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->last_login_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->missing_reports_count }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('user.profile', $user->id) }}" class="text-blue-500">View Profile</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>