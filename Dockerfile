# Utilisez une image PHP 7 avec Apache
FROM php:7.4-apache

# Installation des dépendances nécessaires pour Symfony
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-install zip pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Configuration Apache
RUN a2enmod rewrite
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
RUN service apache2 restart

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers de l'application Symfony dans le conteneur
COPY . /var/www/html

# Installation de Composer v1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.23

# Installation des dépendances via Composer
RUN composer install --no-scripts --no-interaction

# Permissions pour les fichiers Symfony
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80

# Commande pour lancer Apache
CMD ["apache2-foreground"]