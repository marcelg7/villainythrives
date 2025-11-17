<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Villainy Thrives') }} - @yield('title', 'Choose Loyalty')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Villainy Thrives - Bold apparel for bikers, fighters, wrestling fans, and blue-collar warriors. Est. 2021 in Huron County, Ontario. Choose Loyalty.')">
    <meta name="keywords" content="@yield('keywords', 'villainy thrives, apparel, t-shirts, hoodies, bikers, fighters, wrestling, blue collar, ontario, canada, choose loyalty')">
    <meta name="author" content="Villainy Thrives">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', config('app.name', 'Villainy Thrives') . ' - Choose Loyalty')">
    <meta property="og:description" content="@yield('og_description', 'Bold apparel for bikers, fighters, wrestling fans, and blue-collar warriors. Est. 2021 in Huron County, Ontario.')">
    <meta property="og:image" content="@yield('og_image', asset('storage/images/villainy-thrives-logo.jpeg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', config('app.name', 'Villainy Thrives') . ' - Choose Loyalty')">
    <meta property="twitter:description" content="@yield('twitter_description', 'Bold apparel for bikers, fighters, wrestling fans, and blue-collar warriors.')">
    <meta property="twitter:image" content="@yield('twitter_image', asset('storage/images/villainy-thrives-logo.jpeg'))">

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}">

    <!-- PWA -->
    @laravelPWA

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
    <!-- Navigation -->
    <nav class="bg-black border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}" alt="Villainy Thrives" class="h-16 w-16 rounded-full">
                        <div class="ml-3">
                            <div class="text-xl font-black text-white uppercase tracking-wider">Villainy Thrives</div>
                            <div class="text-xs text-gray-400 uppercase tracking-widest">Choose Loyalty</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition font-semibold uppercase text-sm tracking-wide">Home</a>
                    <a href="{{ route('shop') }}" class="text-gray-300 hover:text-white transition font-semibold uppercase text-sm tracking-wide">Shop</a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if(Cart::count() > 0)
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ Cart::count() }}</span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition font-semibold uppercase text-sm tracking-wide">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition font-semibold uppercase text-sm tracking-wide">Login</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-300 hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden bg-gray-950 border-t border-gray-800">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md font-semibold uppercase text-sm">Home</a>
                <a href="{{ route('shop') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md font-semibold uppercase text-sm">Shop</a>
                <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md font-semibold uppercase text-sm">
                    Cart @if(Cart::count() > 0)<span class="text-red-500">({{ Cart::count() }})</span>@endif
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md font-semibold uppercase text-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-300 hover:text-white hover:bg-gray-800 rounded-md font-semibold uppercase text-sm">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-900 border-l-4 border-green-500 text-green-100 p-4 mx-4 mt-4" role="alert">
            <p class="font-bold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-900 border-l-4 border-red-500 text-red-100 p-4 mx-4 mt-4" role="alert">
            <p class="font-bold">Error!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black border-t border-gray-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}" alt="Villainy Thrives" class="h-20 w-20 rounded-full mb-4">
                    <h3 class="text-xl font-black text-white uppercase tracking-wider mb-2">Villainy Thrives</h3>
                    <p class="text-gray-400 text-sm mb-4">Bold apparel for bikers, fighters, wrestling fans, and blue-collar warriors. Est. 2021 in Huron County, Ontario.</p>
                    <p class="text-red-500 font-bold uppercase tracking-wider">Choose Loyalty</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-bold uppercase text-sm mb-4 tracking-wider">Shop</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('shop') }}" class="text-gray-400 hover:text-white transition text-sm">All Products</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white transition text-sm">Cart</a></li>
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-white font-bold uppercase text-sm mb-4 tracking-wider">Info</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition text-sm">Contact</a></li>
                        @auth
                            <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white transition text-sm">Account</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Villainy Thrives. Est. 2021. All rights reserved.</p>
                <p class="text-gray-600 text-xs mt-2">Huron County, Ontario, Canada</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js for mobile menu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                mobileMenuOpen: false
            }))
        })
    </script>
</body>
</html>
