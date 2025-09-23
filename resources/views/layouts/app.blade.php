<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya&Bi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen"> 
    <!-- Navbar -->
    <nav class="bg-gray-100 shadow-md">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 text-xl font-bold text-pink-600">
                    Ya&Bi
                </div>

                <!-- Menu -->
                <div class="hidden space-x-6 md:flex">
                    <a href="/" class="text-gray-700 transition duration-300 hover:text-pink-600">Accueil</a>
                    <a href="/products" class="text-gray-700 transition duration-300 hover:text-pink-600">Produits</a>
                    <a href="/cart" class="text-gray-700 transition duration-300 hover:text-pink-600">Panier</a>
                    <a href="/contact" class="text-gray-700 transition duration-300 hover:text-pink-600">Contact</a>
                    <a href="/reviews" class="text-gray-700 transition duration-300 hover:text-pink-600">Avis</a>
                </div>

                <!-- Hamburger pour mobile -->
                <div class="md:hidden">
                    <button id="menu-btn" class="text-gray-700 focus:outline-none">
                        &#9776;
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden px-4 pt-2 pb-4 space-y-2 bg-gray-100 md:hidden">
            <a href="/" class="block text-gray-700 transition duration-300 hover:text-pink-600">Accueil</a>
            <a href="/products" class="block text-gray-700 transition duration-300 hover:text-pink-600">Produits</a>
            <a href="/cart" class="block text-gray-700 transition duration-300 hover:text-pink-600">Panier</a>
            <a href="/contact" class="block text-gray-700 transition duration-300 hover:text-pink-600">Contact</a>
            <a href="/reviews" class="block text-gray-700 transition duration-300 hover:text-pink-600">Avis</a>
        </div>
    </nav>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

    <!-- Contenu -->
    <main class="flex-grow px-6 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-4 text-center bg-gray-100">
        <p>&copy; 2025 Ya&Bi - Tous droits réservés</p>
    </footer>
</body>
</html>
