# Χρήση εικόνας PHP με Apache
FROM php:7.4-apache

# Εγκατάσταση MySQLi επέκτασης
RUN docker-php-ext-install mysqli

# Αντιγραφή του project στον φάκελο του Apache
COPY . /var/www/html/

# Δικαιώματα στον Apache φάκελο
RUN chown -R www-data:www-data /var/www/html/

# Άνοιγμα του port 80
EXPOSE 80
