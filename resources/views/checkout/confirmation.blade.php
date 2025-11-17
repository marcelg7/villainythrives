@extends('layouts.shop')

@section('title', 'Order Confirmation')

@section('content')
<div class="bg-gray-900 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-600 rounded-full mb-6">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-4xl lg:text-5xl font-black text-white uppercase mb-4">Order Confirmed!</h1>
            <p class="text-xl text-gray-300 mb-2">Thank you for your order</p>
            <p class="text-gray-400">You will receive a confirmation email shortly at <span class="text-white font-semibold">{{ $order->customer_email }}</span></p>
        </div>

        <!-- Order Details -->
        <div class="bg-gray-950 border-2 border-gray-800 mb-6">
            <div class="bg-gray-900 border-b-2 border-gray-800 p-6">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <h2 class="text-white font-black uppercase text-sm text-gray-400 mb-1">Order Number</h2>
                        <p class="text-2xl font-black text-red-500">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <h2 class="text-white font-black uppercase text-sm text-gray-400 mb-1">Order Date</h2>
                        <p class="text-white font-semibold">{{ $order->created_at->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <h2 class="text-white font-black uppercase text-sm text-gray-400 mb-1">Total</h2>
                        <p class="text-2xl font-black text-white">${{ number_format($order->total, 2) }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <h3 class="text-white font-black uppercase text-lg mb-4 border-b border-gray-800 pb-3">Order Items</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex gap-4 pb-4 border-b border-gray-800 last:border-b-0">
                            <div class="w-20 h-20 bg-gray-800 flex-shrink-0 overflow-hidden">
                                @if($item->product && $item->product->image_url)
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <img src="{{ asset('storage/images/villainy-thrives-logo.jpeg') }}" alt="{{ $item->product_name }}" class="w-10 h-10 opacity-50">
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-white font-bold mb-1">{{ $item->product_name }}</h4>
                                <p class="text-gray-400 text-sm">Quantity: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                                <p class="text-red-500 font-black mt-2">${{ number_format($item->quantity * $item->price, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Customer & Shipping Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Customer Information -->
            <div class="bg-gray-950 border-2 border-gray-800 p-6">
                <h3 class="text-white font-black uppercase text-lg mb-4 border-b border-gray-800 pb-3">Customer Information</h3>
                <div class="space-y-2 text-gray-300">
                    <p><span class="text-gray-500">Name:</span> <span class="text-white font-semibold">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</span></p>
                    <p><span class="text-gray-500">Email:</span> <span class="text-white font-semibold">{{ $order->customer_email }}</span></p>
                    <p><span class="text-gray-500">Phone:</span> <span class="text-white font-semibold">{{ $order->customer_phone }}</span></p>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="bg-gray-950 border-2 border-gray-800 p-6">
                <h3 class="text-white font-black uppercase text-lg mb-4 border-b border-gray-800 pb-3">Shipping Address</h3>
                @if($order->shipping_address)
                    <div class="text-gray-300">
                        <p class="text-white font-semibold">{{ $order->shipping_address['address_line1'] ?? '' }}</p>
                        @if(isset($order->shipping_address['address_line2']) && $order->shipping_address['address_line2'])
                            <p class="text-white">{{ $order->shipping_address['address_line2'] }}</p>
                        @endif
                        <p class="text-white">
                            {{ $order->shipping_address['city'] ?? '' }}, {{ $order->shipping_address['province'] ?? '' }} {{ $order->shipping_address['postal_code'] ?? '' }}
                        </p>
                        <p class="text-white">{{ $order->shipping_address['country'] ?? '' }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="bg-gray-950 border-2 border-red-600 p-6 mb-6">
            <h3 class="text-white font-black uppercase text-lg mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Payment Instructions
            </h3>

            @if($order->payment_method === 'etransfer')
                <div class="bg-gray-900 border border-gray-800 p-4 mb-4">
                    <p class="text-white font-bold uppercase text-sm mb-3">E-Transfer Payment</p>
                    <div class="space-y-2 text-gray-300 text-sm">
                        <p><span class="text-gray-500">1.</span> Send an Interac e-Transfer to: <span class="text-red-500 font-bold">payments@villainythrives.com</span></p>
                        <p><span class="text-gray-500">2.</span> Amount: <span class="text-white font-black">${{ number_format($order->total, 2) }} CAD</span></p>
                        <p><span class="text-gray-500">3.</span> Include your order number in the message: <span class="text-white font-mono">{{ $order->order_number }}</span></p>
                        <p><span class="text-gray-500">4.</span> Your order will be processed once payment is received</p>
                    </div>
                </div>
            @elseif($order->payment_method === 'cash')
                <div class="bg-gray-900 border border-gray-800 p-4 mb-4">
                    <p class="text-white font-bold uppercase text-sm mb-3">Cash on Delivery</p>
                    <div class="space-y-2 text-gray-300 text-sm">
                        <p><span class="text-gray-500">•</span> Please have <span class="text-white font-black">${{ number_format($order->total, 2) }} CAD</span> ready for the driver</p>
                        <p><span class="text-gray-500">•</span> We will contact you to arrange delivery</p>
                        <p><span class="text-gray-500">•</span> Exact change is appreciated</p>
                    </div>
                </div>
            @endif

            <p class="text-gray-400 text-xs">If you have any questions about your order or payment, please contact us at <a href="mailto:support@villainythrives.com" class="text-red-500 hover:text-red-400">support@villainythrives.com</a></p>
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-4">
            <a href="{{ route('shop') }}"
               class="inline-block bg-red-600 hover:bg-red-700 text-white font-bold py-4 px-12 uppercase tracking-wider transition transform hover:scale-105">
                Continue Shopping
            </a>
            <p class="text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white transition">Return to Home</a>
            </p>
        </div>

        <!-- Support Section -->
        <div class="mt-12 bg-black border-2 border-gray-800 p-8 text-center">
            <h3 class="text-white font-black uppercase text-xl mb-3">Thank You for Choosing Loyalty</h3>
            <p class="text-gray-400 mb-2">Your support means everything to us.</p>
            <p class="text-red-500 font-black uppercase tracking-wider text-xl">🔨 Villainy Thrives 🔨</p>
        </div>
    </div>
</div>
@endsection
