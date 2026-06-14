# Product Requirements Document (PRD)
## Sistem Prediksi Penjualan & Manajemen Stok Barang Toko Sembako Berbasis Web

---

## 1. Overview Proyek

**Nama Aplikasi**: Sistem Prediksi Penjualan & Manajemen Stok Sembako  
**Mata Kuliah**: Rekayasa Perangkat Lunak (RPL)  
**Universitas**: Universitas Islam Lamongan (Unisla)  
**Tech Stack**:
- Backend: Laravel 11 (PHP)
- Database: MySQL
- Frontend: Blade Template + TailwindCSS v4
- Build Tool: Vite

**Tujuan Aplikasi**:  
Membantu pemilik toko sembako dalam mengelola data barang, mencatat transaksi penjualan, dan memprediksi jumlah stok optimal menggunakan algoritma **Fuzzy Logic metode Tsukamoto**.

---

## 2. Aktor / Pengguna

Hanya satu aktor: **Admin** (pemilik toko / pengelola sistem).  
Tidak ada role lain. Sistem hanya bisa diakses setelah login.

---

## 3. Fitur Utama

### 3.1 Autentikasi
- Halaman login dengan input username & password
- Validasi kredensial dari tabel `admin`
- Session-based authentication menggunakan Laravel Auth manual (bukan Laravel Breeze/Jetstream)
- Tombol logout
- Semua halaman selain login wajib redirect ke login jika belum terautentikasi (middleware auth)

### 3.2 Dashboard
- Menampilkan ringkasan:
  - Total jumlah barang
  - Total transaksi penjualan
  - Hasil prediksi terbaru (barang + nilai prediksi)
- Navigasi ke semua fitur

### 3.3 Manajemen Barang (CRUD)
- Tampilkan daftar semua barang dalam tabel
- Form tambah barang (nama_barang, stok)
- Form edit barang
- Hapus barang (dengan konfirmasi)
- Validasi input: nama_barang wajib diisi, stok minimal 0

### 3.4 Input Penjualan
- Form input transaksi penjualan:
  - Pilih barang (dropdown dari tabel `barang`)
  - Jumlah terjual (integer, minimal 1)
  - Tanggal transaksi (date picker)
- Setelah input penjualan, stok barang di tabel `barang` otomatis berkurang sesuai jumlah terjual
- Tampilkan riwayat penjualan dalam tabel (tanggal, nama barang, jumlah)
- Fitur hapus data penjualan

### 3.5 Prediksi Penjualan (Fuzzy Tsukamoto)
- Admin memilih barang yang ingin diprediksi
- Sistem mengambil data historis penjualan barang tersebut dari tabel `penjualan`
- Sistem menghitung rata-rata penjualan (demand) dan mengambil stok saat ini
- Sistem menjalankan algoritma Fuzzy Tsukamoto secara otomatis
- Hasil prediksi (nilai crisp) ditampilkan di halaman
- Hasil prediksi disimpan ke tabel `prediksi`
- Tampilkan riwayat prediksi dalam tabel (barang, periode, hasil prediksi)

---

## 4. Algoritma Fuzzy Logic Tsukamoto

### 4.1 Variabel Input

**Variabel 1: Permintaan (Demand)**  
Dihitung dari rata-rata jumlah penjualan historis barang yang dipilih.

| Himpunan | Kategori | Range |
|----------|----------|-------|
| Rendah   | 0 – 30   | Fungsi linear turun |
| Sedang   | 15 – 45  | Fungsi segitiga |
| Tinggi   | 30 – 60+ | Fungsi linear naik |

**Variabel 2: Persediaan (Stok)**  
Diambil dari field `stok` pada tabel `barang`.

| Himpunan | Kategori | Range |
|----------|----------|-------|
| Rendah   | 0 – 50   | Fungsi linear turun |
| Sedang   | 25 – 75  | Fungsi segitiga |
| Tinggi   | 50 – 100+| Fungsi linear naik |

### 4.2 Variabel Output

**Variabel: Jumlah Stok yang Direkomendasikan (Prediksi)**

