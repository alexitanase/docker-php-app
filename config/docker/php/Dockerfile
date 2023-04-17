FROM php:7.4.1-fpm-alpine

# INSTALLAZIONE DIPENDENZE
RUN apk add --no-cache --update \
        $PHPIZE_DEPS \
        git \
        wget \
        nano \
        autoconf \
        busybox-extras \
        gcc \
        make \
        g++ \
        zlib-dev \
        libzip-dev \
        php7-mysqli \
        php7-pdo \
        libxml2-dev \
        libmemcached-dev \
        freetype \
        freetype-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
        libpng \
        libpng-dev \
        oniguruma-dev

RUN docker-php-ext-install \
    mbstring \
    pdo \
    pdo_mysql \
    mysqli \
    bcmath \
    zip \
    soap \
    pcntl \
    sockets \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) gd

# MEMCACHED
#RUN set -ex \
#    && MEMCACHED="`mktemp -d`" \
#    && curl -skL https://github.com/php-memcached-dev/php-memcached/archive/master.tar.gz | tar zxf - --strip-components 1 -C $MEMCACHED \
#    && docker-php-ext-configure $MEMCACHED \
#    && docker-php-ext-install $MEMCACHED \
#    && rm -rf $MEMCACHED

RUN apk --no-cache add \
    icu-dev \
    gettext \
    gettext-dev

RUN docker-php-ext-configure intl \
    && docker-php-ext-configure gettext \
    && docker-php-ext-install \
    intl \
    gettext


# Install language pack
RUN apk --no-cache add ca-certificates wget && \
    wget -q -O /etc/apk/keys/sgerrand.rsa.pub https://alpine-pkgs.sgerrand.com/sgerrand.rsa.pub && \
    wget https://github.com/sgerrand/alpine-pkg-glibc/releases/download/2.25-r0/glibc-2.25-r0.apk && \
    wget https://github.com/sgerrand/alpine-pkg-glibc/releases/download/2.25-r0/glibc-bin-2.25-r0.apk && \
    wget https://github.com/sgerrand/alpine-pkg-glibc/releases/download/2.25-r0/glibc-i18n-2.25-r0.apk && \
    apk add glibc-bin-2.25-r0.apk glibc-i18n-2.25-r0.apk glibc-2.25-r0.apk

RUN echo en_US.UTF-8 UTF-8 >> /etc/locale.gen

RUN /usr/glibc-compat/bin/localedef -i en_US -f UTF-8 en_US.UTF-8

# XDEBUG
RUN pecl install xdebug-2.9.0
RUN docker-php-ext-enable xdebug



ENV XDEBUGINI_PATH=/usr/local/etc/php/conf.d/xdebug.ini
COPY ./config/docker/php/xdebug.ini /tmp/xdebug.ini
RUN cat /tmp/xdebug.ini >> $XDEBUGINI_PATH
RUN echo "" >> $XDEBUGINI_PATH

#COMPOSER
WORKDIR /app
#COPY --from=composer:1.9 /usr/bin/composer /usr/bin/composer
#ADD composer.json /app/