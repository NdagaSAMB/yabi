@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-100 rounded">{{ session('error') }}</div>
    @endif

    <div class="flex flex-col gap-6 lg:flex-row">
        <div class="flex-1">
            @forelse($cartItems as $item)
                <div class="flex items-center p-4 mb-4 bg-white rounded shadow">
                    <img src="{{ asset('storage/' . $item->product->image) }}" class="object-cover w-24 h-24 mr-4 rounded" alt="">
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $item->product->description }}</p>
                        <p class="mt-2 font-bold">{{ number_format($item->product->price,0,',',' ') }} FCFA</p>

                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="inline-block w-20 p-2 border rounded">
                            <button class="px-3 py-1 text-white bg-pink-600 rounded">Mettre à jour</button>
                        </form>
                    </div>

                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="px-3 py-1 text-white bg-red-500 rounded">Supprimer</button>
                    </form>
                </div>
            @empty
                <p>Votre panier est vide.</p>
            @endforelse
        </div>

        <div class="w-full p-6 bg-white rounded shadow lg:w-1/3">
            <h3 class="mb-4 font-bold">Récapitulatif</h3>
            <div class="flex justify-between mb-2">
                <span>Sous-total</span>
                <span>{{ $cartItems->sum(fn($i) => $i->product->price * $i->quantity) }} FCFA</span>
            </div>

            <form action="{{ route('checkout.store') }}" method="POST" class="mt-4 space-y-3">
                @csrf
                <input type="text" name="name" placeholder="Nom complet" required class="w-full p-2 border rounded">
                <input type="text" name="address" placeholder="Adresse" required class="w-full p-2 border rounded">
                <input type="text" name="phone" placeholder="Téléphone" required class="w-full p-2 border rounded">

                <label class="block font-medium">Paiement à la livraison</label>
                <select name="payment_method" required class="w-full p-2 border rounded">
                    <option value="wave">Wave</option>
                    <option value="orange_money">Orange Money</option>
                    <option value="especes">Espèces</option>
                </select>

                <button type="submit" class="w-full px-4 py-2 text-white bg-pink-600 rounded">Valider la commande</button>
            </form>

            <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button class="w-full px-4 py-2 text-white bg-gray-600 rounded">Vider le panier</button>
            </form>
        </div>
    </div>
</div>
@endsection
