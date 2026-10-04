# WargaCare

WargaCare adalah aplikasi web profesional untuk pengaduan dan aspirasi masyarakat.

## Teknologi
- PHP Native 8+
- MySQL / MariaDB
- HTML5
- CSS3
- JavaScript
- PDO

## Fitur
- Registrasi dan login
- Role masyarakat, petugas, administrator
- Pembuatan pengaduan
- Nomor tiket otomatis
- Kategori pengaduan
- Upload bukti foto
- Tracking status
- Tanggapan petugas
- Riwayat pengaduan
- Dashboard statistik
- Pencarian laporan
- Keamanan dasar dengan PDO prepared statement dan password hashing

## Instalasi XAMPP
1. Ekstrak folder `WargaCare` ke `C:/xampp/htdocs/`.
2. Jalankan Apache dan MySQL melalui XAMPP.
3. Buka `http://localhost/phpmyadmin`.
4. Import file `database.sql`.
5. Pastikan database bernama `wargacare`.
6. Buka `http://localhost/WargaCare/`.

## Akun demo
Administrator:
- Email: admin@wargacare.test
- Password: admin123

Petugas:
- Email: petugas@wargacare.test
- Password: petugas123

Untuk masyarakat, gunakan menu Daftar.

## Struktur
- `admin/` dashboard administrator
- `petugas/` pengelolaan laporan
- `masyarakat/` dashboard dan pelaporan warga
- `auth/` login, register, logout
- `config/` koneksi dan helper
- `includes/` komponen layout
- `assets/` CSS dan JavaScript
- `uploads/` bukti foto pengaduan
