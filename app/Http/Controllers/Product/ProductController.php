<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($fuel = null)
    {
        return view('product::index', [
            'title' => 'Каталог',
            'fuel' => $fuel
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product::show', [
            'title' => $product->meta_title ?? $product->title,
            'product' => $product
        ]);
    }

    public function search(Request $request)
    {
        $products = Product::latest()
            ->whereLike('title', "%{$request->search}%")
            ->where('is_active', true)
            ->get();
        return view('product::search', [
            'title' => 'Результаты поиска',
            'products' => $products
        ]);
    }
}
