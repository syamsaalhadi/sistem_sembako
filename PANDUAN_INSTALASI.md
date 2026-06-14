# 🚀 Panduan Transfer & Instalasi Project

Panduan lengkap untuk memindahkan project **Sistem Prediksi & Rekomendasi Stok Barang Sembako** dari Mac (MAMP) ke Windows (XAMPP).

---

## 📤 Langkah 1 — Di Komputer Pengirim (Mac + MAMP)

### 1.1 Export Database

1. Pastikan MAMP sudah berjalan
2. Buka browser, akses **phpMyAdmin**: `http://localhost:8888/phpmyadmin`
3. Di panel kiri, klik database **`fuzzy_sembako`**
4. Klik tab **Export** di menu atas
5. Pilih format **SQL**
6. Klik tombol **Go / Ekspor**
7. Simpan file `.sql` yang terunduh (contoh: `fuzzy_sembako.sql`)

### 1.2 Zip Project (Tanpa `vendor` & `node_modules`)

> ⚠️ Jangan ikutkan folder `vendor` dan `node_modules` karena sangat besar dan tidak perlu — penerima akan install ulang sendiri.

Buka **Terminal** dan jalankan perintah berikut:

```bash
cd /Applications/MAMP/htdocs
zip -r sistem-sembako.zip sistem-sembako \
  -x "sistem-sembako/vendor/*" \
  -x "sistem-sembako/node_modules/*"
```

File `sistem-sembako.zip` akan muncul di folder `/Applications/MAMP/htdocs/`.

### 1.3 Kirim ke Teman

Kirimkan **2 file** berikut ke teman Anda (via Google Drive, WA, dll):

- `sistem-sembako.zip`
- `fuzzy_sembako.sql`

---

## 📥 Langkah 2 — Di Komputer Penerima (Windows + XAMPP)

### 2.1 Prasyarat

Pastikan sudah terinstal:

| Software | Download |
|---|---|
| XAMPP (PHP 8.2+) | [apachefriends.org](https://www.apachefriends.org) |
| Composer | [getcomposer.org](https://getcomposer.org) |
| Node.js (versi 18+) | [nodejs.org](https://nodejs.org) |

### 2.2 Ekstrak Project

1. Ekstrak file `sistem-sembako.zip`
2. Pindahkan folder `sistem-sembako` ke: `C:\xampp\htdocs\`

Hasilnya: `C:\xampp\htdocs\sistem-sembako\`

### 2.3 Buat Database & Import

1. Buka **XAMPP Control Panel**, klik **Start** pada **Apache** dan **MySQL**
2. Buka browser, akses **phpMyAdmin**: `http://localhost/phpmyadmin`
3. Klik **Database** di menu atas
4. Buat database baru dengan nama: **`fuzzy_sembako`** → klik **Create**
5. Klik database `fuzzy_sembako` di panel kiri
6. Klik tab **Import**
7. Klik **Choose File** → pilih file `fuzzy_sembako.sql`
8. Klik tombol **Go / Impor**

### 2.4 Sesuaikan File `.env`

1. Buka folder `C:\xampp\htdocs\sistem-sembako\`
2. Buka file **`.env`** dengan Notepad atau VSCode
3. Cari bagian database dan sesuaikan seperti berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fuzzy_sembako
DB_USERNAME=root
DB_PASSWORD=
```

> **Perhatian:** Port XAMPP adalah `3306` (bukan `8889` seperti di MAMP). Password dikosongkan karena XAMPP default tidak pakai password.

### 2.5 Install Dependensi

Buka **Command Prompt (CMD)** atau **Git Bash**, lalu arahkan ke folder project:

```bash
cd C:\xampp\htdocs\sistem-sembako
```

Jalankan perintah berikut satu per satu:

```bash
composer install
```

```bash
npm install
```

### 2.6 Jalankan Aplikasi

Buka **2 jendela CMD terpisah**:

**CMD 1 — Compile Asset (biarkan tetap berjalan):**
```bash
npm run dev
```

**CMD 2 — PHP Server:**
```bash
php artisan serve
```

### 2.7 Buka di Browser

```
http://127.0.0.1:8000
```

---

## 🔑 Login Default

| Field | Value |
|---|---|
| **Username** | `admin` |
| **Password** | `password` |

---

## ❗ Troubleshooting

| Masalah | Solusi |
|---|---|
| Error koneksi database | Pastikan MySQL di XAMPP sudah **Start**, dan cek konfigurasi di `.env` |
| Port sudah dipakai | Jalankan di port lain: `php artisan serve --port=8001` |
| Error `composer install` | Pastikan versi PHP minimal **8.2**: `php -v` di CMD |
| Halaman putih/error | Cek file `.env` sudah ada dan `APP_KEY` sudah terisi |
| `npm run dev` error | Pastikan Node.js sudah terinstal: `node -v` di CMD |

---

> 💡 Jika ada kendala, pastikan **Apache** dan **MySQL** di XAMPP Control Panel berstatus **Running** (hijau).
