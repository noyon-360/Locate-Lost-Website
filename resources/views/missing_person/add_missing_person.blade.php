<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locat Lost - Missing Person Report</title>
    @vite('resources/css/app.css')

</head>

@extends('layouts.app')


<body class="bg-police text-police">

    @section('content')
    <div class="container mx-auto p-4 sm:p-6">
        <div class="bg-darkSlate p-6 rounded-lg shadow-lg max-w-4xl mx-auto border border-darkBlue">
            <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-lightGray">
                Missing Person Report
            </h1>
            @if (session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('submit-missing-person') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Personal Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray">
                        <i class="fas fa-user "></i> Personal Information
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                        <div>
                            <label for="fullname" class="block text-lightGray font-medium mb-1">Full Name</label>
                            <input type="text" id="fullname" name="fullname"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg  text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-lightGray font-medium mb-1">Date of
                                Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                        <div>
                            <label for="gender" class="block text-lightGray font-medium mb-1">Gender</label>
                            <select id="gender" name="gender"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg  text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="permanent_address" class="block text-lightGray font-medium mb-1">Permanent
                                Address</label>
                            <textarea id="permanent_address" name="permanent_address"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                rows="3" required></textarea>
                        </div>
                    </div>
                </div>

                <!-- Missing Info Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-4 text-lightGray">
                        <i class="fas fa-info-circle"></i> Missing Info
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Missing Date Section -->
                        <div>
                            <label for="missing_date" class="block text-lightGray font-medium mb-1">Missing Date</label>
                            <input type="date" id="missing_date" name="missing_date"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>

                        <!-- Last Seen Information Section -->
                        <div>
                            <label for="last_seen_location_description"
                                class="block text-lightGray font-medium mb-1">Last Seen
                                Location Description</label>
                            <textarea id="last_seen_location_description" name="last_seen_location_description"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                rows="3" required></textarea>
                        </div>
                    </div>
                </div>

                <!-- Family Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray">
                        <i class="fas fa-users"></i> Family Information
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                        <div>
                            <label for="father_name" class="block text-lightGray font-medium mb-1">Father's
                                Name</label>
                            <input type="text" id="father_name" name="father_name"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                        <div>
                            <label for="mother_name" class="block text-lightGray font-medium mb-1">Mother's
                                Name</label>
                            <input type="text" id="mother_name" name="mother_name"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray">
                        <i class="fas fa-phone-alt"></i> Contact Information
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                        <div>
                            <label for="contact_number" class="block text-lightGray font-medium mb-1">Contact
                                Number</label>
                            <input type="tel" id="contact_number" name="contact_number"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                        <div>
                            <label for="email" class="block text-lightGray font-medium mb-1">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full px-2 py-1 border border-lightGray rounded-lg   text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Front Image Upload Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray font-montserrat">
                        <i class="fas fa-image"></i> Upload Front Image
                    </h2>
                    <div class="flex items-center justify-center w-full">
                        <label for="front_image"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-100 dark:hover:bg-gray-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="front_image" name="front_image" type="file" class="hidden" accept="image/*"
                                required onchange="showFrontImage(event)" />
                        </label>
                    </div>
                    <div id="front_image_preview" class="mt-2"></div>
                </div>
                <!-- Additional Pictures Upload Section -->
                <div class="mb-6">
                    <h2 class="text-lg sm:text-xl font-semibold mb-2 text-lightGray font-montserrat">
                        <i class="fas fa-images"></i> Add Additional Pictures
                    </h2>
                    <div class="flex items-center justify-center w-full">
                        <label for="additional_pictures"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-100 dark:hover:bg-gray-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)</p>
                            </div>
                            <input id="additional_pictures" name="additional_pictures[]" type="file" class="hidden"
                                accept="image/*" multiple onchange="showAdditionalPictures(event)" />
                        </label>
                    </div>
                    <small class="text-lightGray">You can upload up to 5 additional pictures.</small>
                    <div id="additional_pictures_preview" class="mt-2 grid grid-cols-4 gap-2"></div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit"
                        class="btn-primary bg-midnightBlue px-4 py-2 rounded-lg font-bold text-white focus:outline-none focus:ring-2 focus:ring-lightGray">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection

    <script>
    // Preview front image
    function showFrontImage(event) {
        const frontImagePreview = document.getElementById('front_image_preview');
        frontImagePreview.innerHTML = '';
        const file = event.target.files[0];
        if (file) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('w-20', 'h-20', 'object-cover', 'rounded-full');
            frontImagePreview.appendChild(img);
        }
    }

    // Preview additional pictures (up to 5 images)
    function showAdditionalPictures(event) {
        const additionalPicturesPreview = document.getElementById('additional_pictures_preview');
        additionalPicturesPreview.innerHTML = '';
        const files = event.target.files;

        // Check if more than 5 files are selected
        if (files.length > 5) {
            alert('You can upload a maximum of 5 pictures.');
            event.target.value = ''; // Clear the file input
            return;
        }

        // Display up to 5 images
        for (let i = 0; i < Math.min(files.length, 5); i++) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(files[i]);
            img.classList.add('w-20', 'h-20', 'object-cover', 'rounded');
            additionalPicturesPreview.appendChild(img);
        }
    }

    // Drag and drop functionality
    document.addEventListener('DOMContentLoaded', function() {
        const dropzones = document.querySelectorAll('.flex.items-center.justify-center.w-full label');

        dropzones.forEach(dropzone => {
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.add('bg-gray-100', 'dark:bg-gray-600');
            });

            dropzone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('bg-gray-100', 'dark:bg-gray-600');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropzone.classList.remove('bg-gray-100', 'dark:bg-gray-600');

                const input = dropzone.querySelector('input[type="file"]');
                input.files = e.dataTransfer.files;

                if (input.id === 'front_image') {
                    showFrontImage({
                        target: input
                    });
                } else if (input.id === 'additional_pictures') {
                    showAdditionalPictures({
                        target: input
                    });
                }
            });
        });
    });
    </script>
</body>

</html>