# 📦 Sistem Prediksi & Rekomendasi Stok Barang Sembako

Aplikasi web berbasis **Laravel** untuk memprediksi stok barang sembako menggunakan metode **Logika Fuzzy Tsukamoto**. Sistem ini membantu pemilik toko sembako dalam mengambil keputusan pengelolaan stok berdasarkan data penjualan historis.

> **Dibuat untuk keperluan Tugas Rekayasa Perangkat Lunak (RPL)**

---

## ✨ Fitur Utama

- 🔐 **Autentikasi** — Login & logout dengan manajemen sesi
- 📊 **Dashboard** — Ringkasan statistik dan grafik penjualan 6 bulan terakhir
- 📦 **Data Barang** — CRUD data barang sembako beserta stok
- 🛒 **Data Penjualan** — CRUD transaksi penjualan dengan fitur filter & pencarian
- 🤖 **Prediksi & Rekomendasi** — Kalkulasi prediksi stok menggunakan Fuzzy Tsukamoto + cetak & export CSV
- 📐 **Aturan Fuzzy** — Visualisasi grafik fungsi keanggotaan dan aturan yang digunakan
- 📄 **Laporan Bulanan** — Rekap penjualan & prediksi per bulan, dapat dicetak
- 👥 **Manajemen Pengguna** — CRUD akun admin
- ⚙️ **Pengaturan** — Ganti nama aplikasi & password admin

---

## 🛠️ Prasyarat (Prerequisites)

Pastikan komputer sudah terinstal:

| Software | Versi Minimum | Download |
|---|---|---|
| PHP | 8.2+ | [php.net](https://www.php.net/downloads) |
| MySQL | 5.7+ | via XAMPP/MAMP/Laragon |
| Composer | 2.x | [getcomposer.org](https://getcomposer.org) |
| Node.js & NPM | 18.x+ | [nodejs.org](https://nodejs.org) |

> 💡 **Rekomendasi**: Gunakan [XAMPP](https://www.apachefriends.org/) (Windows/Linux) atau [MAMP](https://www.mamp.info/) (Mac) untuk menjalankan PHP dan MySQL dengan mudah.

---

## 🚀 Cara Instalasi & Menjalankan Proyek

Ikuti langkah-langkah berikut secara urut:

### 1. Clone Repository

```bash
git clone https://github.com/[USERNAME]/sistem-sembako.git
cd sistem-sembako
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi JavaScript

```bash
npm install
```

### 4. Salin File Konfigurasi Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306        # Port default MySQL. Jika pakai MAMP, biasanya 8889
DB_DATABASE=fuzzy_sembako
DB_USERNAME=root
DB_PASSWORD=        # Kosong jika pakai XAMPP, 'root' jika pakai MAMP
```

> **Penting:** Buat database baru di phpMyAdmin atau MySQL CLI dengan nama **`fuzzy_sembako`** sebelum melanjutkan.
> ```sql
> CREATE DATABASE fuzzy_sembako;
> ```

### 7. Jalankan Migrasi & Seeder Database

Perintah ini akan membuat semua tabel dan mengisi data awal (akun admin):

```bash
php artisan migrate --seed
```

### 8. Jalankan Development Server

Buka **2 terminal terpisah** dan jalankan masing-masing perintah:

**Terminal 1 — PHP Server:**
```bash
php artisan serve
```

**Terminal 2 — Vite (Asset Compiler):**
```bash
npm run dev
```

### 9. Buka di Browser

```
http://127.0.0.1:8000
```

---

## 🔑 Kredensial Login Default

Setelah seeder berhasil dijalankan, gunakan akun berikut:

| Field | Value |
|---|---|
| **Username** | `admin` |
| **Password** | `password` |

> ⚠️ Ganti password setelah pertama kali login melalui menu **Pengaturan**.

---

## 📁 Struktur Proyek (Singkat)

```
sistem-sembako/
├── app/
│   ├── Http/Controllers/   # Controller (Dashboard, Barang, Penjualan, Prediksi, dll)
│   ├── Models/             # Model Eloquent (Barang, Penjualan, Prediksi, Admin)
│   └── Services/
│       └── FuzzyTsukamotoService.php  # Logika algoritma Fuzzy Tsukamoto
├── database/
│   ├── migrations/         # Skema tabel database
│   └── seeders/            # Data awal (akun admin)
├── resources/
│   └── views/              # Tampilan Blade (dashboard, barang, penjualan, dll)
├── routes/
│   └── web.php             # Definisi semua route
└── .env                    # Konfigurasi environment (jangan di-commit!)
```

---

## 📊 Metode Fuzzy Tsukamoto

Sistem ini menggunakan **Fuzzy Tsukamoto** dengan variabel input:

| Variabel | Rendah | Sedang | Tinggi |
|---|---|---|---|
| **Demand** (Permintaan) | < 50 | 30–70 | > 50 |
| **Stok** (Persediaan) | < 100 | 50–150 | > 100 |

**Output:** Rekomendasi jumlah stok (unit) yang perlu disiapkan.

---

## ⚠️ Troubleshooting Umum

**Error `php_zip` extension tidak ditemukan:**
Aktifkan ekstensi `zip` dan `pdo_mysql` di file `php.ini`.

**Error koneksi database:**
Pastikan MySQL sudah berjalan di XAMPP/MAMP dan nama database, username, serta password di `.env` sudah benar.

**Halaman tampil error setelah clone:**
Pastikan sudah menjalankan `composer install`, `npm install`, dan `php artisan key:generate`.

**Port 8000 sudah dipakai:**
Jalankan di port lain: `php artisan serve --port=8001`

---

## 🤝 Kontribusi

Pull request sangat diterima! Untuk perubahan besar, buka *issue* terlebih dahulu untuk berdiskusi.

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan akademis mata kuliah Rekayasa Perangkat Lunak.
