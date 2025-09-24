@extends('layouts.app')

@section('content')
<div class="max-w-6xl px-4 py-12 mx-auto">
    <h1 class="mb-6 text-3xl font-bold text-gray-800">Produits</h1>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($products as $product)
        <div class="relative flex flex-col overflow-hidden bg-white shadow-md rounded-xl">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-48">
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
@endsection
