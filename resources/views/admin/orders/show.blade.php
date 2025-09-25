@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">📄 Détail de la commande #{{ $order->id }}</h1>

    <div class="p-4 mb-6 bg-white rounded shadow">
        <p><strong>Nom :</strong> {{ $order->name }} {{ $order->prenom }}</p>
        <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
        <p><strong>Adresse :</strong> {{ $order->address }}</p>
        <p><strong>Paiement :</strong> {{ ucfirst($order->payment_method) }}</p>
        <p><strong>Total :</strong> {{ $order->total }} FCFA</p>
        <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <h2 class="mb-4 text-xl font-semibold">🛒 Produits commandés</h2>
    <table class="w-full border border-gray-200 rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Produit</th>
                <th class="p-3 text-left">Quantité</th>
                <th class="p-3 text-left">Prix</th>
                <th class="p-3 text-left">Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr class="border-t">
                    <td class="p-3">{{ $item->product_name }}</td>
                    <td class="p-3">{{ $item->quantity }}</td>
                    <td class="p-3">{{ $item->price }} FCFA</td>
                    <td class="p-3 font-bold">{{ $item->subtotal }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="inline-block px-4 py-2 mt-6 text-white bg-gray-600 rounded hover:bg-gray-700">
        ⬅ Retour aux commandes
    </a>
</div>
@endsection
