FROM php:7.4-fpm

# laravelに必要なphpパケージを取得
RUN apt-get update \
    && apt-get install -y git zlib1g-dev libzip-dev unzip locales \
    && docker-php-ext-install zip pdo_mysql sockets

# dockerizeのinstall
ENV DOCKERIZE_VERSION v0.6.1
RUN apt-get install -y wget \
    && wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

# 日本語化に必要な処理
RUN echo "ja_JP.UTF-8 UTF-8" >> /etc/locale.gen \
    && locale-gen ja_JP.UTF-8 \
    && update-locale \
    && echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc

# composerのinstall
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
