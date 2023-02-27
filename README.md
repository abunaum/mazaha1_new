## MA ZAHA Website Project

Sehubungan dengan update laravel maka project sebelumnya berpindah kesini.
project lama :
- [mazaha](https://github.com/abunaum/mazaha).

### Perbedaan sementara dengan versi ini

- **Versi laravel lebih baru**
- **Tidak lagi menggunakan Gdrive sebagai storage**
- **Incrase Performace (test in development)**
- **PHP minimal version 8.1**
- **Directory menyesuaikan terhadap hosting**
- **Dan beberapa perubahan lainnya yang tidak bisa kami sebutkan satu persatu**
- **Folder [Public](https://github.com/abunaum/mazaha_public) berada di repository berbeda**

### Requirements

- **PHP >= v8.1**
- **Composer**
- **PHP Extension BCMath**
- **PHP Extension Ctype**
- **PHP Extension Fileinfo**
- **PHP Extension JSON**
- **PHP Extension Mbstring**
- **PHP Extension OpenSSL**
- **PHP Extension PDO**
- **PHP Extension Tokenizer**
- **PHP Extension XML**

### Cara pasang di hosting

- **Masuk ke directory home pada hosting**
- **Lakukan perintah " git clone https://github.com/abunaum/mazaha1_new.git "**
- **Masuk ke folder mazaha1_new**
- **Lakukan perintah "composer install"**
- **Edit file pada "vendor/laravel/framework/src/Illuminate/Foundation/Application.php" line ke 508 bagian "return $this->joinPaths($this->publicPath ?: $this->basePath('../public_html'), $path);" menjadi "return $this->joinPaths($this->publicPath ?: $this->basePath(env('APP_PUBLIC_FOLDER', 'public_html')), $path);".**
- **Kembali ke directory home**
- **Lakukan perintah " git clone https://github.com/abunaum/mazaha_public.git "**
- **Salin semua file dan directory di dalam folder mazaha_public ke public_html**
- **Masuk ke public_html dan edit file index.php dan ubah bagian "$maintenance = __DIR__.'/../storage/framework/maintenance.php')" menjadi "$maintenance = __DIR__.'/../mazaha1_new/storage/framework/maintenance.php')" , bagian "require __DIR__.'/../vendor/autoload.php';" menjadi "require __DIR__.'/../mazaha1_new/vendor/autoload.php';" , dan bagian "$app = require_once __DIR__.'/../bootstrap/app.php';" menjadi "$app = require_once __DIR__.'/../mazaha1_new/bootstrap/app.php';".**
- **Kembali ke Home dan masuk ke folder mazaha1_new**
- **Copy file .env.example menjadi .env**
- **Edit file .env (sesuaikan di bagian APP_ dan DB_).**
- **Edit file .env (tambah di baris akhir "FILESYSTEM_DISK=public").**
- **Edit file .env (tambah di baris akhir "APP_PUBLIC_FOLDER=../public_html").**
- **Lakukan perintah " php artisan migrate:fresh --seed "**
- **Lakukan perintah " php artisan storage:link ", jika gagal hapus file/folder pada public_html/storage dan lakukan ulang perintah " php artisan storage:link ".**
