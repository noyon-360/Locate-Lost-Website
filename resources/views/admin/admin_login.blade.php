<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Locat Lost</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="container mx-auto p-4 sm:p-6">
        <div class="bg-darkSlate p-6 rounded-lg shadow-lg max-w-md mx-auto border border-darkBlue">
            <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-lightGray">
                <i class="fas fa-sign-in-alt"></i> Admin Login
            </h1>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-lightGray font-medium mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                        required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-lightGray font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                        required>
                </div>
                <div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>