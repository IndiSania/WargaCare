CREATE DATABASE IF NOT EXISTS wargacare CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wargacare;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nama VARCHAR(100) NOT NULL,
 email VARCHAR(120) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 no_hp VARCHAR(25),
 alamat TEXT,
 role ENUM('masyarakat','petugas','admin') NOT NULL DEFAULT 'masyarakat',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kategori (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nama VARCHAR(80) NOT NULL UNIQUE
);

CREATE TABLE pengaduan (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 kategori_id INT NOT NULL,
 nomor_tiket VARCHAR(30) NOT NULL UNIQUE,
 judul VARCHAR(180) NOT NULL,
 isi TEXT NOT NULL,
 lokasi VARCHAR(255) NOT NULL,
 foto VARCHAR(255),
 status ENUM('Diajukan','Diverifikasi','Diproses','Ditindaklanjuti','Selesai','Ditolak') DEFAULT 'Diajukan',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(kategori_id) REFERENCES kategori(id)
);

CREATE TABLE tanggapan (
 id INT AUTO_INCREMENT PRIMARY KEY,
 pengaduan_id INT NOT NULL,
 user_id INT NOT NULL,
 isi TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(pengaduan_id) REFERENCES pengaduan(id) ON DELETE CASCADE,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO kategori(nama) VALUES
('Infrastruktur'),('Kebersihan'),('Keamanan'),('Pelayanan Publik'),('Lingkungan'),('Fasilitas Umum'),('Lainnya');

INSERT INTO users(nama,email,password,role) VALUES
('Administrator','admin@wargacare.test',MD5('admin123'),'admin'),
('Petugas Demo','petugas@wargacare.test',MD5('petugas123'),'petugas');
