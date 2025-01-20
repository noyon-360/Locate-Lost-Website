<div>
    <!-- Drawer Toggle Button -->
    <div class="text-center">
        <button id="drawer-toggle" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button">
            <span id="drawer-toggle-text">Show Menu</span>
        </button>
    </div>

    <!-- Drawer Component -->
    <div id="drawer" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1">
        <h5 id="drawer-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
        <button type="button" id="drawer-close" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3 drawer-text">Dashboard</span>
                    </a>
                </li>
                <!-- Add more menu items here -->
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('drawer-toggle').addEventListener('click', function() {
        const drawer = document.getElementById('drawer');
        const drawerText = document.querySelectorAll('.drawer-text');
        const drawerToggleText = document.getElementById('drawer-toggle-text');
        if (drawer.classList.contains('-translate-x-full')) {
            drawer.classList.remove('-translate-x-full');
            drawerText.forEach(text => text.style.display = 'inline');
            drawerToggleText.textContent = 'Hide Menu';
        } else {
            drawer.classList.add('-translate-x-full');
            drawerText.forEach(text => text.style.display = 'none');
            drawerToggleText.textContent = 'Show Menu';
        }
    });

    document.getElementById('drawer-close').addEventListener('click', function() {
        const drawer = document.getElementById('drawer');
        const drawerText = document.querySelectorAll('.drawer-text');
        const drawerToggleText = document.getElementById('drawer-toggle-text');
        drawer.classList.add('-translate-x-full');
        drawerText.forEach(text => text.style.display = 'none');
        drawerToggleText.textContent = 'Show Menu';
    });
</script>