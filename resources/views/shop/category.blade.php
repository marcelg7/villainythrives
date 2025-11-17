@extends('layouts.shop')

@section('title', $category->name . ' - Shop')

@section('content')
<div class="bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('shop') }}" class="hover:text-white">Shop</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $category->name }}</span>
            </div>
            <h1 class="text-4xl font-black text-white uppercase mb-2">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-gray-400">{{ $category->description }}</p>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-950 border-2 border-gray-800 p-6 sticky top-24">
                    <h3 class="text-white font-black uppercase text-lg mb-4 border-b border-gray-800 pb-2">Categories</h3>

                    <div class="space-y-2">
                        <a href="{{ route('shop') }}"
                           class="block text-gray-400 hover:text-red-500 transition text-sm">
                            All Products
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('shop.category', $cat->slug) }}"
                               class="block {{ $cat->id == $category->id ? 'text-red-500 font-bold' : 'text-gray-400 hover:text-red-500' }} transition text-sm">
                                {{ $cat->name }} <span class="text-gray-600">({{ $cat->products_count }})</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
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

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="bg-gray-950 border-2 border-gray-800 p-12 text-center">
                        <p class="text-gray-400 text-lg mb-4">No products found in this category.</p>
                        <a href="{{ route('shop') }}" class="text-red-500 hover:text-red-400 font-bold uppercase">View All Products</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
