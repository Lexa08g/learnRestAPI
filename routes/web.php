<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Katalog toko
Route::get('/', function (Request $request) {
    $categories = Category::all();
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->get();

    return view('welcome', compact('categories', 'products'));
});

// Panel admin
Route::get('/admin', function () {
    $categories = Category::all();
    return view('admin', compact('categories'));
});
