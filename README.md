# 🏥 PoliklinikBK - Sistem Manajemen Klinik Laravel

## 📋 Gambaran Proyek
PoliklinikBK adalah sistem manajemen klinik komprehensif yang dikembangkan menggunakan Laravel 11, dirancang untuk mengoptimalkan administrasi kesehatan dan manajemen pasien.

## 🖥️ Persyaratan Sistem

### Prasyarat
- **PHP** `8.1+`
- **Composer** 
- **MySQL/MariaDB**
- **Node.js & npm**
- **Web Server** (Apache/Nginx)

## 🚀 Panduan Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/Az-Zauqy/PoliklinikBK.git
cd PoliklinikBK
```

### 2. Instal Dependensi
```bash
# Instal dependensi PHP
composer install

# Instal dependensi front-end
npm install
```

### 3. Konfigurasi Lingkungan
Salin file environment dan hasilkan kunci aplikasi:
```bash
# Buat file .env
cp .env.example .env

# Hasilkan kunci aplikasi
php artisan key:generate
```

### 4. Pengaturan Database
Edit file `.env` dengan kredensial database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=poli
DB_USERNAME=root
DB_PASSWORD=passwordanda
```

### 5. Migrasi dan Impor Database
Anda memiliki dua pilihan untuk menyiapkan database:

#### Pilihan 1: Gunakan Migrasi Laravel
```bash
# Jalankan migrasi database
php artisan migrate

# (Opsional) Isi data awal
php artisan db:seed
```

#### Pilihan 2: Impor File SQL
File SQL di dalam folder database:
1. Buat database:
```bash
mysql -u root -p
CREATE DATABASE poli;
exit;
```

2. Impor file SQL:
```bash
mysql -u root -p poli < path/ke/database.sql
```

### 6. Kompilasi Aset Front-End
```bash
# Kompilasi aset
npm run dev
```

### 7. Jalankan Aplikasi
```bash
# Jalankan server pengembangan
php artisan serve
```

🌐 Akses aplikasi di: `http://localhost:8000`

---

**Developed by Az-Zauqy** 🚀
