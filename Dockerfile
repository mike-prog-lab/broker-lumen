FROM php:7.4-fpm

ARG workdir=/var/www/html

WORKDIR $workdir

RUN set -ex; \
    \
    apt-get update; \
    apt update; \
    apt install -y --no-install-recommends git nano; \
    apt-get install -y --no-install-recommends \
        libbz2-dev \
        libfreetype6-dev \
        curl \
        libxml++2.6-dev \
        libjpeg-dev \
        libpng-dev \
        libwebp-dev \
        libxpm-dev \
        libzip-dev \
    ; \
    \
    docker-php-ext-install -j "$(nproc)" \
        pdo_mysql \
        mysqli \
        opcache \
        zip \
        gd \
    ; \
    \
    { \
        echo 'opcache.memory_consumption=128'; \
        echo 'opcache.interned_strings_buffer=8'; \
        echo 'opcache.max_accelerated_files=4000'; \
        echo 'opcache.revalidate_freq=2'; \
        echo 'opcache.fast_shutdown=1'; \
    } > $PHP_INI_DIR/conf.d/opcache-recommended.ini; \
    \
    { \
        echo 'session.cookie_httponly = 1'; \
        echo 'session.use_strict_mode = 1'; \
    } > $PHP_INI_DIR/conf.d/session-strict.ini; \
    \
    { \
        echo 'allow_url_fopen = On'; \
        echo 'max_execution_time = 300'; \
        echo 'memory_limit = 512M'; \
        echo 'post_max_size = 16M'; \
        echo 'upload_max_filesize = 16M'; \
        echo 'max_input_time = 600'; \
    } > $PHP_INI_DIR/conf.d/php-fpm-misc.ini; \
    \
    curl -s https://getcomposer.org/installer | php ; \
    mv composer.phar /usr/local/bin/composer ; \
    chmod -R 755 /usr/local/bin/composer ; \
    groupadd -g 1000 www ; \
    useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . .

USER www

RUN composer install --optimize-autoloader --no-dev

CMD ["php-fpm"]
