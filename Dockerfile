FROM php:8.3-apache
RUN docker-php-ext-install pdo pdo_mysql


#Config apache
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public


RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# git install
RUN apt-get -y update
RUN apt-get -y install git

WORKDIR /var/www/html


#Instalación de composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer



# Cambiar el propietario y permisos del directorio /var/www/html
RUN chown -R www-data:www-data /var/www/html 
RUN chmod 777 /var/www/html


COPY . /var/www/html

EXPOSE 80