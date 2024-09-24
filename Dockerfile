# Menggunakan image PHP dari Docker Hub
FROM php:8.0-cli

# Mengatur working directory
WORKDIR /app

# Menyalin composer.json dan composer.lock (jika ada)
COPY composer.json ./

# Menginstal Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Menginstal dependensi
RUN composer install

# Menyalin sisa file aplikasi
COPY . .

# Menjalankan aplikasi
CMD ["php", "index.php"]
