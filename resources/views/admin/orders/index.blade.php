@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <h1 class="mb-6 text-2xl font-bold text-gray-800">📦 Liste des commandes</h1>

    <table class="w-full border border-gray-200 rounded shadow">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">#</th>
                <th class="p-3 text-left">Nom & Prénom</th>
                <th class="p-3 text-left">Téléphone</th>
                <th class="p-3 text-left">Paiement</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr class="border-t">
                    <td class="p-3">{{ $order->id }}</td>
                    <td class="p-3">{{ $order->name }} {{ $order->prenom }}</td>
                    <td class="p-3">{{ $order->phone }}</td>
                    <td class="p-3 capitalize">{{ $order->payment_method }}</td>
                    <td class="p-3 font-bold">{{ $order->total }} FCFA</td>
                    <td class="p-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">Voir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
