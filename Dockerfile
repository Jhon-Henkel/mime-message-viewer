FROM php:8.1.11-apache

COPY . .

# installing composer
RUN apt-get update && apt-get -y --no-install-recommends install git \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && rm -rf /var/lib/apt/lists/*

# instaling node
RUN curl -fsSL https://deb.nodesource.com/setup_current.x | bash -  \
    && apt-get install -y nodejs

# installing zip
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev unzip
RUN docker-php-ext-install zip

# installing and setting xdbug
RUN pecl install xdebug \
    && echo "[XDEBUG]" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "zend_extension=\"xdebug.so\"" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.mode=coverage" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host = 127.0.0.1" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_port = 9003" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=trigger" >> /usr/local/etc/php/conf.d/xdebug.ini \