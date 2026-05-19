CREATE DATABASE IF NOT EXISTS lelang_online;
USE lelang_online;

CREATE TABLE barang_lelangs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama_barang VARCHAR(255) NOT NULL,
  deskripsi TEXT NULL,
  harga_awal DECIMAL(15,2) NOT NULL,
  status ENUM('draft','aktif','selesai','dibatalkan') DEFAULT 'draft',
  tanggal_mulai DATETIME NULL,
  tanggal_selesai DATETIME NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE peserta_lelangs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama_peserta VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  no_hp VARCHAR(20) NOT NULL,
  alamat TEXT NULL,
  status_verifikasi ENUM('pending','terverifikasi','ditolak') DEFAULT 'pending',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE panitias (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama_panitia VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  no_hp VARCHAR(20) NOT NULL,
  jabatan VARCHAR(100) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE penawarans (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  barang_lelang_id BIGINT UNSIGNED NOT NULL,
  peserta_lelang_id BIGINT UNSIGNED NOT NULL,
  nominal_bid DECIMAL(15,2) NOT NULL,
  waktu_bid DATETIME NOT NULL,
  status_bid ENUM('valid','tertinggi','kalah','dibatalkan') DEFAULT 'valid',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (barang_lelang_id) REFERENCES barang_lelangs(id) ON DELETE CASCADE,
  FOREIGN KEY (peserta_lelang_id) REFERENCES peserta_lelangs(id) ON DELETE CASCADE
);

CREATE TABLE pemenangs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  barang_lelang_id BIGINT UNSIGNED NOT NULL,
  peserta_lelang_id BIGINT UNSIGNED NOT NULL,
  penawaran_id BIGINT UNSIGNED NOT NULL,
  harga_menang DECIMAL(15,2) NOT NULL,
  tanggal_menang DATE NOT NULL,
  status_pembayaran ENUM('belum_bayar','dp','lunas') DEFAULT 'belum_bayar',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (barang_lelang_id) REFERENCES barang_lelangs(id) ON DELETE CASCADE,
  FOREIGN KEY (peserta_lelang_id) REFERENCES peserta_lelangs(id) ON DELETE CASCADE,
  FOREIGN KEY (penawaran_id) REFERENCES penawarans(id) ON DELETE CASCADE
);

INSERT INTO barang_lelangs (nama_barang, deskripsi, harga_awal, status, tanggal_mulai, tanggal_selesai) VALUES
('Laptop Lenovo ThinkPad', 'Barang elektronik bekas kondisi baik', 3500000, 'aktif', '2026-05-19 08:00:00', '2026-05-25 16:00:00');
INSERT INTO peserta_lelangs (nama_peserta, email, no_hp, alamat, status_verifikasi) VALUES
('Ariq Setyawan', 'ariq@example.com', '081234567890', 'Bekasi', 'terverifikasi');
INSERT INTO panitias (nama_panitia, email, no_hp, jabatan) VALUES
('Admin Lelang', 'admin@example.com', '089999999999', 'Ketua Panitia');
INSERT INTO penawarans (barang_lelang_id, peserta_lelang_id, nominal_bid, waktu_bid, status_bid) VALUES
(1, 1, 3800000, '2026-05-19 10:00:00', 'tertinggi');
INSERT INTO pemenangs (barang_lelang_id, peserta_lelang_id, penawaran_id, harga_menang, tanggal_menang, status_pembayaran) VALUES
(1, 1, 1, 3800000, '2026-05-25', 'belum_bayar');
