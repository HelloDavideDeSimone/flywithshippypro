FROM php:7.4.22-fpm-alpine3.14

LABEL maintainer="Davide De Simone <deda34grix@gmail.com>"

RUN set -xe \
    # DEPS
    && apk add --no-cache --virtual .php-ext-build-deps $PHPIZE_DEPS \
    && docker-php-source extract \
    \
    # BCMATH
    && docker-php-ext-install -j$(nproc) bcmath \
    \
    # GD
    && apk add --no-cache freetype jpeg libjpeg-turbo libpng libwebp \
    && apk add --no-cache freetype-dev jpeg-dev libjpeg-turbo-dev libpng-dev libwebp-dev \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && apk del freetype-dev jpeg-dev libjpeg-turbo-dev libpng-dev libwebp-dev \
    \
    # IMAGICK
    && apk add --no-cache imagemagick libgomp \
    && apk add --no-cache imagemagick-dev libtool \
    && export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    && pecl install -o -f imagick-3.5.1 \
    && docker-php-ext-enable imagick \
    && apk del imagemagick-dev \
    \
    # MYSQL
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql mysqli \
    \
    # OPCACHE
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install -j$(nproc) opcache \
    && { \
       echo 'opcache.memory_consumption=128'; \
       echo 'opcache.interned_strings_buffer=8'; \
       echo 'opcache.max_accelerated_files=4000'; \
       echo 'opcache.revalidate_freq=2'; \
       echo 'opcache.fast_shutdown=1'; \
    } > "$PHP_INI_DIR/conf.d/opcache-recommended.ini" \
    \
    # XSL
    && apk add --no-cache libxslt libxslt-dev libgcrypt-dev \
    && docker-php-ext-install -j$(nproc) xsl \
    && apk del libxslt-dev \
    \
    # ZIP
    && apk add --no-cache libzip libzip-dev \
    && docker-php-ext-install -j$(nproc) zip \
    && apk del libzip-dev \
    \
    ### CLEANUP
    && mkdir -p /tmp/pear/cache \
    && pecl clear-cache \
    && docker-php-source delete \
    && apk del .php-ext-build-deps \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/* \
    && rm -rf /usr/share/php7

RUN echo "memory_limit=-1" > "$PHP_INI_DIR/conf.d/memory-limit.ini"
RUN echo "date.timezone=${PHP_TIMEZONE:-UTC}" > "$PHP_INI_DIR/conf.d/date_timezone.ini"

# WAIT
COPY resources/wait-2.7.3 /usr/bin/wait

# COMPOSER
RUN apk add --no-cache git unzip
COPY resources/composer-2.1.5 /usr/local/bin/composer

# USERS
ARG UID='1000'
ARG GID='1000'
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories \
    && apk --no-cache add shadow \
    && usermod -u ${UID} www-data \
    && apk del shadow
USER www-data

WORKDIR /api
