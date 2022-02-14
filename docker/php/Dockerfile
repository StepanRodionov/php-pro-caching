FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
	    libmemcached-dev \
	    libmemcached-tools \
        libzip-dev \
        zip \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
        && pecl install memcached \
        && docker-php-ext-enable memcached \
        && pecl install -o -f redis \
        && docker-php-ext-enable redis

WORKDIR /var/www
VOLUME /var/www
RUN chown www-data:www-data /var/www

CMD ["php-fpm"]