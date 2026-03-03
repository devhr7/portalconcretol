FROM php:8.1-apache

# Instalamos las extensiones de MySQL para PHP
RUN docker-php-ext-install pdo pdo_mysql mysqli
