# Используйте официальный образ PHP в качестве базового образа
FROM php:7.4-apache

# Установите необходимые расширения PHP
RUN docker-php-ext-install pdo pdo_mysql

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Установка Node.js и NPM
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Копирование и установка зависимостей Laravel
COPY . /var/www/html/
WORKDIR /var/www/html/
RUN composer install
RUN npm install && npm run dev

# Настройка прав доступа к хранилищу Laravel
RUN chown -R www-data:www-data /var/www/html/storage
RUN chmod -R 775 /var/www/html/storage

# Включение модуля Apache Rewrite
RUN a2enmod rewrite

# Установка переменной окружения для Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Настройка виртуального хоста Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Запуск веб-сервера Apache
CMD apache2-foreground