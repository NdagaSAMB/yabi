@extends('layouts.app')

@section('content')
<div class="max-w-4xl px-6 py-12 mx-auto">
    <h2 class="mb-6 text-2xl font-bold">Votre Panier</h2>

    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 text-left">Produit</th>
                    <th class="p-2 text-left">Prix</th>
                    <th class="p-2 text-left">Quantité</th>
                    <th class="p-2 text-left">Total</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr class="border-t">
                        <td class="flex items-center gap-3 p-2">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" class="object-cover w-16 h-16 rounded">
                            {{ $item['name'] }}
                        </td>
                        <td class="p-2">{{ $item['price'] }} FCFA</td>
                        <td class="p-2">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <button type="submit" name="action" value="decrease" class="px-2 bg-gray-300 rounded hover:bg-gray-400">-</button>
                                <span>{{ $item['quantity'] }}</span>
                                <button type="submit" name="action" value="increase" class="px-2 bg-gray-300 rounded hover:bg-gray-400">+</button>
                            </form>
                        </td>
                        <td class="p-2">{{ $item['price'] * $item['quantity'] }} FCFA</td>
                        <td class="p-2">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">
                                    Retirer
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="font-bold border-t">
                    <td colspan="3" class="p-2 text-right">Total :</td>
                    <td colspan="2" class="p-2">{{ $total }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <!-- Bouton vider panier -->
        <div class="mt-4 text-right">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">
                    Vider le panier
                </button>
            </form>
        </div>
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>

<div class="flex justify-between mt-4">
    <form action="{{ route('cart.clear') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 text-white bg-gray-600 rounded hover:bg-gray-700">
            Vider le panier
        </button>
    </form>

    <a href="{{ route('checkout.index') }}" 
       class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
        Passer la commande
    </a>
</div>

@endsection
