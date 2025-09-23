<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   public function index(Request $request)
{
    $query = Product::query();

    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->get();
    $categories = Category::all(); // utile si tu veux afficher la liste des catégories sur la page produits

    return view('products.index', compact('products', 'categories'));
}

    
}
