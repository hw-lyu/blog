FROM php:8.2-fpm

WORKDIR /home
RUN apt-get update && apt-get install -y curl && apt-get install git -y

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

RUN apt-get install -y zlib1g-dev && apt-get install -y libzip-dev && apt-get install -y php-xm && apt-get install -y php-mbstring && apt-get -y install php-curl

RUN ["/bin/bash", "-c", "echo PATH=$PATH:~/.composer/vendor/bin/ >> ~/.bashrc"]
RUN ["/bin/bash", "-c", "source ~/.bashrc"]

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql php-mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN chown -R $USER:www-data /home/blog/storage
RUN chown -R $USER:www-data /home/blog/bootstrap/cache
RUN chmod 775 -R /home/blog/bootstrap/cache
RUN chmod 775 -R /home/blog/storage

EXPOSE 9000
CMD ["php-fpm"]
