# Sử dụng image PHP có sẵn
FROM php:8.2-fpm

# Cài đặt các extension cần thiết
RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ source code vào container
WORKDIR /var/www
COPY . /var/www

# Cài đặt Composer và chạy dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Mở cổng 9000 cho PHP-FPM
EXPOSE 9000

# Lệnh chạy khi container khởi động
CMD ["php-fpm"]
