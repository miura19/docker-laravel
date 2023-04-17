FROM php:8.0-fpm

ENV TZ Asia/Tokyo

RUN apt-get update \
    && apt-get install -y git unzip libzip-dev libicu-dev libonig-dev \
    && docker-php-ext-install intl pdo_mysql zip bcmath\
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./docker/app/php.ini /usr/local/etc/php/php.ini
# COPY ./docker/app/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

# Node.jsのインストール
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# npmパッケージのインストール
RUN npm install -g npm

WORKDIR /app
