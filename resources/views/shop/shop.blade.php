@extends('layouts.shop')

@section('title', 'Shop All Products')

@section('content')
<div class="bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black text-white uppercase mb-2">Shop All Products</h1>
            <p class="text-gray-400">Discover the full Villainy Thrives collection</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="bg-gray-950 border-2 border-gray-800 p-6 sticky top-24">
                    <h3 class="text-white font-black uppercase text-lg mb-4 border-b border-gray-800 pb-2">Filter</h3>

                    <!-- Categories -->
                    @if($categories->count() > 0)
                        <div class="mb-6">
                            <h4 class="text-gray-300 font-bold uppercase text-sm mb-3">Categories</h4>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                    <a href="{{ route('shop.category', $category->slug) }}"
                                       class="block text-gray-400 hover:text-red-500 transition text-sm">
                                        {{ $category->name }} <span class="text-gray-600">({{ $category->products_count }})</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Sort -->
                    <div>
                        <h4 class="text-gray-300 font-bold uppercase text-sm mb-3">Sort By</h4>
                        <form method="GET" action="{{ route('shop') }}" class="space-y-2">
                            <select name="sort" onchange="this.form.submit()"
                                    class="w-full bg-gray-900 border-2 border-gray-800 text-gray-300 py-2 px-3 focus:border-red-600 focus:outline-none">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name: A-Z</option>
                            </select>
                        </form>
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

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="bg-gray-950 border-2 border-gray-800 p-12 text-center">
                        <p class="text-gray-400 text-lg mb-4">No products found.</p>
                        <a href="{{ route('shop') }}" class="text-red-500 hover:text-red-400 font-bold uppercase">View All Products</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
