@extends('layouts.shop')

@section('title', 'Home - Choose Loyalty')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-black py-20 lg:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div>
                <h1 class="text-5xl lg:text-7xl font-black text-white uppercase mb-6 leading-tight">
                    Villainy<br/>
                    <span class="text-red-600">Thrives</span>
                </h1>
                <p class="text-xl text-gray-300 mb-4 font-bold uppercase tracking-wider">Choose Loyalty</p>
                <p class="text-lg text-gray-400 mb-8 max-w-lg">
                    Bold apparel for bikers, fighters, wrestling fans, and blue-collar warriors.
                    Embrace your inner villain. Stand with the loyal.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('shop') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 uppercase tracking-wider transition transform hover:scale-105">
                        Shop Now
                    </a>
                    <a href="{{ route('shop') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-4 px-8 uppercase tracking-wider transition border-2 border-gray-600">
                        View Collection
                    </a>
                </div>
            </div>

            <!-- Hero Image/Logo -->
            <div class="flex justify-center lg:justify-end">
                <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}"
                     alt="Villainy Thrives Logo"
                     class="w-64 h-64 lg:w-96 lg:h-96 rounded-full shadow-2xl border-4 border-red-600 animate-pulse">
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-red-600 to-transparent"></div>
</div>

<!-- Categories Section -->
@if($categories->count() > 0)
<div class="py-16 bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-black text-white uppercase mb-8 text-center">Shop by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('shop.category', $category->slug) }}"
                   class="bg-gray-900 hover:bg-gray-800 border-2 border-gray-800 hover:border-red-600 transition p-6 text-center group">
                    <h3 class="text-white font-bold uppercase text-sm mb-2 group-hover:text-red-500 transition">{{ $category->name }}</h3>
                    <p class="text-gray-500 text-xs">{{ $category->products_count }} {{ Str::plural('item', $category->products_count) }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Featured Products -->
@if($featuredProducts->count() > 0)
<div class="py-16 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-black text-white uppercase mb-4">Featured Products</h2>
            <p class="text-gray-400 text-lg">Latest drops from the villainous collection</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <div class="bg-gray-950 border-2 border-gray-800 hover:border-red-600 transition group overflow-hidden">
                    <!-- Product Image -->
                    <div class="aspect-square bg-gray-800 relative overflow-hidden">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}"
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}"
                                     alt="{{ $product->name }}"
                                     class="w-32 h-32 opacity-50">
                            </div>
                        @endif

                        <!-- Category Badge -->
                        <div class="absolute top-2 right-2">
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 uppercase">{{ $product->category->name }}</span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="text-white font-bold text-lg mb-2 group-hover:text-red-500 transition">{{ $product->name }}</h3>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>

                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-black text-red-500">${{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('product.show', $product->slug) }}"
                               class="bg-gray-800 hover:bg-red-600 text-white font-bold py-2 px-4 uppercase text-xs transition">
                                View
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('shop') }}"
               class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-12 uppercase tracking-wider transition transform hover:scale-105">
                View All Products
            </a>
        </div>
    </div>
</div>
@endif

<!-- Brand Story Section -->
<div class="py-20 bg-black">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-black text-white uppercase mb-6">Born from Resilience</h2>
        <p class="text-xl text-gray-300 mb-6 leading-relaxed">
            Est. 2021 in Huron County, Ontario. We're not just apparel — we're a movement for the loyal,
            the fighters, the rebels who choose to stand strong when others fall.
        </p>
        <p class="text-2xl font-black text-red-500 uppercase tracking-wider">
            🔨 Choose Loyalty 🔨
        </p>
    </div>
</div>
@endsection
