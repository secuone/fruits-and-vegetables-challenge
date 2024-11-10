FROM php:8.3-fpm-alpine

ARG APP_ENV
RUN apk add --no-cache git

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install common PHP extensions
RUN install-php-extensions zip bcmath redis @composer;

# Install Xdebug only if APP_ENV is set to 'dev'
RUN if [ "$APP_ENV" = "dev" ]; then \
        install-php-extensions xdebug; \
    fi

# Clean up
RUN rm /usr/local/bin/install-php-extensions

WORKDIR /app
