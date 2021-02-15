FROM php:8.0-alpine

RUN apk update && \
    apk add autoconf build-base oniguruma-dev && \
    pecl install -o -f xdebug && \
    docker-php-ext-install pdo_mysql mysqli mbstring && \
    docker-php-ext-enable xdebug

ENV TZ Asia/Tokyo
RUN apk add --no-cache tzdata && \
    cp /usr/share/zoneinfo/${TZ} /etc/localtime && \
    echo ${TZ} > /etc/timezone && \
    apk del tzdata

WORKDIR /var/www

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
RUN mkdir -p vendor/bin
ENV PATH /var/www/vendor/bin:${PATH}
