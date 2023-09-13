#####################
### Scratch image ###
#####################
FROM php:8.2.10-cli-alpine3.18 AS scratch

RUN set -x \
    && apk add --no-cache --virtual .build-deps icu-dev linux-headers \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) sockets \
    && apk add --no-cache icu-libs \
    && apk del .build-deps

######################
### Composer image ###
######################
FROM scratch AS composer

# Setup Composer authentetication (https://getcomposer.org/doc/03-cli.md#composer-auth)
ARG COMPOSER_AUTH

ENV COMPOSER_VERSION 2.6.2
RUN set -x \
    && curl --silent --show-error --retry 5 https://getcomposer.org/installer \
        | php -- --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION}

CMD ["composer"]

#########################
### Development image ###
#########################
FROM scratch AS development

ARG APP_UID

ENV XDEBUG_VERSION 3.2.2
RUN set -x \
    && apk add --no-cache --virtual .build-deps linux-headers $PHPIZE_DEPS \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    && apk del -f .build-deps
COPY php/ /usr/local/etc/php/

RUN cp ${PHP_INI_DIR}/php.ini-development ${PHP_INI_DIR}/php.ini

COPY --from=composer /usr/local/bin/composer /usr/local/bin/composer

COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

WORKDIR /app

RUN adduser -S app -u $APP_UID
USER app

ENTRYPOINT ["start-container"]
