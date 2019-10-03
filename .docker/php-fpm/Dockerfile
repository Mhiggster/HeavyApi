FROM php:7.3-fpm

# workdir wheb we'll launche the local container
WORKDIR /var/www/app

ENV http_proxy "http://192.168.7.90:3128"
ENV https_proxy "http://192.168.7.90:3128"

# mysql-client \
# Installing dependencies
RUN apt-get update && apt-get install -y \
    postgresql-client \
    libpq-dev \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle

# Installing extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql mbstring zip exif pcntl bcmath opcache sockets
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# run the index.php when container is launched
# CMD [ "php", "./index.php" ]


# EXPOSE 80