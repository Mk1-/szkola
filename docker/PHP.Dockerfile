FROM php:7.4-fpm

RUN apt-get -y update
RUN apt-get -y install git
RUN apt-get -y install unzip

RUN docker-php-ext-install pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN git --version
RUN composer -V
RUN mkdir /var/prog
RUN (cd /var/prog && git clone https://github.com/Mk1-/szkola.git)
RUN (cd /var/prog/szkola && composer install; exit 0)
RUN curl -sS https://get.symfony.com/cli/installer | bash

COPY ./wait-for-it.sh /var/prog/szkola
RUN chmod a+rx /var/prog/szkola/wait-for-it.sh

CMD sh /var/prog/prepare.sh
