<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // <-- ajoute cette ligne

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Si tu veux filtrer par catégorie
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();
        $categories = Category::all(); // <-- maintenant ça fonctionne

        return view('products.index', compact('products', 'categories'));
    }
}
