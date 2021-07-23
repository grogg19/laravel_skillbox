FROM ubuntu

RUN apt-get update
RUN apt-get upgrade -y

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install -y zip unzip

RUN apt install php8.0-common -y
RUN apt install php8.0-cli -y
RUN apt-get install php8.0-fpm


RUN apt-get install -y \
    php8.0-curl \
    php8.0-intl \
    php8.0-mysql \
    php8.0-readline \
    php8.0-xml \
    php8.0-mbstring \
    php8.0-gd \
    php8.0-imagick \
    php8.0-opcache

#php8-cgi php8-common php8-cli php8-curl php8-intl php8-dev php8-fpm php8-gd php8-imagick php8-mbstring php8-mysql php8-opcache php8-readline php8-xml

RUN apt-get install php8.0-xdebug # Xdebug debugger

RUN apt-get install nginx -y

RUN mkdir /var/run/mysqld

#RUN apt-get install mariadb-server -y
RUN apt-get install mysql-server -y
RUN apt-get install git nodejs npm nano tree vim curl wget ftp -y
RUN npm install -g bower grunt-cli gulp

RUN apt install mc -y

ENV LOG_STDOUT **Boolean**
ENV LOG_STDERR **Boolean**
ENV LOG_LEVEL warn
ENV ALLOW_OVERRIDE All
ENV DATE_TIMEZONE UTC


#COPY run-lamp.sh /usr/sbin/
#COPY 000-default.conf /etc/apache2/sites-available/

COPY setups/default_nginx.conf /etc/nginx/sites-available/default
COPY setups/www_php-fpm.conf /etc/php/8.0/fpm/pool.d/www.conf

RUN mkdir /var/log/php

VOLUME /home/www

#RUN a2enmod rewrite
#RUN ln -s /usr/bin/nodejs /usr/bin/node

COPY run-lemp.sh /usr/sbin/
RUN chmod +x /usr/sbin/run-lemp.sh

RUN mkdir /home/www
RUN chown -R www-data:www-data /home/www
RUN chmod 0777 -R /var/run/mysqld

EXPOSE 3306 80

RUN sed -i -e"s/^bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf

# ROOT PASSWORD
ENV MYSQL_ROOT_PASSWORD=password

#ENV MYSQL_DATABASE=cms
#ENV MYSQL_USER=root
#ENV MYSQL_PASSWORD=password

# Setup Mysql DB
COPY db-init.sh /db-init.sh
RUN chmod +x /db-init.sh

RUN service mysql start
RUN service php8.0-fpm start

COPY cs.sh /usr/sbin
RUN chmod +x /usr/sbin/cs.sh

RUN bash /usr/sbin/cs.sh

RUN bash /db-init.sh

#CMD ["/usr/sbin/run-lemp.sh"]
