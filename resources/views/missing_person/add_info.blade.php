<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Information</title>
    @vite('resources/css/app.css')

</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-center mb-6">Add Information for {{ $person->fullname }}</h1>

        <form action="{{ route('missing_person.store_info', $person->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>