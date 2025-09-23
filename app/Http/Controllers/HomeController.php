<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review; // N'oublie pas d'importer le modèle Review

class HomeController extends Controller
{
    // Page d'accueil
    public function index()
    {
        $categories = Category::all(); // Récupère toutes les catégories
        $products = Product::all();     // Récupère tous les produits

        return view('home', compact('categories', 'products'));
    }

    // Page des avis
    public function reviews()
    {
        $reviews = Review::all(); // Récupère tous les avis depuis la base de données
        return view('reviews.index', compact('reviews'));
    }
}
