# Accepted values: 8.4 - 8.2
ARG PHP_VERSION=8.4
ARG COMPOSER_VERSION=latest

###########################################
# Install Composer dependencies
###########################################

FROM composer:${COMPOSER_VERSION} as vendor

ENV ROOT=/var/www/html

WORKDIR ${ROOT}

COPY composer.* ./

ARG FLUX_USERNAME
ARG FLUX_LICENSE_KEY

RUN composer config http-basic.composer.fluxui.dev ${FLUX_USERNAME} ${FLUX_LICENSE_KEY} && composer install \
    --no-dev \
    --no-interaction \
    --no-autoloader \
    --no-ansi \
    --no-scripts \
    --ignore-platform-reqs \
    --audit


###########################################
# Build frontend assets with npm
###########################################

FROM node:lts-jod AS build

ENV ROOT=/var/www/html

WORKDIR ${ROOT}

COPY --link package.json package-lock.json* ./
COPY --from=vendor ${ROOT}/vendor ./vendor

RUN npm ci

COPY --link . .

RUN npm run build

###########################################

FROM dunglas/frankenphp:php${PHP_VERSION}-alpine

ARG WWWUSER=1000
ARG WWWGROUP=1000
ARG TZ=CET
ARG APP_DIR=/var/www/html

ENV TERM=xterm-color \
    WITH_HORIZON=false \
    WITH_SCHEDULER=false \
    OCTANE_SERVER=frankenphp \
    USER=octane \
    ROOT=${APP_DIR} \
    COMPOSER_FUND=0 \
    COMPOSER_MAX_PARALLEL_HTTP=24 \
    XDG_CONFIG_HOME=${APP_DIR}/.config \
    XDG_DATA_HOME=${APP_DIR}/.data

WORKDIR ${ROOT}

SHELL ["/bin/sh", "-eou", "pipefail", "-c"]

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone

RUN apk update; \
    apk upgrade; \
    apk add --no-cache \
    curl \
    wget \
    nano \
    git \
    ncdu \
    procps \
    supervisor \
    libsodium-dev \
    # Install PHP extensions (included with dunglas/frankenphp)
    && install-php-extensions \
    bz2 \
    pcntl \
    bcmath \
    sockets \
    pdo_pgsql \
    opcache \
    excimer \
    exif \
    zip \
    intl \
    gd \
    redis \
    memcached \
    igbinary \
    && docker-php-source delete \
    && rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

RUN arch="$(apk --print-arch)" \
    && case "$arch" in \
    armhf) _cronic_fname='supercronic-linux-arm' ;; \
    aarch64) _cronic_fname='supercronic-linux-arm64' ;; \
    x86_64) _cronic_fname='supercronic-linux-amd64' ;; \
    x86) _cronic_fname='supercronic-linux-386' ;; \
    *) echo >&2 "error: unsupported architecture: $arch"; exit 1 ;; \
    esac \
    && wget -q "https://github.com/aptible/supercronic/releases/download/v0.2.29/${_cronic_fname}" \
    -O /usr/bin/supercronic \
    && chmod +x /usr/bin/supercronic \
    && mkdir -p /etc/supercronic \
    && echo "*/1 * * * * php ${ROOT}/artisan schedule:run --no-interaction" > /etc/supercronic/laravel

RUN addgroup -g ${WWWGROUP} ${USER} \
    && adduser -D -h ${ROOT} -G ${USER} -u ${WWWUSER} -s /bin/sh ${USER}

RUN mkdir -p /var/log/supervisor /var/run/supervisor \
    && chown -R ${USER}:${USER} ${ROOT} /var/log /var/run \
    && chmod -R a+rw ${ROOT} /var/log /var/run

RUN cp ${PHP_INI_DIR}/php.ini-production ${PHP_INI_DIR}/php.ini

USER ${USER}

COPY --link --chown=${USER}:${USER} --from=vendor /usr/bin/composer /usr/bin/composer
COPY --link --chown=${USER}:${USER} composer.json composer.lock ./

ARG FLUX_USERNAME
ARG FLUX_LICENSE_KEY

RUN composer config http-basic.composer.fluxui.dev ${FLUX_USERNAME} ${FLUX_LICENSE_KEY} && composer install \
    --no-dev \
    --no-interaction \
    --no-autoloader \
    --no-ansi \
    --no-scripts \
    --audit

COPY --link --chown=${USER}:${USER} . .
COPY --link --chown=${USER}:${USER} --from=build ${ROOT}/public public

RUN mkdir -p \
    storage/framework/sessions \
    storage/framework/views \
    storage/framework/cache \
    storage/framework/testing \
    storage/logs \
    bootstrap/cache && chmod -R a+rw storage

COPY --link --chown=${USER}:${USER} deployment/supervisord.conf /etc/supervisor/
COPY --link --chown=${USER}:${USER} deployment/octane/FrankenPHP/supervisord.frankenphp.conf /etc/supervisor/conf.d/
COPY --link --chown=${USER}:${USER} deployment/supervisord.*.conf /etc/supervisor/conf.d/
COPY --link --chown=${USER}:${USER} deployment/start-container /usr/local/bin/start-container
COPY --link --chown=${USER}:${USER} deployment/healthcheck /usr/local/bin/healthcheck
COPY --link --chown=${USER}:${USER} deployment/php.ini ${PHP_INI_DIR}/conf.d/99-octane.ini

# FrankenPHP embedded PHP configuration
COPY --link --chown=${USER}:${USER} deployment/php.ini /lib/php.ini

RUN composer install \
    --classmap-authoritative \
    --no-interaction \
    --no-ansi \
    --no-dev \
    && composer clear-cache

RUN chmod +x /usr/local/bin/start-container /usr/local/bin/healthcheck

RUN cat deployment/utilities.sh >> ~/.bashrc

EXPOSE 8000
EXPOSE 443
EXPOSE 443/udp
EXPOSE 2019

ENTRYPOINT ["start-container"]

HEALTHCHECK --start-period=15s --interval=5s --timeout=10s --retries=20 CMD healthcheck || exit 1
