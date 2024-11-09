FROM dwchiang/nginx-php-fpm:8.2.0beta3-fpm-alpine3.15-nginx-1.21.6

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/application

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80 9000
