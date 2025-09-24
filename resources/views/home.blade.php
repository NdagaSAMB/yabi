@extends('layouts.app')

@section('content')

<!-- 1ère Partie : Bannière -->
<section class="relative h-screen bg-center bg-cover" style="background-image: url('{{ asset('images/image-de-fonddd.JPG') }}');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center">
        <h1 class="text-4xl font-bold text-white md:text-6xl">
            Découvrez <span class="text-pink-500">Ya&Bi</span>
        </h1>
        <p class="max-w-2xl mt-4 text-lg text-gray-200 md:text-xl">
            Votre destination beauté et mode. Une sélection exclusive de produits skincare, vêtements et accessoires de luxe.
        </p>
        <div class="flex gap-4 mt-8">
            <a href="{{ route('products.index') }}" class="px-6 py-3 font-semibold text-white transition bg-pink-700 rounded-lg hover:bg-pink-600">
                Découvrir la collection
            </a>
        </div>
    </div>
</section>

<!-- 2ème Partie : Catégories cliquables -->
<section class="py-12 bg-gray-50">
    <div class="grid max-w-6xl grid-cols-1 gap-6 px-4 mx-auto sm:grid-cols-2 lg:grid-cols-4">
        @foreach($categories as $category)
        <a href="{{ route('products.index', ['category' => $category->id]) }}" 
           class="flex flex-col items-center p-6 text-center transition duration-300 transform bg-white shadow-lg rounded-xl hover:-translate-y-2 hover:shadow-2xl">

            <!-- Icône esthétique -->
            <div class="flex items-center justify-center w-16 h-16 mb-4 bg-pink-100 rounded-full">
                @switch($category->name)
                    @case('Soins visage')
                        <i class="text-3xl text-pink-600 fa-solid fa-spa"></i>
                        @break

                    @case('Chaussures')
                        <i class="text-3xl text-pink-600 fa-solid fa-shoe-prints"></i>
                        @break

                    @case('Vêtements')
                        <i class="text-3xl text-pink-600 fa-solid fa-shirt"></i>
                        @break

                    @case('Accessoires')
                        <i class="text-3xl text-pink-600 fa-solid fa-gem"></i>
                        @break

                    @default
                        <i class="text-3xl text-pink-600 fa-solid fa-box"></i>
                @endswitch
            </div>

            <!-- Nom + Description -->
            <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
            <p class="text-gray-500">{{ $category->description }}</p>
        </a>
        @endforeach
    </div>
</section>


<!-- 3ème Partie : Produits Phares-->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    @foreach($products as $product)
    <div class="flex flex-col overflow-hidden transition duration-300 transform bg-white shadow-lg rounded-xl hover:-translate-y-2 hover:shadow-2xl">
        <!-- Image avec effet hover -->
        <div class="relative overflow-hidden">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-48 transition-transform duration-300 hover:scale-105" loading="lazy">
        </div>

        <!-- Contenu -->
        <div class="flex flex-col flex-1 p-4">
            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>

            <!-- Description limitée à 3 lignes -->
            <p class="mt-2 text-gray-600 line-clamp-3">{{ $product->description }}</p>

            <!-- Prix et bouton -->
            <div class="flex flex-col gap-2 mt-auto">
                <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full py-2 text-white transition-colors duration-300 bg-pink-500 rounded-lg hover:bg-pink-600">
                        Ajouter au panier
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>


@endsection
