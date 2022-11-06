FROM php:8.0-apache
ARG DATABASE_HOST=localhost
ARG DATABASE_USER=dbuser
ARG DATABASE_PASSWD=dbpasswd
ARG DATABASE_DB=datadb
COPY src/ /var/www/html
RUN sed -i "s/localhost/${DATABASE_HOST}/g" /var/www/html/index.php
RUN sed -i "s/dbuser/${DATABASE_USER}/g" /var/www/html/index.php
RUN sed -i "s/dbpasswd/${DATABASE_PASSWD}/g" /var/www/html/index.php
RUN sed -i "s/birthdaysdb/${DATABASE_DB}/g" /var/www/html/index.php
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
RUN ["apt-get", "install", "-y", "vim"]
