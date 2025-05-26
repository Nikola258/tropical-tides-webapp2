FROM php:8.2-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite

# Configure Apache to handle PHP files
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    AddType application/x-httpd-php .php\n\
</Directory>' > /etc/apache2/conf-available/docker-php.conf && \
    a2enconf docker-php

# Copy files
COPY ./ /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    find /var/www/html -type f -exec chmod 644 {} \;