#!/bin/bash

set -e
service php7.4-fpm start
service supervisor start
service mysql start
service cron start
service redis-server start
nginx -g 'daemon off;'
