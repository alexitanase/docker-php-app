FROM composer:2.0.11 AS composer
FROM webdevops/php-nginx:7.4

ENV WEB_DOCUMENT_ROOT=/app/public
ENV CI_ENVIRONMENT=production

WORKDIR /app

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY ./backend/composer.json /app/
COPY ./backend/composer.lock /app/

RUN /usr/bin/composer clearcache
RUN /usr/bin/composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer


COPY ./backend /app
RUN rm -fr /app/writable
COPY ./deployment/config/propel.yml /app/
COPY .app.fingerprint /app/.fingerprint
COPY ./deployment/.backend-env /app/.env
RUN mkdir -p /app/writable
RUN mkdir -p /app/writable/cache
RUN mkdir -p /app/writable/debugbar
RUN chmod 777 /app/writable/cache
RUN chmod 777 /app/writable/debugbar

RUN /usr/bin/composer dump-autoload --no-scripts --no-dev --optimize



RUN apt-get update && apt-get install -y wget
HEALTHCHECK CMD wget -q --method=HEAD localhost/status.txt