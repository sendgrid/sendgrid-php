FROM php:7.1-cli
ENV LANG C.UTF-8

# install Composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /root

# install Prism
ADD https://github.com/stoplightio/prism/releases/download/v2.0.0-alpha.7/prism_linux_amd64 ./prism
RUN chmod +x ./prism
RUN ./prism run --mock --list --spec https://raw.githubusercontent.com/sendgrid/sendgrid-oai/master/oai_stoplight.json 2> /dev/null &

# set up default sendgrid env
ENV SENDGRID_API_KEY $SENDGRID_API_KEY
WORKDIR /root/sendgrid
RUN mkdir sendgrid-php
WORKDIR /root/sendgrid/sendgrid-php

RUN /bin/bash
