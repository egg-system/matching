FROM borderless-gym-app-base
ADD src /var/www/html
RUN chown -R www-data:www-data /var/www
