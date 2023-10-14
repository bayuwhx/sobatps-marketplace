<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class AdminViewController extends Controller
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

        return view('admin.index', [
            "title" => "Semua Produk Kami" . $title,
            "active" => 'products',
            "products" => Product::latest()->filter(request(['search', 'category', 'user']))->paginate(8)->withQueryString(),
        ]);
    }
}
