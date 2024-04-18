FROM alpine:3.7

RUN apk update && apk add php5 php5-openssl php5-mcrypt php5-mysqli php5-pdo_mysql php5-json php5-phar php5-dom php5-ctype && ln -s /usr/bin/php5 /usr/bin/php

RUN mkdir -p /var/fintrack
WORKDIR /var/fintrack
COPY . .
RUN php composer-setup.php && php -r "unlink('composer-setup.php');" && php composer.phar install

EXPOSE 8082
CMD php artisan serve --host=0.0.0.0 --port=8082
