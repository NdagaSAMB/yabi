# On part d'une image PHP avec FPM
FROM php:8.2-fpm

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le projet dans le conteneur
WORKDIR /var/www/html
COPY . .

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-dev

# Copier le fichier .env.example et générer la clé si le fichier .env n'existe pas
RUN if [ ! -f .env ]; then cp .env.example .env && php artisan key:generate; fi

# Exposer le port que Render utilisera
EXPOSE 10000

# Commande pour démarrer le serveur Laravel sur le port fourni par Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT
