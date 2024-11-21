ARG version=latest
FROM php:$version

RUN apt-get update \
    && apt-get install -y zip \
    && apt-get install -y libgmp-dev \
    && docker-php-ext-install gmp

RUN curl -s https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

COPY prism/prism/nginx/cert.crt /usr/local/share/ca-certificates/cert.crt
RUN update-ca-certificates

WORKDIR /app
COPY . .

RUN make install
