@extends('layouts.shop')

@section('title', 'Checkout')

@section('content')
<div class="bg-gray-900 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center text-sm text-gray-400 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('cart.index') }}" class="hover:text-white">Cart</a>
                <span class="mx-2">/</span>
                <span class="text-white">Checkout</span>
            </div>
            <h1 class="text-4xl font-black text-white uppercase mb-2">Checkout</h1>
        </div>

        @if(Cart::count() > 0)
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Checkout Form -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Customer Information -->
                        <div class="bg-gray-950 border-2 border-gray-800 p-6">
                            <h2 class="text-white font-black uppercase text-lg mb-6 border-b border-gray-800 pb-3">Customer Information</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-gray-300 font-semibold uppercase text-xs mb-2">First Name *</label>
                                    <input type="text"
                                           name="first_name"
                                           id="first_name"
                                           value="{{ old('first_name', auth()->user()->name ?? '') }}"
                                           required
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('first_name') border-red-500 @enderror">
                                    @error('first_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="last_name" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Last Name *</label>
                                    <input type="text"
                                           name="last_name"
                                           id="last_name"
                                           value="{{ old('last_name') }}"
                                           required
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('last_name') border-red-500 @enderror">
                                    @error('last_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="email" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Email Address *</label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           value="{{ old('email', auth()->user()->email ?? '') }}"
                                           required
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('email') border-red-500 @enderror">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="phone" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Phone Number *</label>
                                    <input type="tel"
                                           name="phone"
                                           id="phone"
                                           value="{{ old('phone') }}"
                                           required
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('phone') border-red-500 @enderror">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Shipping Address -->
                        <div class="bg-gray-950 border-2 border-gray-800 p-6">
                            <h2 class="text-white font-black uppercase text-lg mb-6 border-b border-gray-800 pb-3">Shipping Address</h2>

                            <div class="space-y-4">
                                <div>
                                    <label for="address_line1" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Address Line 1 *</label>
                                    <input type="text"
                                           name="address_line1"
                                           id="address_line1"
                                           value="{{ old('address_line1') }}"
                                           required
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('address_line1') border-red-500 @enderror">
                                    @error('address_line1')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="address_line2" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Address Line 2</label>
                                    <input type="text"
                                           name="address_line2"
                                           id="address_line2"
                                           value="{{ old('address_line2') }}"
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="city" class="block text-gray-300 font-semibold uppercase text-xs mb-2">City *</label>
                                        <input type="text"
                                               name="city"
                                               id="city"
                                               value="{{ old('city') }}"
                                               required
                                               class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('city') border-red-500 @enderror">
                                        @error('city')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="province" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Province *</label>
                                        <input type="text"
                                               name="province"
                                               id="province"
                                               value="{{ old('province', 'ON') }}"
                                               required
                                               class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('province') border-red-500 @enderror">
                                        @error('province')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="postal_code" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Postal Code *</label>
                                        <input type="text"
                                               name="postal_code"
                                               id="postal_code"
                                               value="{{ old('postal_code') }}"
                                               required
                                               class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('postal_code') border-red-500 @enderror">
                                        @error('postal_code')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="country" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Country *</label>
                                    <input type="text"
                                           name="country"
                                           id="country"
                                           value="{{ old('country', 'Canada') }}"
                                           required
                                           class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none @error('country') border-red-500 @enderror">
                                    @error('country')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="bg-gray-950 border-2 border-gray-800 p-6">
                            <h2 class="text-white font-black uppercase text-lg mb-6 border-b border-gray-800 pb-3">Payment Method</h2>

                            <div class="space-y-4">
                                <label class="flex items-center p-4 bg-gray-900 border-2 border-gray-800 cursor-pointer hover:border-red-600 transition">
                                    <input type="radio"
                                           name="payment_method"
                                           value="etransfer"
                                           {{ old('payment_method', 'etransfer') == 'etransfer' ? 'checked' : '' }}
                                           class="w-5 h-5 text-red-600 focus:ring-red-600 focus:ring-2 bg-gray-800 border-gray-700">
                                    <div class="ml-4">
                                        <p class="text-white font-bold uppercase">E-Transfer</p>
                                        <p class="text-gray-400 text-sm">Send payment via Interac e-Transfer</p>
                                    </div>
                                </label>

                                <label class="flex items-center p-4 bg-gray-900 border-2 border-gray-800 cursor-pointer hover:border-red-600 transition">
                                    <input type="radio"
                                           name="payment_method"
                                           value="cash"
                                           {{ old('payment_method') == 'cash' ? 'checked' : '' }}
                                           class="w-5 h-5 text-red-600 focus:ring-red-600 focus:ring-2 bg-gray-800 border-gray-700">
                                    <div class="ml-4">
                                        <p class="text-white font-bold uppercase">Cash on Delivery</p>
                                        <p class="text-gray-400 text-sm">Pay with cash upon delivery</p>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order Notes -->
                        <div class="bg-gray-950 border-2 border-gray-800 p-6">
                            <h2 class="text-white font-black uppercase text-lg mb-6 border-b border-gray-800 pb-3">Order Notes (Optional)</h2>

                            <div>
                                <label for="notes" class="block text-gray-300 font-semibold uppercase text-xs mb-2">Special Instructions</label>
                                <textarea name="notes"
                                          id="notes"
                                          rows="4"
                                          class="w-full bg-gray-900 border-2 border-gray-800 text-white py-2 px-4 focus:border-red-600 focus:outline-none"
                                          placeholder="Any special delivery instructions or notes...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-950 border-2 border-gray-800 p-6 sticky top-24">
                            <h2 class="text-white font-black uppercase text-lg mb-6 border-b border-gray-800 pb-3">Order Summary</h2>

                            <!-- Cart Items -->
                            <div class="mb-6 max-h-64 overflow-y-auto">
                                @foreach(Cart::content() as $item)
                                    <div class="flex gap-3 mb-4 pb-4 border-b border-gray-800 last:border-b-0">
                                        <div class="w-16 h-16 bg-gray-800 flex-shrink-0 overflow-hidden">
                                            @if($item->options->image)
                                                <img src="{{ $item->options->image }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}" alt="{{ $item->name }}" class="w-8 h-8 opacity-50">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow">
                                            <p class="text-white text-sm font-semibold line-clamp-2">{{ $item->name }}</p>
                                            <p class="text-gray-400 text-xs">Qty: {{ $item->qty }} × ${{ number_format($item->price, 2) }}</p>
                                            <p class="text-red-500 text-sm font-bold">${{ number_format($item->subtotal, 2) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Totals -->
                            <div class="space-y-3 mb-6 border-t border-gray-800 pt-4">
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

                            <!-- Place Order Button -->
                            <button type="submit"
                                    class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-8 uppercase tracking-wider transition transform hover:scale-105 text-center mb-4">
                                Place Order
                            </button>

                            <!-- Security Notice -->
                            <div class="bg-gray-900 border border-gray-800 p-4 text-center">
                                <p class="text-gray-400 text-xs">
                                    Your order details are secure and will be confirmed via email.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <!-- Empty Cart Redirect -->
            <div class="bg-gray-950 border-2 border-gray-800 p-12 text-center">
                <h2 class="text-2xl font-black text-white uppercase mb-4">Your Cart is Empty</h2>
                <p class="text-gray-400 text-lg mb-8">Add some products before checking out.</p>
                <a href="{{ route('shop') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-12 uppercase tracking-wider transition transform hover:scale-105">
                    Shop Now
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
