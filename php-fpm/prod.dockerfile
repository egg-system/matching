FROM gym-app-base:latest

ADD src /var/www/html
RUN chown -R www-data:www-data /var/www

RUN composer install --no-dev

# buildの実行
COPY ./php-fpm/build.sh /var/local/build.sh
RUN chmod +x /var/local/build.sh

CMD ["sh", "/var/local/build.sh"]
