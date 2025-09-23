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
        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="flex flex-col items-center p-6 text-center transition duration-300 transform bg-white shadow-lg rounded-xl hover:-translate-y-2 hover:shadow-2xl">
            <div class="flex items-center justify-center w-16 h-16 mb-4 bg-pink-100 rounded-full">
                <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" class="w-10 h-10">
            </div>
            <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
            <p class="text-gray-500">{{ $category->description }}</p>
        </a>
        @endforeach
    </div>
</section>

<!-- 3ème Partie : Produits -->
<section class="py-12 bg-white">
    <div class="max-w-6xl px-4 mx-auto">
        @if(request('category'))
            <h2 class="mb-6 text-2xl font-bold text-gray-800">
                Produits : {{ $categories->find(request('category'))->name }}
            </h2>
        @else
            <h2 class="mb-6 text-2xl font-bold text-gray-800">Produits Phares</h2>
        @endif
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($products as $product)
            <div class="relative flex flex-col overflow-hidden bg-white shadow-md rounded-xl">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-48" loading="lazy">
                <div class="flex flex-col flex-1 p-4">
                    <h3 class="mb-2 text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="mb-2 text-gray-600">{{ $product->description }}</p>
                    <div class="flex items-center gap-2 mt-auto">
                        <span class="text-xl font-bold text-gray-900">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full py-2 text-white bg-pink-500 rounded-lg hover:bg-orange-600">
                            Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
