<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class WebProductController extends Controller
{
    public function index()
    {
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' Dalam Kategori ' . $category->category_name;
        }

        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = ' Oleh Produsen ' . $user->name;
        }

        return view('products', [
            "title" => "Jelajahi Semua Produk Kami" . $title,
            "active" => 'products',
            "products" => Product::latest()->filter(request(['search', 'category', 'user']))->paginate(8)->withQueryString(),

        ]);
    }

    public function show(Product $product)
    {
        return view('product', [
            "title" => "Products",
            "active" => 'products',
            "product" => $product,
        ]);
    }

    public function purchase(Product $product)
    {
        return view('transaction.purchase', [
            "title" => "Products",
            "active" => 'products',
            "product" => $product,
        ]);
    }
}