| Himpunan | Range |
|----------|-------|
| Kurangi  | 0 – 50 (linear turun, monoton) |
| Pertahankan | 25 – 75 (linear naik lalu turun — gunakan titik tengah) |
| Tambah   | 50 – 100 (linear naik, monoton) |

### 4.3 Rule Base (IF-THEN)

| Rule | Kondisi | Output |
|------|---------|--------|
| R1 | IF Permintaan Rendah AND Stok Tinggi | THEN Kurangi |
| R2 | IF Permintaan Rendah AND Stok Sedang | THEN Kurangi |
| R3 | IF Permintaan Sedang AND Stok Sedang | THEN Pertahankan |
| R4 | IF Permintaan Sedang AND Stok Rendah | THEN Tambah |
| R5 | IF Permintaan Tinggi AND Stok Rendah | THEN Tambah |
| R6 | IF Permintaan Tinggi AND Stok Sedang | THEN Tambah |
| R7 | IF Permintaan Tinggi AND Stok Tinggi | THEN Pertahankan |
| R8 | IF Permintaan Rendah AND Stok Rendah | THEN Pertahankan |

### 4.4 Proses Perhitungan

1. **Fuzzifikasi**: Hitung derajat keanggotaan untuk setiap variabel input menggunakan fungsi keanggotaan linear
2. **Inferensi**: Untuk setiap rule yang aktif, hitung nilai α (alpha-predikat) menggunakan operator MIN
3. **Defuzzifikasi**: Gunakan metode rata-rata terbobot (Weighted Average):

```
Hasil = Σ(αi × zi) / Σ(αi)
```

Dimana:
- `αi` = nilai alpha-predikat rule ke-i
- `zi` = nilai crisp output rule ke-i (titik pada fungsi keanggotaan output yang sesuai dengan αi)

### 4.5 Implementasi di Laravel

Buat file: `app/Services/FuzzyTsukamotoService.php`

Service ini menerima dua parameter:
- `$demand` (float) — rata-rata penjualan
- `$stok` (int) — stok saat ini

Dan mengembalikan satu nilai float: hasil prediksi (rekomendasi jumlah stok).

---

## 5. Struktur Database

### Tabel: `admin`
| Field | Tipe | Keterangan |
|-------|------|------------|
| id_admin | INT, PK, AUTO_INCREMENT | Primary Key |
| username | VARCHAR(100), UNIQUE | Nama pengguna |
| password | VARCHAR(255) | Password ter-hash (bcrypt) |
| created_at | TIMESTAMP | Otomatis Laravel |
| updated_at | TIMESTAMP | Otomatis Laravel |

### Tabel: `barang`
| Field | Tipe | Keterangan |
|-------|------|------------|
| id_barang | INT, PK, AUTO_INCREMENT | Primary Key |
| nama_barang | VARCHAR(150) | Nama barang |
| stok | INT, DEFAULT 0 | Jumlah stok saat ini |
| created_at | TIMESTAMP | Otomatis Laravel |
| updated_at | TIMESTAMP | Otomatis Laravel |

### Tabel: `penjualan`
| Field | Tipe | Keterangan |
|-------|------|------------|
| id_penjualan | INT, PK, AUTO_INCREMENT | Primary Key |
| id_barang | INT, FK → barang.id_barang | Foreign Key |
| jumlah | INT | Jumlah barang terjual |
| tanggal | DATE | Tanggal transaksi |
| created_at | TIMESTAMP | Otomatis Laravel |
| updated_at | TIMESTAMP | Otomatis Laravel |

### Tabel: `prediksi`
| Field | Tipe | Keterangan |
|-------|------|------------|
| id_prediksi | INT, PK, AUTO_INCREMENT | Primary Key |
| id_barang | INT, FK → barang.id_barang | Foreign Key |
| periode | VARCHAR(20) | Format: 'YYYY-MM' |
| hasil_prediksi | FLOAT | Nilai hasil prediksi crisp |
| created_at | TIMESTAMP | Otomatis Laravel |
| updated_at | TIMESTAMP | Otomatis Laravel |

