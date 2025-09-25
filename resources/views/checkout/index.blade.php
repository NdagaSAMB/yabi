@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <h1 class="mb-6 text-3xl font-bold text-gray-800">Passer la commande</h1>

    {{-- ✅ Message de succès ou erreur --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-200 border border-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid gap-8 lg:grid-cols-2">
        {{-- 📝 Formulaire client --}}
        <div class="p-6 bg-white rounded-lg shadow">
          <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
        <label for="name" class="block font-medium">Nom</label>
        <input type="text" name="name" id="name" required class="w-full p-2 border rounded">
    </div>

    <div>
        <label for="prenom" class="block font-medium">Prénom</label>
        <input type="text" name="prenom" id="prenom" required class="w-full p-2 border rounded">
    </div>

    <div>
        <label for="address" class="block font-medium">Adresse</label>
        <textarea name="address" id="address" required class="w-full p-2 border rounded"></textarea>
    </div>

    <div>
        <label for="phone" class="block font-medium">Téléphone</label>
        <input type="text" name="phone" id="phone" required class="w-full p-2 border rounded">
    </div>

    <div>
        <label for="payment_method" class="block font-medium">Moyen de paiement</label>
        <select name="payment_method" id="payment_method" required class="w-full p-2 border rounded">
            <option value="wave">Wave</option>
            <option value="orange_money">Orange Money</option>
            <option value="especes">Espèces</option>
        </select>
    </div>

    <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded hover:bg-pink-700">
        Valider la commande
    </button>
</form>

        </div>

        {{-- 🛒 Panier --}}
        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">Votre panier</h2>

            @if(count($cart) > 0)
                <table class="w-full text-sm border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-2 text-left">Produit</th>
                            <th class="p-2 text-center">Quantité</th>
                            <th class="p-2 text-right">Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $item)
                            <tr class="border-t">
                                <td class="p-2">{{ $item['name'] }}</td>
                                <td class="p-2 text-center">{{ $item['quantity'] }}</td>
                                <td class="p-2 text-right">{{ $item['price'] * $item['quantity'] }} FCFA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="mt-4 text-lg font-bold text-right">
                    Total : {{ $total }} FCFA
                </p>
            @else
                <p class="text-gray-500">Votre panier est vide.</p>
            @endif
        </div>
    </div>
</div>
@endsection
