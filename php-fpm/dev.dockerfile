FROM gym-app-base:latest
RUN composer global require hirak/prestissimo

# envファイルの生成
COPY ./src/.env.example /var/www/html/.env
