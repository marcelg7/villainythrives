<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        $cartTotal = Cart::total();
        $cartCount = Cart::count();

        return view('cart.index', compact('cartItems', 'cartTotal', 'cartCount'));
    }

    public function add(Product $product, Request $request)
    {
        $quantity = $request->input('quantity', 1);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $quantity,
            'price' => $product->price,
            'options' => [
                'image' => $product->image_url,
                'slug' => $product->slug,
            ]
        ]);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update($rowId, Request $request)
    {
        $quantity = $request->input('quantity', 1);

        Cart::update($rowId, $quantity);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        Cart::destroy();

        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
