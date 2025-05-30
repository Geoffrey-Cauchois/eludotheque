FROM php:8.2-fpm

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        intl \
        pdo \
        pdo_mysql \
        opcache \
        bcmath \
        zip \
        gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l’application
COPY composer.json composer.lock ./
RUN composer install --no-interaction --optimize-autoloader || true
COPY . .
RUN composer install --no-interaction --optimize-autoloader

# Donner les bons droits
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

# Exposer le port PHP-FPM
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]