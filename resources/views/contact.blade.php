@extends('layouts.app')

@section('content')
<div class="max-w-xl p-8 mx-auto mt-12 bg-white shadow-xl rounded-2xl">
    <h2 class="mb-6 text-3xl font-bold text-center text-gray-800">Contactez-nous</h2>

    @if(session('success'))
        <div class="p-4 mb-6 font-medium text-center text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" required
                   class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required
                   class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none">
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Message</label>
            <textarea name="message" rows="5" required
                      class="w-full px-4 py-3 transition duration-200 border border-gray-300 resize-none rounded-xl focus:ring-2 focus:ring-pink-500 focus:outline-none"></textarea>
        </div>

        <button type="submit"
                class="w-full py-3 font-bold text-white transition duration-200 transform bg-pink-600 shadow-md rounded-xl hover:bg-pink-500 hover:-translate-y-1">
            Envoyer
        </button>
    </form>
</div>
@endsection
