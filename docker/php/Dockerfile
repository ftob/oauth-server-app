FROM php:7.0-fpm
MAINTAINER Nikita Volkov <litebackend@gmail.com>

RUN apt-get clean
RUN apt-get update


# Install opcache
RUN docker-php-ext-install opcache

# Install APCu
RUN pecl install apcu
RUN echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

# Install bcmath
RUN docker-php-ext-install bcmath

# Install bz2
RUN apt-get install -y libbz2-dev
RUN docker-php-ext-install bz2

# Install calendar
RUN docker-php-ext-install calendar

# Install dba
RUN docker-php-ext-install dba

# Install mbstring
RUN docker-php-ext-install mbstring

# Install mcrypt
RUN apt-get install -y libmcrypt-dev
RUN docker-php-ext-install mcrypt

# Install PDO
RUN docker-php-ext-install pdo


RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pdo_pgsql

RUN apt-get install -y unzip
WORKDIR /root


# Install XSL
RUN apt-get install -y libxslt-dev
RUN docker-php-ext-install xsl

# Install xmlrpc
RUN docker-php-ext-install xmlrpc


# Install intl
RUN apt-get install -y libicu-dev
RUN pecl install intl
RUN docker-php-ext-install intl

# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer


# Include the start script
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

CMD ["start.sh"]