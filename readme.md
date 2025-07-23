# Aplikasi Pengaduan Masyarakat

Aplikasi ini dibuat untuk memfasilitasi masyarakat dalam menyampaikan laporan atau pengaduan kepada pihak berwenang secara online. Fitur yang tersedia meliputi autentikasi pengguna, manajemen akun petugas, pengelolaan laporan, serta tanggapan dan dashboard untuk admin dan petugas.

## 📌 Fitur Utama

- ✍️ Registrasi dan login masyarakat
- 🔐 Login khusus untuk petugas dan admin
- 🗂️ CRUD akun petugas oleh admin
- 📝 Pengaduan masyarakat beserta unggahan gambar
- 📬 Tanggapan laporan oleh petugas
- 📊 Statistik laporan dan pengguna
- 📄 Ekspor laporan ke PDF
- 🌗 Tampilan dark mode dan light mode

## 📁 Struktur Folder

- `controllers/` — Mengelola logika aplikasi (MVC)
- `models/` — Koneksi dan query database
- `views/` — Tampilan antarmuka pengguna (admin, petugas, masyarakat)
- `config/database.php` — Konfigurasi database
- `public/uploads/` — Penyimpanan file gambar laporan
- `helpers/` — Fungsi-fungsi bantu seperti `redirect()`, `flash()`, dan lain-lain
- `vendor/` — Berisi dependensi (jika menggunakan Composer)

## ⚙️ Instalasi

1. **Clone atau ekstrak project:**
   ```bash
   git clone https://github.com/cahya231204/php-MCV-PengaduanMasyarakat2.0.git

2. **Letakkan folder ke direktori XAMPP:**
    C:/xampp/htdocs/Pengaduan_Masyarakat2.0/

3. **Buat database MySQL:**
    Nama database: pengaduan_masyarakat
    Import file SQL (biasanya pengaduan.sql) jika tersedia

4. **Edit koneksi database:**
    Di config/database.php, sesuaikan:
        $host = 'localhost';
        $db   = 'pengaduan_masyarakat';
        $user = 'root';
        $pass = '';

5. **(Opsional) Jalankan Composer:**
    composer install

👤 Akun Default
    Admin
        Username: admin
        Password: admin123

    Petugas
        Bisa ditambahkan oleh admin lewat menu "Kelola Petugas"

🧰 Teknologi yang Digunakan
    PHP Native (tanpa framework)
    MySQL
    Tailwind CSS
    JavaScript
    mPDF (untuk ekspor PDF)

👨‍💻 Kontributor
    Cahya Aji Saputra (20230801222) — Developer Utama