@extends('layouts.app')

@section('content')
<div class="max-w-3xl px-6 py-12 mx-auto">
    <h2 class="mb-6 text-2xl font-bold">Valider votre commande</h2>

    <form action="{{ route('checkout.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="block">Nom complet</label>
        <input type="text" name="name" class="w-full p-2 border rounded" required>
    </div>
    <div class="mb-3">
        <label class="block">Adresse</label>
        <input type="text" name="address" class="w-full p-2 border rounded" required>
    </div>
    <div class="mb-3">
        <label class="block">Téléphone</label>
        <input type="text" name="phone" class="w-full p-2 border rounded" required>
    </div>

    <button type="submit" class="px-4 py-2 text-white bg-pink-600 rounded hover:bg-pink-700">
        Confirmer la commande
    </button>
</form>

</div>
@endsection
