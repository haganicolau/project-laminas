
FROM php:7.3-apache

RUN apt-get update
RUN apt-get install -y git \
        zlib1g-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libbz2-dev \
        wget \
        libpq-dev \
        libicu-dev \
        vim \
        iputils-ping \
        unzip \
        libaio-dev \
        libxml2-dev \
        && docker-php-ext-install pdo pdo_mysql mysqli mbstring gd iconv \
        && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
        && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
        && docker-php-ext-install pdo_mysql \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer



RUN apt-get install -y openssl ca-certificates curl
ADD https://secure.globalsign.com/cacert/gsalphasha2g2r1.crt /usr/local/share/ca-certificates/
RUN curl http://cert.int-x3.letsencrypt.org/ > /usr/local/share/ca-certificates/lets-encrypt.der
RUN cd /usr/local/share/ca-certificates/ && curl  -vvv -OO http://ccd.acsoluti.com.br/cadeias/{acraiz-v2.crt,ac-soluti-v1.crt,ac-soluti-multipla-v1.crt,ac-soluti-multipla-ssl-v1.crt}
RUN openssl x509 -inform der -in /usr/local/share/ca-certificates/gsalphasha2g2r1.crt -out  /usr/local/share/ca-certificates/gsalphasha2g2r1_tmp.crt \
    && mv /usr/local/share/ca-certificates/gsalphasha2g2r1_tmp.crt /usr/local/share/ca-certificates/gsalphasha2g2r1.crt \
    && openssl x509 -inform der -in /usr/local/share/ca-certificates/lets-encrypt.der -out  /usr/local/share/ca-certificates/lets-encrypt_tmp.crt \
    && mv /usr/local/share/ca-certificates/lets-encrypt_tmp.crt /usr/local/share/ca-certificates/lets-encrypt.crt \
    && update-ca-certificates


# Altera o GID,UID do usuario www-data
RUN NEWUID=1000 && \
NEWGID=1000 && \
LOGIN=www-data && \
GROUP=www-data && \
OLDUID=`id -u $LOGIN` && \
OLDGID=`id -g $GROUP` && \
usermod -u $NEWUID $LOGIN && \
groupmod -g $NEWGID $GROUP && \
find /var/www/ -user $OLDUID -exec chown -h $NEWUID {} \; && \
find /var/www/ -group $OLDGID -exec chgrp -h $NEWGID {} \;

RUN sed -i 's/Listen\ 80/Listen\ 80/g' /etc/apache2/ports.conf
RUN sed -i 's/\*\:80/\*\:80/g' /etc/apache2/sites-enabled/000-default.conf
RUN chown 1000:1000 /var/lock/apache2/ /var/run/apache2/

RUN pecl install xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* \
    && echo "zend_extension=/usr/local/lib/php/extensions/no-debug-non-zts-20160303/xdebug.so" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_enable = on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler = dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port = 9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart = on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back = on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey = netbeans-xdebug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.connect_back = on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host = localhost" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.show_error_trace = on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "output_buffering = 0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_log = /tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


WORKDIR /var/www
