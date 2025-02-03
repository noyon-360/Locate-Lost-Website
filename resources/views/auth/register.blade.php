@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-6">
    <div class="bg-darkSlate p-6 rounded-lg shadow-lg max-w-2xl mx-auto border border-darkBlue">
        <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-lightGray">
            <i class="fas fa-user-plus"></i> Register
        </h1>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col sm:flex-row">
                <div class="flex-1 mb-4 sm:mb-0 sm:mr-4">
                    <div class="mb-4">
                        <label for="name" class="block text-lightGray font-medium mb-1">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                        @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lightGray font-medium mb-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-lightGray font-medium mb-1">Password</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-lightGray font-medium mb-1">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                        @error('password_confirmation')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Phone number -->
                    <div class="mb-4">
                        <label for="phone_number" class="block text-lightGray font-medium mb-1">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}"
                            class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                        @error('phone_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Station Name -->
                    <div class="mb-4">
                        <label for="station_name" class="block text-lightGray font-medium mb-1">Station Name</label>
                        <select id="station_name" name="station_name"
                            class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                            <option value="">Select Station</option>
                            @foreach($stations as $station)
                            <option value="{{ $station->station_name }}"
                                {{ old('station_name') == $station->station_name ? 'selected' : '' }}>
                                {{ $station->station_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('station_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- Divider Line -->
                <div class="hidden sm:block w-px bg-gray-300 mx-4"></div>
                <!-- Profile Picture Upload Section -->
                <div class="flex-1 mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray font-montserrat">
                        <i class="fas fa-image"></i> Upload Profile Picture
                    </h2>
                    <div id="profile_picture_container" class="flex flex-col items-center justify-center w-full">
                        <button type="button" onclick="document.getElementById('profile_picture').click()"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-md transition">
                            Choose Picture
                        </button>
                        <input id="profile_picture" name="profile_picture" type="file" class="hidden" accept="image/*"
                            onchange="showProfilePicture(event)" />
                    </div>
                    <div id="profile_picture_preview" class="mt-2 text-center">
                        <p class="text-gray-500 mt-2">Please choose an image to upload. Allowed formats: JPEG, PNG, JPG, GIF, SVG. Maximum size: 2MB.</p>
                    </div>
                    @error('profile_picture')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="text-center p-3">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-md shadow-md transition">
                    Register
                </button>
                <p class="mt-4 text-lightGray">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    function showProfilePicture(event) {
        const input = event.target;
        const preview = document.getElementById('profile_picture_preview');
        preview.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-64 object-cover rounded-lg mt-2';
                preview.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection