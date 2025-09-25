@extends('layouts.app')

@section('content')
<div class="container p-4 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Passer la commande</h1>
<form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
    @csrf
    <input type="text" name="name" placeholder="Nom complet" required class="w-full p-2 border rounded">
    <input type="text" name="address" placeholder="Adresse" required class="w-full p-2 border rounded">
    <input type="text" name="phone" placeholder="Téléphone" required class="w-full p-2 border rounded">

    <label class="block mt-2 font-semibold">Moyen de paiement</label>
    <select name="payment_method" required class="w-full p-2 border rounded">
        <option value="wave">Wave</option>
        <option value="orange_money">Orange Money</option>
        <option value="especes">Espèces</option>
    </select>

    <button type="submit" class="w-full px-4 py-2 text-white bg-pink-600 rounded hover:bg-pink-700">
        Valider ma commande
    </button>
</form>


    <h2 class="mt-6 text-xl font-semibold">Panier</h2>

    @php
        $cart = session('cart', []);
        $total = 0;
    @endphp

    @if(count($cart) > 0)
        <ul>
            @foreach($cart as $item)
                <li>{{ $item['name'] }} x {{ $item['quantity'] }} - {{ $item['price'] * $item['quantity'] }} FCFA</li>
                @php $total += $item['price'] * $item['quantity']; @endphp
            @endforeach
        </ul>
        <p class="mt-2 font-bold">Total: {{ $total }} FCFA</p>
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>
@endsection
