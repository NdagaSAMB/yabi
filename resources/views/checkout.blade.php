@extends('layouts.app')

@section('content')
<div class="container p-4 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Passer la commande</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="name">Nom:</label>
            <input type="text" name="name" id="name" class="w-full p-2 border" required>
        </div>
        <div class="mb-2">
            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" id="prenom" class="w-full p-2 border" required>
        </div>
        <div class="mb-2">
            <label for="adresse">Adresse:</label>
            <textarea name="adresse" id="adresse" class="w-full p-2 border" required></textarea>
        </div>
        <div class="mb-2">
            <label for="paiement">Moyen de paiement:</label>
            <select name="paiement" id="paiement" class="w-full p-2 border" required>
                <option value="livraison">Paiement à la livraison</option>
                <option value="wave">Wave</option>
                <option value="om">Orane Money</option>
            </select>
        </div>
        <button type="submit" class="p-2 text-white bg-blue-500 rounded">Valider la commande</button>
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
