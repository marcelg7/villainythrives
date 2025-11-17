<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,etransfer',
            'notes' => 'nullable|string|max:1000',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        // Generate unique order number
        $orderNumber = 'VT-' . strtoupper(Str::random(8));

        // Prepare shipping address
        $shippingAddress = [
            'address_line1' => $validated['address_line1'],
            'address_line2' => $validated['address_line2'] ?? null,
            'city' => $validated['city'],
            'province' => $validated['province'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
        ];

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => $orderNumber,
            'total' => str_replace(',', '', Cart::total()),
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'customer_first_name' => $validated['first_name'],
            'customer_last_name' => $validated['last_name'],
            'customer_email' => $validated['email'],
            'customer_phone' => $validated['phone'],
            'shipping_address' => $shippingAddress,
            'billing_address' => $shippingAddress, // Same as shipping for now
            'notes' => $validated['notes'] ?? null,
        ]);

        // Create order items
        foreach (Cart::content() as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'product_name' => $item->name,
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        // Send order confirmation email
        Mail::to($order->customer_email)->send(new OrderConfirmation($order));

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
