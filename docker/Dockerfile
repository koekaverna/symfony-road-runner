#####################
### Scratch image ###
#####################
FROM php:8.2.4-cli-alpine3.17 AS scratch

RUN set -x \
    && apk add --no-cache --virtual .build-deps icu-dev \
    && docker-php-ext-install -j$(nproc) intl \
    && apk add --no-cache icu-libs \
    && apk del .build-deps

######################
### Composer image ###
######################
FROM scratch AS composer

# Setup Composer authentetication (https://getcomposer.org/doc/03-cli.md#composer-auth)
ARG COMPOSER_AUTH

ENV COMPOSER_VERSION 2.5.4
RUN set -x \
    && curl --silent --show-error --retry 5 https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION}

CMD ["composer"]

#########################
### Development image ###
#########################
FROM scratch AS development

ENV XDEBUG_VERSION 3.2.0
RUN set -x \
    && apk add --no-cache --virtual .build-deps linux-headers $PHPIZE_DEPS \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN cp ${PHP_INI_DIR}/php.ini-development ${PHP_INI_DIR}/php.ini

COPY --from=composer /usr/local/bin/composer /usr/local/bin/composer

WORKDIR /app

ENTRYPOINT ["tail", "-f", "/dev/null"]
