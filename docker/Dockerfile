FROM phpearth/php:7.1-cli
ENV LANG C.UTF-8

RUN apk add --no-cache composer

WORKDIR /root

# install Prism
ADD https://raw.githubusercontent.com/stoplightio/prism/master/install.sh install.sh
RUN chmod +x ./install.sh && sync && \
    ./install.sh && \
    rm ./install.sh

ENV SENDGRID_API_KEY $SENDGRID_API_KEY

RUN apk add --no-cache git

# set up default sendgrid env
WORKDIR /root/sources
RUN git clone https://github.com/sendgrid/sendgrid-php.git && \
    git clone https://github.com/sendgrid/php-http-client.git

WORKDIR /root
RUN ln -s /root/sources/sendgrid-php/sendgrid && \
    ln -s /root/sources/php-http-client/php_http_client

COPY entrypoint.sh entrypoint.sh
RUN chmod +x entrypoint.sh
ENTRYPOINT ["./entrypoint.sh"]
CMD ["--mock"]
