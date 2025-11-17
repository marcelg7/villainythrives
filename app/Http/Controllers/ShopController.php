<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('active', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::where('active', true)
            ->withCount('products')
            ->get();

        return view('shop.index', compact('featuredProducts', 'categories'));
    }

    public function shop(Request $request)
    {
        $query = Product::where('active', true)->with('category');

        // Filter by search
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        match($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name' => $query->orderBy('name', 'asc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12);
        $categories = Category::where('active', true)->withCount('products')->get();

        return view('shop.shop', compact('products', 'categories'));
    }

    public function category(Category $category)
    {
        $products = $category->products()
            ->where('active', true)
            ->paginate(12);

        $categories = Category::where('active', true)->withCount('products')->get();

        return view('shop.category', compact('category', 'products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        $relatedProducts = Product::where('active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.product', compact('product', 'relatedProducts'));
    }
}
