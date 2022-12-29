FROM php:8.0-apache
ENV DATABASE_HOST=dbhost
ENV DATABASE_USER=dbuser
ENV DATABASE_PASSWD=dbpasswd
ENV DATABASE_DB=datadb
COPY src/ /var/www/html
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
RUN ["apt-get", "install", "-y", "vim"]
COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["bash", "/entrypoint.sh"]
