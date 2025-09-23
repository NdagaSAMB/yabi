@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <h1 class="mb-6 text-3xl font-bold text-gray-800">Votre Panier</h1>

    @if($cartItems->isEmpty())
        <p class="text-lg text-gray-600">Votre panier est vide.</p>
    @else
        <div class="flex flex-col gap-6 lg:flex-row">
            <!-- Liste des produits -->
            <div class="flex-1 space-y-4">
                @foreach($cartItems as $item)
                    <div class="flex flex-col items-center p-4 transition bg-white rounded-lg shadow md:flex-row hover:shadow-lg">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="object-cover w-32 h-32 mb-4 rounded-lg md:mb-0 md:mr-4">
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold text-gray-700">{{ $item->product->name }}</h2>
                            @if($item->product->description)
                                <p class="text-sm text-gray-500">{{ $item->product->description }}</p>
                            @endif
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center mt-2 space-x-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-20 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-400">
                                <button type="submit" class="px-3 py-1 text-white transition bg-pink-600 rounded shadow hover:bg-pink-700">Mettre à jour</button>
                            </form>
                        </div>
                        <div class="flex flex-col items-end mt-4 md:mt-0">
                            <span class="mb-2 font-semibold text-gray-800">{{ $item->product->price * $item->quantity }} FCFA</span>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-white transition bg-red-500 rounded shadow hover:bg-red-600">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Récapitulatif -->
            <div class="p-6 space-y-4 bg-white rounded-lg shadow lg:w-1/3">
                <h2 class="text-xl font-bold text-gray-700">Récapitulatif</h2>
                <div class="flex justify-between text-gray-700">
                    <span>Sous-total</span>
                    <span>{{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }} FCFA</span>
                </div>
                <div class="flex justify-between text-gray-700">
                    <span>Livraison</span>
                    <span>0 FCFA</span>
                </div>
                <div class="flex justify-between text-lg font-bold text-gray-800">
                    <span>Total</span>
                    <span>{{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }} FCFA</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="block px-6 py-3 text-center text-white transition bg-pink-600 rounded shadow hover:bg-pink-700">Passer à la caisse</a>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-6 py-2 mt-2 text-white transition bg-red-500 rounded shadow hover:bg-red-600">Vider le panier</button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