---

## 6. Struktur Halaman & Routing

| Route | Method | Controller | Fungsi |
|-------|--------|------------|--------|
| `/` | GET | AuthController | Redirect ke login |
| `/login` | GET | AuthController@showLogin | Tampilkan form login |
| `/login` | POST | AuthController@login | Proses login |
| `/logout` | POST | AuthController@logout | Proses logout |
| `/dashboard` | GET | DashboardController@index | Halaman dashboard |
| `/barang` | GET | BarangController@index | Daftar barang |
| `/barang/create` | GET | BarangController@create | Form tambah barang |
| `/barang` | POST | BarangController@store | Simpan barang baru |
| `/barang/{id}/edit` | GET | BarangController@edit | Form edit barang |
| `/barang/{id}` | PUT | BarangController@update | Update barang |
| `/barang/{id}` | DELETE | BarangController@destroy | Hapus barang |
| `/penjualan` | GET | PenjualanController@index | Daftar penjualan |
| `/penjualan/create` | GET | PenjualanController@create | Form input penjualan |
| `/penjualan` | POST | PenjualanController@store | Simpan penjualan |
| `/penjualan/{id}` | DELETE | PenjualanController@destroy | Hapus penjualan |
| `/prediksi` | GET | PrediksiController@index | Halaman prediksi |
| `/prediksi/hitung` | POST | PrediksiController@hitung | Jalankan fuzzy & simpan hasil |

---

## 7. Struktur Folder Laravel

```
sistem-sembako/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── BarangController.php
│   │   │   ├── PenjualanController.php
│   │   │   └── PrediksiController.php
│   │   └── Middleware/
│   │       └── AuthMiddleware.php
│   ├── Models/
│   │   ├── Admin.php
│   │   ├── Barang.php
│   │   ├── Penjualan.php
│   │   └── Prediksi.php
│   └── Services/
│       └── FuzzyTsukamotoService.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php       ← layout utama dengan navbar & sidebar
│       ├── auth/
│       │   └── login.blade.php
│       ├── dashboard/
│       │   └── index.blade.php
│       ├── barang/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── penjualan/
│       │   ├── index.blade.php
│       │   └── create.blade.php
│       └── prediksi/
│           └── index.blade.php
├── routes/
│   └── web.php
└── database/
    └── migrations/
        ├── xxxx_create_admin_table.php
        ├── xxxx_create_barang_table.php
        ├── xxxx_create_penjualan_table.php
        └── xxxx_create_prediksi_table.php
```

---

## 8. UI / UX Requirements

- **Layout**: Sidebar kiri (navigasi) + konten kanan
- **Sidebar berisi**: Logo/judul aplikasi, menu Dashboard, Barang, Penjualan, Prediksi, Logout
- **Warna tema**: Bebas, disarankan hijau/biru (tema sembako/toko)
- **Responsive**: Minimal tampil baik di desktop
- **Notifikasi**: Tampilkan pesan sukses/gagal menggunakan session flash message setelah setiap aksi (tambah, edit, hapus, prediksi)
- **Tabel**: Semua daftar data ditampilkan dalam tabel dengan kolom No, data, dan kolom Aksi

---

## 9. Validasi & Aturan Bisnis

- Stok barang tidak boleh negatif — jika jumlah penjualan melebihi stok, tampilkan error
- Semua field form wajib diisi (required)
- Jumlah penjualan dan stok harus integer positif
- Prediksi hanya bisa dijalankan jika barang memiliki minimal 1 data penjualan historis
- Password admin disimpan dalam format bcrypt (Laravel `Hash::make()`)

---

## 10. Batasan Sistem

- Sistem hanya untuk satu toko (single-tenant)
- Tidak ada fitur multi-user / role berbeda
- Tidak ada fitur laporan ekspor (PDF/Excel) — opsional jika waktu memungkinkan
- Tidak membahas fitur keuangan atau distribusi produk
- Metode prediksi hanya Fuzzy Tsukamoto, tidak dibandingkan dengan metode lain
