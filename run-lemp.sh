#!/bin/bash

set -e
service php7.4-fpm start
service mysql start
service cron start
nginx -g 'daemon off;'
