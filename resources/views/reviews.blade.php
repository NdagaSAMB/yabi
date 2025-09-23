@extends('layouts.app')

@section('content')
<div class="max-w-4xl px-6 py-12 mx-auto">
    <h2 class="mb-8 text-3xl font-bold text-center text-gray-800">Avis des clients</h2>

    <!-- Liste des avis -->
    <div class="space-y-6">
        <!-- Exemple d'avis -->
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Fatou S.</h3>
                <div class="flex text-yellow-400">
                    ⭐⭐⭐⭐⭐
                </div>
            </div>
            <p class="mt-2 text-gray-600">Super boutique ! Les produits sont de bonne qualité et la livraison rapide.</p>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Mamadou D.</h3>
                <div class="flex text-yellow-400">
                    ⭐⭐⭐⭐☆
                </div>
            </div>
            <p class="mt-2 text-gray-600">Très satisfait, je recommande Ya&Bi. Peut-être ajouter plus de choix de couleurs.</p>
        </div>
    </div>

    <!-- Formulaire pour laisser un avis -->
    <div class="p-6 mt-12 rounded-lg shadow bg-gray-50">
        <h3 class="mb-4 text-xl font-semibold text-gray-800">Laissez votre avis</h3>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" required
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Votre avis</label>
                <textarea name="review" rows="3" required
                          class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Note</label>
                <select name="rating" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                    <option value="4">⭐⭐⭐⭐ - Très bien</option>
                    <option value="3">⭐⭐⭐ - Bien</option>
                    <option value="2">⭐⭐ - Moyen</option>
                    <option value="1">⭐ - Mauvais</option>
                </select>
            </div>
            <button type="submit"
                    class="px-6 py-3 font-semibold text-white bg-pink-600 rounded-lg hover:bg-pink-500">
                Envoyer
            </button>
        </form>
    </div>
</div>
@endsection
