@extends('layouts.app')

@section('content')
<div class="max-w-4xl py-12 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Avis des clients</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Formulaire pour ajouter un avis --}}
    <div class="p-6 mb-8 border rounded-lg shadow">
        <h2 class="mb-4 text-xl font-semibold">Laisser un avis</h2>
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block">Nom</label>
                <input type="text" name="author" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-3">
                <label class="block">Note (1 à 5)</label>
                <select name="rating" class="w-full p-2 border rounded" required>
                    <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                    <option value="4">⭐⭐⭐⭐ - Très bien</option>
                    <option value="3">⭐⭐⭐ - Bien</option>
                    <option value="2">⭐⭐ - Passable</option>
                    <option value="1">⭐ - Mauvais</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block">Commentaire</label>
                <textarea name="comment" rows="4" class="w-full p-2 border rounded" required></textarea>
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Envoyer
            </button>
        </form>
    </div>

    {{-- Liste des avis --}}
    @forelse($reviews as $review)
        <div class="p-4 mb-4 border rounded shadow">
            <h3 class="font-bold">{{ $review->author }} - 
                <span class="text-yellow-500">
                    {{ str_repeat('⭐', $review->rating) }}
                </span>
            </h3>
            <p class="mt-2">{{ $review->comment }}</p>
            <p class="text-sm text-gray-500">Posté le {{ $review->created_at->format('d/m/Y à H:i') }}</p>
        </div>
    @empty
        <p>Aucun avis disponible pour le moment.</p>
    @endforelse
</div>
@endsection
