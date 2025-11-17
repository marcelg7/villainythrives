@extends('layouts.shop')

@section('title', 'Shopping Cart')

@section('content')
<div class="bg-gray-900 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Cart</span>
            </div>
            <h1 class="text-4xl font-black text-white uppercase mb-2">Shopping Cart</h1>
        </div>

        @if(Cart::count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-950 border-2 border-gray-800">
                        @foreach(Cart::content() as $item)
                            <div class="p-6 border-b border-gray-800 last:border-b-0">
                                <div class="flex gap-6">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0">
                                        <div class="w-24 h-24 bg-gray-800 border-2 border-gray-700 overflow-hidden">
                                            @if($item->options->image)
                                                <img src="{{ $item->options->image }}"
                                                     alt="{{ $item->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}"
                                                         alt="{{ $item->name }}"
                                                         class="w-12 h-12 opacity-50">
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <h3 class="text-white font-bold text-lg mb-1">
                                                    <a href="{{ route('product.show', $item->options->slug) }}" class="hover:text-red-500 transition">
                                                        {{ $item->name }}
                                                    </a>
                                                </h3>
                                                <p class="text-gray-400 text-sm">Price: ${{ number_format($item->price, 2) }}</p>
                                            </div>
                                            <form action="{{ route('cart.remove', $item->rowId) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Quantity Update -->
                                        <div class="flex items-center gap-4">
                                            <form action="{{ route('cart.update', $item->rowId) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <label for="quantity-{{ $item->rowId }}" class="text-gray-400 text-sm font-semibold uppercase">Qty:</label>
                                                <input type="number"
                                                       name="quantity"
                                                       id="quantity-{{ $item->rowId }}"
                                                       value="{{ $item->qty }}"
                                                       min="1"
                                                       max="99"
                                                       class="bg-gray-900 border-2 border-gray-800 text-white py-1 px-3 w-16 focus:border-red-600 focus:outline-none">
                                                <button type="submit" class="bg-gray-800 hover:bg-red-600 text-white font-bold py-1 px-4 uppercase text-xs transition">
                                                    Update
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Subtotal -->
                                        <div class="mt-3">
                                            <p class="text-red-500 font-black text-xl">
                                                ${{ number_format($item->subtotal, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Continue Shopping -->
                    <div class="mt-6">
                        <a href="{{ route('shop') }}"
                           class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 uppercase tracking-wider transition border-2 border-gray-600">
                            &larr; Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-950 border-2 border-gray-800 p-6 sticky top-24">
                        <h2 class="text-white font-black uppercase text-lg mb-6 border-b border-gray-800 pb-3">Order Summary</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-400">
                                <span>Subtotal</span>
                                <span class="text-white font-semibold">${{ Cart::subtotal() }}</span>
                            </div>
                            <div class="flex justify-between text-gray-400">
                                <span>Tax (13% HST)</span>
                                <span class="text-white font-semibold">${{ Cart::tax() }}</span>
                            </div>
                            <div class="border-t border-gray-800 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-white font-bold uppercase text-lg">Total</span>
                                    <span class="text-red-500 font-black text-2xl">${{ Cart::total() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ route('checkout.index') }}"
                           class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 uppercase tracking-wider transition transform hover:scale-105 text-center mb-4">
                            Proceed to Checkout
                        </a>

                        <!-- Payment Methods Info -->
                        <div class="bg-gray-900 border border-gray-800 p-4 text-center">
                            <p class="text-gray-400 text-xs uppercase font-semibold mb-2">We Accept</p>
                            <p class="text-white text-sm">Cash · E-Transfer</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-gray-950 border-2 border-gray-800 p-12 text-center">
                <svg class="w-24 h-24 mx-auto mb-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="text-2xl font-black text-white uppercase mb-4">Your Cart is Empty</h2>
                <p class="text-gray-400 text-lg mb-8">Add some villainous apparel to get started!</p>
                <a href="{{ route('shop') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-12 uppercase tracking-wider transition transform hover:scale-105">
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
