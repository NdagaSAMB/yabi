@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <h1 class="mb-4 text-2xl font-bold">Passer la commande</h1>

    <h2 class="mb-2 text-xl font-semibold">Votre panier</h2>
    <ul class="mb-6">
        @foreach ($cartItems as $item)
            <li class="flex justify-between py-2 border-b">
                <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                <span>{{ number_format($item->product->price * $item->quantity, 0, ',', ' ') }} FCFA</span>
            </li>
        @endforeach
    </ul>
    <p class="mb-4 font-bold">Total : {{ number_format($total, 0, ',', ' ') }} FCFA</p>

    <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <textarea name="adresse" placeholder="Adresse" required></textarea>
    <select name="paiement" required>
        <option value="cash">Paiement à la livraison</option>
        <option value="card">Wave </option>
        <option value="card">Orange money</option>
    </select>
    <button type="submit">Valider la commande</button>
</form>

</div>
@endsection
