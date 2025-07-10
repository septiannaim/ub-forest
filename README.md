# UB Forest - Sistem Informasi Geografis Hutan Universitas Brawijaya

## Deskripsi
UB Forest adalah sistem informasi geografis yang menyediakan informasi tentang hutan di Universitas Brawijaya. Sistem ini memungkinkan pengguna untuk melihat, mengelola, dan menganalisis data spasial terkait hutan UB.

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- Node.js >= 16.x
- MySQL >= 8.0
- Web Server (Apache/Nginx)

## Panduan Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/your-username/ub-forest.git
cd ub-forest
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ub_forest
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Migrasi Database
```bash
php artisan migrate
php artisan db:seed
```

### 5. Compile Assets
```bash
npm run dev
```

### 6. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Fitur Utama
- Visualisasi data spasial hutan UB
- Manajemen data pohon dan vegetasi
- Analisis kerapatan vegetasi
- Peta interaktif dengan layer informasi
- Sistem autentikasi dan otorisasi
- Manajemen pengguna dan peran

## Struktur Folder
```
ub-forest/
├── app/                # Kode aplikasi utama
├── config/            # File konfigurasi
├── database/          # Migrasi dan seeder
├── public/            # Asset publik
├── resources/         # View dan asset
├── routes/            # Definisi route
└── storage/           # File yang diupload
```

## Panduan Penggunaan

### Login
1. Buka aplikasi di browser
2. Masukkan kredensial yang telah diberikan
3. Klik tombol "Login"

### Melihat Peta
1. Setelah login, Anda akan diarahkan ke halaman peta
2. Gunakan kontrol zoom untuk memperbesar/memperkecil peta
3. Pilih layer yang ingin ditampilkan dari panel layer

### Manajemen Data
1. Akses menu sesuai dengan peran pengguna
2. Gunakan form untuk menambah/edit data
3. Data akan otomatis terupdate di peta

## Troubleshooting

### Masalah Umum
1. **Error Database Connection**
   - Periksa konfigurasi database di `.env`
   - Pastikan MySQL server berjalan
   - Verifikasi kredensial database

2. **Asset tidak muncul**
   - Jalankan `npm run dev`
   - Clear cache dengan `php artisan cache:clear`

3. **Permission Error**
   - Pastikan folder `storage` dan `bootstrap/cache` memiliki permission write
   - Jalankan `chmod -R 775 storage bootstrap/cache`

## Kontak & Dukungan
Untuk bantuan dan dukungan teknis, silakan hubungi:
- Email: support@ubforest.com
- Website: https://ubforest.com

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE.md).
