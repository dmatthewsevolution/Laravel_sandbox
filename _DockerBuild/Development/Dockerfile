FROM alpine:3.14

#---------------------
# Package Management
#---------------------
RUN apk update && apk upgrade

RUN apk add --no-cache  supervisor nginx nano atop mailcap
RUN apk add --no-cache  php8 php8-fpm php8-opcache php8-gd php8-zlib php8-curl php8-xml php8-simplexml php8-json php8-dom php8-session
RUN apk add --no-cache  php8-phar php8-iconv php8-mbstring php8-pdo php8-pdo_mysql php8-pdo_sqlite php8-tokenizer php8-xmlwriter
RUN apk add --no-cache  php8-bcmath php8-ctype php8-fileinfo php8-openssl php8-tokenizer
RUN apk add --no-cache  composer 

#Development Purposes Only
RUN apk add --no-cache  php8-xdebug --repository http://dl-3.alpinelinux.org/alpine/edge/testing/


#---------------------
# Configure Services
#---------------------
#Set timezone to UTC and ensure its in sync
RUN apk add --no-cache tzdata && cp /usr/share/zoneinfo/UTC /etc/localtime && apk del tzdata

#(Nginx, PHP-FPM, Supervisord) from config files
COPY ./_ConfigFiles/Webserver/nginx.conf /etc/nginx/nginx.conf
COPY ./_ConfigFiles/Webserver/mime.types /etc/nginx/mime.types
COPY ./_ConfigFiles/Webserver/fpm-pool.conf /etc/php8/php-fpm.d/zzz_custom.conf
COPY ./_ConfigFiles/Webserver/php.ini /etc/php8/conf.d/zzz_custom.ini
COPY ./_ConfigFiles/Webserver/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Nginx Specific
RUN mkdir -p /run/nginx && mkdir -p /var/www/html
RUN rm -rf /var/www/localhost


#---------------------
# Add Application
#---------------------
RUN mkdir -p /var/www/html
RUN touch /var/log/php8/error.log
WORKDIR /var/www/

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]