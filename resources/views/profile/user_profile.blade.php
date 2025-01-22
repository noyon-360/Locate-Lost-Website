<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    @vite('resources/css/app.css')
    <!-- Include Tailwind CSS -->
</head>

<body class="bg-gray-100">
    <header class="bg-blue-600 text-white py-4 px-6">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">User Profile</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Back to Dashboard</a>


                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <main class="p-6">
        <h2 class="text-2xl font-bold">User Details</h2>
        <ul class="mt-4">
            <li><strong>Name:</strong> {{ $user->name }}</li>
            <li><strong>Email:</strong> {{ $user->email }}</li>
            <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
            <li><strong>Created At:</strong> {{ $user->created_at }}</li>
            <li><strong>Last Login At:</strong> {{ $user->last_login_at }}</li>
        </ul>

        <h3 class="text-xl font-bold mt-6">Missing Reports:</h3>
        @if($user->missingPersons->isEmpty())
        <p class="mt-2">This user has no missing reports.</p>
        @else
        <ul class="mt-4">
            @foreach($user->missingPersons as $report)
            <li class="mb-2">
                <strong>Report ID:</strong> {{ $report->id }}<br>
                <strong>Full Name:</strong> {{ $report->fullname }}<br>
                <strong>Date of Birth:</strong> {{ $report->date_of_birth }}<br>
                <strong>Gender:</strong> {{ $report->gender }}<br>
                <strong>Permanent Address:</strong> {{ $report->permanent_address }}<br>
                <strong>Last Seen Location:</strong> {{ $report->last_seen_location_description }}<br>
                <strong>Father's Name:</strong> {{ $report->father_name }}<br>
                <strong>Mother's Name:</strong> {{ $report->mother_name }}<br>
                <strong>Contact Number:</strong> {{ $report->contact_number }}<br>
                <strong>Email:</strong> {{ $report->email }}<br>
                <strong>Date Reported:</strong> {{ $report->created_at->format('d M Y') }}
            </li>
            @endforeach
        </ul>
        @endif
    </main>
</body>

</html>