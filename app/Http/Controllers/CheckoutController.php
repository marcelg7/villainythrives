<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Cart::count() == 0) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        $cartItems = Cart::content();
        $cartTotal = Cart::total();

        return view('checkout.index', compact('cartItems', 'cartTotal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'payment_method' => 'required|in:cash,etransfer',
            'notes' => 'nullable|string|max:1000',
            'shipping_address' => 'nullable|array',
            'billing_address' => 'nullable|array',
        ]);

        // Generate unique order number
        $orderNumber = 'VT-' . strtoupper(Str::random(8));

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => $orderNumber,
            'total' => str_replace(',', '', Cart::total()),
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'] ?? null,
            'shipping_address' => $validated['shipping_address'] ?? null,
            'billing_address' => $validated['billing_address'] ?? null,
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create order items
        foreach (Cart::content() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        // Clear cart
        Cart::destroy();

        return redirect()->route('order.confirmation', $order)->with('success', 'Order placed successfully!');
    }

    public function confirmation(Order $order)
    {
        $order->load('items.product');

        return view('checkout.confirmation', compact('order'));
    }
}
