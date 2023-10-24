FROM php:8.2-fpm

WORKDIR /home/homepage
RUN apt-get update && apt-get install -y curl && apt-get install git -y

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

RUN apt-get install -y zlib1g-dev && apt-get install -y libzip-dev && apt-get install -y php-xml && apt-get install -y php-mbstring

RUN ["/bin/bash", "-c", "echo PATH=$PATH:~/.composer/vendor/bin/ >> ~/.bashrc"]
RUN ["/bin/bash", "-c", "source ~/.bashrc"]

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN chown -R $USER:www-data /home/homepage/blog/src/storage
RUN chown -R $USER:www-data /home/homepage/blog/src/bootstrap/cache
RUN chmod 775 -R /home/homepage/blog/src/bootstrap/cache
RUN chmod 775 -R /home/homepage/blog/src/storage

EXPOSE 9000
CMD ["php-fpm"]