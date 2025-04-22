# Usa a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões necessárias (ex.: mysqli, pdo_mysql)
RUN docker-php-ext-install mysqli pdo_mysql

# Copia o código para a pasta padrão do Apache
COPY . /var/www/html/

# Ajusta permissões, se necessário
RUN chown -R www-data:www-data /var/www/html

# Exponha a porta 80 (configuração padrão do Apache)
EXPOSE 80