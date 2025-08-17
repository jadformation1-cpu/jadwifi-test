# Choisir une image PHP avec Apache déjà installé
FROM php:8.1-apache

# Copier tout le code du dépôt dans /var/www/html
COPY . /var/www/html

# Activer mod_rewrite (optionnel pour index.php)
RUN docker-php-ext-install mysqli

# Exposer le port 80
EXPOSE 80

CMD ["apache2-foreground"]
