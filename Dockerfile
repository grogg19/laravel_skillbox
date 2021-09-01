FROM ubuntu

RUN apt-get update
RUN apt-get upgrade -y

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get install software-properties-common -y
#RUN add-apt-repository ppa:ondrej/php

#RUN apt-get update
#RUN apt-get upgrade -y

RUN apt-get install -y zip unzip
RUN apt install cron -y

RUN apt install php7.4-common -y
RUN apt install php7.4-cli -y
RUN apt-get install php7.4-fpm


RUN apt-get install -y \
    php7.4-curl \
    php7.4-intl \
    php7.4-mysql \
    php7.4-sqlite \
    php7.4-readline \
    php7.4-xml \
    php7.4-mbstring \
    php7.4-gd \
    php7.4-imagick \
    php7.4-opcache \
    php7.4-redis \
    php7.4-bcmath

RUN apt-get install php7.4-xdebug # Xdebug debugger

RUN apt-get install nginx -y

RUN mkdir /var/run/mysqld

#RUN apt-get install mariadb-server -y
RUN apt-get install mysql-server -y
RUN apt-get install sqlite -y
RUN apt-get install git nodejs npm nano tree vim curl wget ftp -y

RUN wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/v0.37.2/install.sh | bash

RUN npm install -g bower grunt-cli gulp


RUN apt install mc -y
RUN apt install supervisor
RUN apt install redis-server -y

ENV LOG_STDOUT **Boolean**
ENV LOG_STDERR **Boolean**
ENV LOG_LEVEL warn
ENV ALLOW_OVERRIDE All
ENV DATE_TIMEZONE UTC


#COPY run-lamp.sh /usr/sbin/
#COPY 000-default.conf /etc/apache2/sites-available/

COPY setups/default_nginx.conf /etc/nginx/sites-available/default
COPY setups/www_php-fpm.conf /etc/php/7.4/fpm/pool.d/www.conf
COPY setups/supervisord.conf /etc/supervisor/supervisord.conf
COPY setups/laravel-worker.conf /etc/supervisor/conf.d/laravel-worker.conf

RUN mkdir /var/log/php

VOLUME /home/www

#RUN a2enmod rewrite
#RUN ln -s /usr/bin/nodejs /usr/bin/node

COPY run-lemp.sh /usr/sbin/
RUN chmod +x /usr/sbin/run-lemp.sh

RUN mkdir /home/www
RUN chown -R www-data:www-data /home/www
RUN chmod 0777 -R /var/run/mysqld

EXPOSE 3306 80 9001

RUN sed -i -e"s/^bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf

# ROOT PASSWORD
ENV MYSQL_ROOT_PASSWORD=password

#ENV MYSQL_DATABASE=cms
#ENV MYSQL_USER=root
#ENV MYSQL_PASSWORD=password

# Setup Mysql DB
COPY db-init.sh /db-init.sh

RUN chmod +x /db-init.sh

COPY cs.sh /usr/sbin
RUN chmod +x /usr/sbin/cs.sh

RUN bash /usr/sbin/cs.sh

RUN bash /db-init.sh

WORKDIR /home/www

CMD ["/usr/sbin/run-lemp.sh"]
