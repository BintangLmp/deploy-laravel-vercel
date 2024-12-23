<nav class="bg-white p-4 text-blue-700">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex-shrink-0">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('img/jsn.png') }}" class="me-1 h-8" alt="logo-jsn">
                    <div class="h-8 border-r-2 border-gray-300"></div>
                </div>
                <span class="self-center text-2xl font-bold whitespace-nowrap text-gray-800">JSN Pengaduan</span>
            </a>
        </div>
        <!-- Navigation Links -->
        <div id="nav-menu" class="hidden md:block">
            <a href="{{ route('login') }}" class="hover:underline appointment-btn scrollto text-gray-700">Login</a>
        </div>
    </div>
</nav>
