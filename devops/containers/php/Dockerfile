FROM pttde/php:shopware6-7.4

RUN apk add --no-cache mysql-client nodejs-npm ncurses haproxy $PHPIZE_DEPS \
    && pecl install xdebug-3.0.4 \
    && rm -rf /tmp/* /var/cache/apk/* \
    && cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY haproxy.cfg /etc/haproxy/haproxy.cfg
COPY shopware-dev.ini $PHP_INI_DIR/conf.d/shopware-dev.ini
COPY wait-for-it.sh /usr/local/bin/wait-for-it.sh

# sw6 has a dependency on the package composer-runtime-api
# which is only supported by composer 2, at time of writing
# the pttde/php:shopware6-7.4 installs version 1.9,
# this following line should be deleted if the
# pttde/php:shopware6-7.4 image is switching to version 2
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir /run/haproxy

WORKDIR /app
