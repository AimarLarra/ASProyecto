# Dockerfile

# Utiliza la imagen oficial de httpd:latest como base
FROM php:8.0-apache

USER root
RUN chmod 755 .
RUN docker-php-ext-install mysqli
# Copia los archivos desde ./frontend al directorio /var/www/html del contenedor
COPY . /var/www/html

