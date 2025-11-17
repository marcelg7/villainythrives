@extends('layouts.shop')

@section('title', $product->name)

@section('description', Str::limit($product->description, 155))
@section('keywords', 'villainy thrives, ' . strtolower($product->category->name) . ', ' . strtolower($product->name) . ', apparel, ontario')

@section('og_title', $product->name . ' - Villainy Thrives')
@section('og_description', Str::limit($product->description, 200))
@section('og_image', $product->image_url ?: asset('storage/images/villainy-thrives-logo.jpeg'))

@section('twitter_title', $product->name . ' - Villainy Thrives')
@section('twitter_description', Str::limit($product->description, 200))
@section('twitter_image', $product->image_url ?: asset('storage/images/villainy-thrives-logo.jpeg'))

@section('content')
<div class="bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop') }}" class="hover:text-white">Shop</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.category', $product->category->slug) }}" class="hover:text-white">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Product Image -->
            <div>
                <div class="aspect-square bg-gray-950 border-4 border-gray-800 rounded-lg overflow-hidden sticky top-24">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-800">
                            <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}"
                                 alt="{{ $product->name }}"
                                 class="w-64 h-64 opacity-50">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <!-- Category Badge -->
                <div class="mb-4">
                    <a href="{{ route('shop.category', $product->category->slug) }}"
                       class="inline-block bg-red-600 text-white text-xs font-bold px-3 py-1 uppercase hover:bg-red-700 transition">
                        {{ $product->category->name }}
                    </a>
                </div>

                <!-- Product Name -->
                <h1 class="text-4xl lg:text-5xl font-black text-white uppercase mb-4">{{ $product->name }}</h1>

                <!-- Price -->
                <div class="mb-6">
                    <span class="text-5xl font-black text-red-500">${{ number_format($product->price, 2) }}</span>
                    <span class="text-gray-400 text-lg ml-2">CAD</span>
                </div>

                <!-- Description -->
                @if($product->description)
                    <div class="mb-8">
                        <h3 class="text-white font-bold uppercase text-sm mb-3 border-b border-gray-800 pb-2">Description</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Add to Cart Form -->
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-8">
                    @csrf
                    <div class="flex items-center gap-4 mb-6">
                        <label for="quantity" class="text-white font-bold uppercase text-sm">Quantity:</label>
                        <input type="number"
                               name="quantity"
                               id="quantity"
                               value="1"
                               min="1"
                               max="99"
                               class="bg-gray-950 border-2 border-gray-800 text-white py-2 px-4 w-20 focus:border-red-600 focus:outline-none">
                    </div>

                    <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 uppercase tracking-wider transition transform hover:scale-105 mb-4">
                        Add to Cart
                    </button>

                    <a href="{{ route('shop') }}"
                       class="block w-full text-center bg-gray-800 hover:bg-gray-700 text-white font-bold py-4 px-8 uppercase tracking-wider transition border-2 border-gray-600">
                        Continue Shopping
                    </a>
                </form>

                <!-- Product Details -->
                <div class="bg-gray-950 border-2 border-gray-800 p-6">
                    <h3 class="text-white font-bold uppercase text-sm mb-4">Product Details</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li class="flex justify-between">
                            <span>Category:</span>
                            <span class="text-white font-semibold">{{ $product->category->name }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>SKU:</span>
                            <span class="text-white font-mono">VT-{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Availability:</span>
                            <span class="text-green-500 font-semibold">In Stock</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="border-t border-gray-800 pt-12">
                <h2 class="text-3xl font-black text-white uppercase mb-8">You May Also Like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-gray-950 border-2 border-gray-800 hover:border-red-600 transition group overflow-hidden">
                            <!-- Product Image -->
                            <div class="aspect-square bg-gray-800 relative overflow-hidden">
                                @if($related->image_url)
                                    <img src="{{ $related->image_url }}"
                                         alt="{{ $related->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}"
                                             alt="{{ $related->name }}"
                                             class="w-32 h-32 opacity-50">
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="text-white font-bold text-lg mb-2 group-hover:text-red-500 transition">{{ $related->name }}</h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-black text-red-500">${{ number_format($related->price, 2) }}</span>
                                    <a href="{{ route('product.show', $related->slug) }}"
                                       class="bg-gray-800 hover:bg-red-600 text-white font-bold py-2 px-4 uppercase text-xs transition">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
