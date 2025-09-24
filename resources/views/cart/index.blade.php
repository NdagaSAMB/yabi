@extends('layouts.app')

@section('content')
<div class="px-6 py-12 mx-auto max-w-7xl">
    <h2 class="mb-8 text-3xl font-bold text-center text-gray-800">Votre Panier</h2>

    @if($cartItems->isEmpty())
        <p class="text-center text-gray-600">Votre panier est vide.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2">Produit</th>
                        <th class="px-4 py-2">Prix</th>
                        <th class="px-4 py-2">Quantité</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                    <tr class="border-b">
                        <td class="flex items-center gap-4 px-4 py-2">
                            <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="object-cover w-16 h-16 rounded">
                            <span>{{ $item->product->name }}</span>
                        </td>
                        <td class="px-4 py-2">{{ number_format($item->product->price, 0, ',', ' ') }} CFA</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="decrease" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                <span>{{ $item->quantity }}</span>
                                <button type="submit" name="action" value="increase" class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                            </form>
                        </td>
                        <td class="px-4 py-2 font-bold">{{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} CFA</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-500">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col items-end mt-6 space-y-4">
            <p class="text-lg font-semibold">Total : {{ number_format($total, 0, ',', ' ') }} CFA</p>

            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-500">
                    Vider le panier
                </button>
            </form>

            <a href="{{ route('checkout.index') }}" class="px-6 py-2 text-white bg-pink-600 rounded hover:bg-pink-500">
                Passer à la commande
            </a>
        </div>
    @endif
</div>
@endsection
