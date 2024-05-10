FROM php:8.2-fpm-alpine

ARG USER
ARG XDEBUG_PORT

# Install dependencies
RUN apk add --update linux-headers
RUN apk --no-cache add \
    git \
    unzip \
    libzip-dev \
    $PHPIZE_DEPS \
    && docker-php-ext-install zip pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# XDEBUG
RUN echo "error_reporting = E_ALL"                      >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "display_startup_errors = On"               >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "display_errors = On"                       >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode = debug"                       >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes"             >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port = $XDEBUG_PORT"         >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# ADD AN USER
RUN adduser -S $USER
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow && usermod -u 1000 -s /bin/sh $USER
RUN addgroup $USER && addgroup $USER $USER && addgroup root $USER

# Start PHP-FPM
CMD ["php-fpm"]
