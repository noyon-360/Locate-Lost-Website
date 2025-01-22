<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center focus:outline-none">
        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://placehold.co/40x40?text=Profile' }}"
            alt="Profile picture of {{ Auth::user()->name }}"
            class="w-10 h-10 rounded-full object-cover border border-gray-300">
        <i class="fas fa-chevron-down ml-2 text-white"></i>
    </button>
    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50">
        <a href="{{ route('user.dashboard') }}" @click="localStorage.setItem('currentPage', 'profile'); open = false" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
        <form action="{{ route('user.logout') }}" method="POST" class="block">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
        </form>
    </div>
</div>