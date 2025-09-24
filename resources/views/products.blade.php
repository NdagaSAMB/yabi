@extends('layouts.app')

@section('content')
<div class="px-6 py-12 mx-auto max-w-7xl">
    <h2 class="mb-12 text-3xl font-bold text-center text-gray-800">Nos Produits</h2>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach([
            ['image' => 'imgproduit2.jfif', 'name' => 'Sac élégant', 'desc' => 'Un sac moderne et pratique pour vos sorties.', 'price' => '15 000 CFA', 'id' => 1],
            ['image' => 'imgproduit3.jfif', 'name' => 'Chaussures', 'desc' => 'Confortables et tendances pour toutes occasions.', 'price' => '20 000 CFA', 'id' => 2],
            ['image' => 'imgproduit4.jfif', 'name' => 'Accessoires', 'desc' => 'Ajoutez une touche d’élégance à votre style.', 'price' => '5 000 CFA', 'id' => 3],
            ['image' => 'imgproduit5.jfif', 'name' => 'Robe stylée', 'desc' => 'Parfaite pour les grandes occasions.', 'price' => '25 000 CFA', 'id' => 4],
        ] as $product)
        <div class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md hover:-translate-y-2 hover:shadow-2xl">
            <div class="overflow-hidden">
                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" class="object-cover w-full h-48 transition-transform duration-300 hover:scale-105">
            </div>
            <div class="flex flex-col h-full p-6">
                <h3 class="text-lg font-semibold text-gray-800">{{ $product['name'] }}</h3>
                <p class="flex-1 mt-2 text-gray-600">{{ $product['desc'] }}</p>
                <p class="mt-2 font-bold text-pink-600">{{ $product['price'] }}</p>
                <form action="{{ route('cart.add', $product['id']) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full py-2 text-white transition-colors duration-300 bg-pink-600 rounded-lg hover:bg-pink-500">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
