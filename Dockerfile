FROM php:8.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid
# Proxy
ARG http_proxy
ARG https_proxy
ARG no_proxy
# ENV http_proxy=http://10.167.16.21:80
# ENV https_proxy=http://10.167.16.21:80
# ENV no_proxy="localhost, *.bvv.bayern.de, *.blva.bayern.de, *.lvg.bayern.de, *.bybn"

ARG DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential apt-utils dialog  \
    git \
    curl \
    vim \
    locales \
    libpng-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    npm \
    libpq-dev \
    libldap2-dev ldap-utils

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd ldap

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x  | bash -
RUN apt remove -y nodejs nodejs-doc
RUN apt-get -y install nodejs
RUN npm install -g npm@latest

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u ${uid} -d /home/${user} ${user}
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# APP-Dateien in das Image kopieren
COPY --chown=${user}:www-data ./www /var/www
COPY --chown=${user}:www-data ./.env /var/www/.env

# Set working directory
WORKDIR /var/www


# Laravel einrichten
# # RUN echo ${http_proxy}
RUN composer update
RUN php artisan key:generate
RUN npm install

# RUN composer require laravel-frontend-presets/tailwindcss --dev
# RUN php artisan ui tailwindcss --auth
# RUN npm install && npm run dev
# # RUN php artisan migrate
# # RUN php artisan serve

USER $user


# CMD ["php-fpm"]