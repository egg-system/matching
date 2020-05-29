FROM borderless-gym-app-base

ADD prod/src /var/www/html
RUN chown -R www-data:www-data /var/www

RUN composer install --no-dev