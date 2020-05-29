FROM php:7.4-fpm

# laravelに必要なphpパケージを取得
RUN apt-get update \
    && apt-get install -y git zlib1g-dev libzip-dev unzip locales \
    && docker-php-ext-install zip pdo_mysql sockets

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
