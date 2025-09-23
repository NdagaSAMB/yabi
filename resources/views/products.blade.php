@extends('layouts.app')

@section('content')
<div class="px-6 py-12 mx-auto max-w-7xl">
    <h2 class="mb-8 text-3xl font-bold text-center text-gray-800">Nos Produits</h2>

    <!-- Grille des produits -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Produit 1 -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <img src="{{ asset('images/imgproduit2.jfif') }}" alt="Produit 1" class="object-cover w-full h-48 rounded-lg">
            <h3 class="mt-4 text-lg font-semibold text-gray-800">Sac élégant</h3>
            <p class="mt-2 text-gray-600">Un sac moderne et pratique pour vos sorties.</p>
            <p class="mt-2 font-bold text-pink-600">15 000 CFA</p>
            <form action="{{ route('cart.add', 1) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-500">
                    Ajouter au panier
                </button>
            </form>
        </div>

        <!-- Produit 2 -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <img src="{{ asset('images/imgproduit3.jfif') }}" alt="Produit 2" class="object-cover w-full h-48 rounded-lg">
            <h3 class="mt-4 text-lg font-semibold text-gray-800">Chaussures</h3>
            <p class="mt-2 text-gray-600">Confortables et tendances pour toutes occasions.</p>
            <p class="mt-2 font-bold text-pink-600">20 000 CFA</p>
            <form action="{{ route('cart.add', 2) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-500">
                    Ajouter au panier
                </button>
            </form>
        </div>

        <!-- Produit 3 -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <img src="{{ asset('images/imgproduit4.jfif') }}" alt="Produit 3" class="object-cover w-full h-48 rounded-lg">
            <h3 class="mt-4 text-lg font-semibold text-gray-800">Accessoires</h3>
            <p class="mt-2 text-gray-600">Ajoutez une touche d’élégance à votre style.</p>
            <p class="mt-2 font-bold text-pink-600">5 000 CFA</p>
            <form action="{{ route('cart.add', 3) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-500">
                    Ajouter au panier
                </button>
            </form>
        </div>

        <!-- Produit 4 -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <img src="{{ asset('images/imgproduit5.jfif') }}" alt="Produit 4" class="object-cover w-full h-48 rounded-lg">
            <h3 class="mt-4 text-lg font-semibold text-gray-800">Robe stylée</h3>
            <p class="mt-2 text-gray-600">Parfaite pour les grandes occasions.</p>
            <p class="mt-2 font-bold text-pink-600">25 000 CFA</p>
            <form action="{{ route('cart.add', 4) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                        class="w-full px-4 py-2 text-white bg-pink-600 rounded-lg hover:bg-pink-500">
                    Ajouter au panier
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
