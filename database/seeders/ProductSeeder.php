<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create(['name' => 'Sérum Vitamine C', 'description' => 'Soin visage', 'price' => 13500, 'image' => 'produit-1.jpg', 'category_id' => 1]);
        Product::create(['name' => 'Crème Hydratante', 'description' => 'Peau douce', 'price' => 12000, 'image' => 'produit-2.jpg', 'category_id' => 1]);
        Product::create(['name' => 'Huile Essentielle', 'description' => 'Bio & Naturelle', 'price' => 1000, 'image' => 'produit-3.jpg', 'category_id' => 1]);
        Product::create(['name' => 'Masque Réparateur', 'description' => 'Répare & hydrate', 'price' => 5000, 'image' => 'produit-4.jpg', 'category_id' => 1]);
    }
}
