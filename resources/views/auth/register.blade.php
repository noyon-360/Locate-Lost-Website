@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-6">
    <div class="bg-darkSlate p-6 rounded-lg shadow-lg max-w-md mx-auto border border-darkBlue">
        <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-center text-lightGray">
            <i class="fas fa-user-plus"></i> Register
        </h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
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
                <label for="password_confirmation" class="block text-lightGray font-medium mb-1">Confirm
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-2 py-1 border border-lightGray rounded-lg text-lightGray focus:outline-none focus:ring-2 focus:ring-lightGray">
                @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-lightGray text-darkSlate font-bold py-2 rounded-lg hover:bg-darkGray">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection