FROM php:7.1-cli
ENV LANG C.UTF-8

RUN php -r "readfile('https://getcomposer.org/installer');" | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /root

# install Prism
ADD https://raw.githubusercontent.com/stoplightio/prism/master/install.sh install.sh
RUN chmod +x ./install.sh && sync && ./install.sh && rm ./install.sh
RUN prism run --mock --spec https://raw.githubusercontent.com/sendgrid/sendgrid-oai/master/oai_stoplight.json 2> /dev/null &

ENV SENDGRID_API_KEY $SENDGRID_API_KEY

# set up default sendgrid env
WORKDIR /root/sendgrid
RUN mkdir sendgrid-php
WORKDIR /root/sendgrid/sendgrid-php

RUN /bin/bash
