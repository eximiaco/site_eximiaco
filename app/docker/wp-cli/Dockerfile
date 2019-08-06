FROM wordpress:cli-php7.2

# this package is not registered on packagist
RUN php -d memory_limit=512M "$(which wp)" package install 10up/mu-migration

USER root

RUN set -ex; \
        \
        # Image build dependencies
        apk add --update --no-cache --virtual .build-deps \
            autoconf \
            build-base \
            gcc; \
        \
        # Install Xdebug extension
        pecl install xdebug; \
        docker-php-ext-enable xdebug; \
		\
        # Install MySQL PDO extension. It is required by Article Source Selector plugin
        docker-php-ext-install pdo pdo_mysql; \
        \
        # Remove build dependencies
        apk del .build-deps

# Prioritise Composer packages as bin
# This command override the image WP-CLI in favour of Composer
ENV PATH=/var/www/html/vendor/bin:$PATH

# Install, enable and configure Xdebug
RUN { \
        echo 'log_errors = On'; \
        echo 'error_log = /dev/stderr'; \
        echo 'xdebug.idekey = ${PHP_XDEBUG_IDEKEY}'; \
        echo 'xdebug.profiler_enable_trigger = On'; \
        echo 'xdebug.profiler_output_dir = /tmp/xdebug_profiler'; \
        echo 'xdebug.profiler_output_name = xdebug_profile.%R-%u'; \
        echo 'xdebug.remote_autostart = On'; \
        echo 'xdebug.remote_enable = ${PHP_XDEBUG_REMOTE_ENABLE}'; \
        echo 'xdebug.remote_handle = dbgp'; \
        echo 'xdebug.remote_log = /tmp/xdebug.log'; \
        echo 'xdebug.remote_host = ${PHP_XDEBUG_REMOTE_HOST}'; \
        echo 'xdebug.remote_port = 9000'; \
    } > /usr/local/etc/php/conf.d/xdebug.ini

USER www-data

WORKDIR /var/www/html/web
