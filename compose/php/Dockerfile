FROM php:7.4-fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update -yqq && \
    apt-get install -yqqf --no-install-recommends \
    default-mysql-client \
    dnsutils \
    crudini \
    zlib1g \
    git \
    wget \
    bzip2 \
    pwgen \
    zip \
    git \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /application

COPY --chown=www:www . /application

USER www

WORKDIR "/application"