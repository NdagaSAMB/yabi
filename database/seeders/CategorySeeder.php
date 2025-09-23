<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Skincare', 'icon' => 'fa-solid fa-spa']);
        Category::create(['name' => 'Vêtements', 'icon' => 'fa-solid fa-tshirt']);
        Category::create(['name' => 'Chaussures', 'icon' => 'fa-solid fa-shoe-prints']);
        Category::create(['name' => 'Accessoires', 'icon' => 'fa-solid fa-gem']);
    }
}
