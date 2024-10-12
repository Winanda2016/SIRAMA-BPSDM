-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Okt 2024 pada 19.03
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirama_ta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_kamar`
--

CREATE TABLE `detail_transaksi_kamar` (
  `id` char(36) NOT NULL,
  `kamar_id` char(36) DEFAULT NULL,
  `transaksi_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_ruangan`
--

CREATE TABLE `detail_transaksi_ruangan` (
  `id` char(36) NOT NULL,
  `ruangan_id` char(36) DEFAULT NULL,
  `transaksi_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedung`
--

CREATE TABLE `gedung` (
  `id` char(36) NOT NULL,
  `nama_gedung` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_instansi`
--

CREATE TABLE `jenis_instansi` (
  `id` char(36) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `id` char(36) NOT NULL,
  `nomor_kamar` varchar(5) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `status` enum('terisi','kosong','perbaikan') NOT NULL,
  `gedung_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` char(36) NOT NULL,
  `komentar` text NOT NULL,
  `tanggal` date NOT NULL,
  `users_id` char(36) NOT NULL,
  `status` enum('tampil','sembunyi') NOT NULL,
  `balasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` char(36) NOT NULL,
  `nama_ruangan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `fasilitas` text DEFAULT NULL,
  `status` enum('terisi','kosong','reservasi','perbaikan') NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gedung_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` char(36) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `jinstansi_id` char(36) DEFAULT NULL,
  `tgl_reservasi` date NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `jumlah_ruangan` int(11) DEFAULT NULL,
  `status_transaksi` enum('pending','terima','tolak','kadaluwarsa','batal','checkin','checkout') NOT NULL,
  `dokumen_reservasi` varchar(200) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `diskon` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `bukti_bayar` varchar(200) DEFAULT NULL,
  `jenis_transaksi` enum('ruangan','kamar') NOT NULL,
  `users_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` enum('admin','pegawai','tamu') NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi_kamar`
--
ALTER TABLE `detail_transaksi_kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_transaksi_kamar_kamar` (`kamar_id`),
  ADD KEY `fk_detail_transaksi_kamar_transaksi` (`transaksi_id`);

--
-- Indeks untuk tabel `detail_transaksi_ruangan`
--
ALTER TABLE `detail_transaksi_ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detail_transaksi_ruangan_ruangan` (`ruangan_id`),
  ADD KEY `fk_detail_transaksi_ruangan_transaksi` (`transaksi_id`);

--
-- Indeks untuk tabel `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama_gedung` (`nama_gedung`);

--
-- Indeks untuk tabel `jenis_instansi`
--
ALTER TABLE `jenis_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kamar_gedung` (`gedung_id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_komentar_users` (`users_id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ruangan_gedung` (`gedung_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_users` (`users_id`),
  ADD KEY `fk_transaksi_instansi` (`jinstansi_id`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_kamar`
--
ALTER TABLE `detail_transaksi_kamar`
  ADD CONSTRAINT `fk_detail_transaksi_kamar_kamar` FOREIGN KEY (`kamar_id`) REFERENCES `kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi_kamar_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_ruangan`
--
ALTER TABLE `detail_transaksi_ruangan`
  ADD CONSTRAINT `fk_detail_transaksi_ruangan_ruangan` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi_ruangan_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `fk_kamar_gedung0` FOREIGN KEY (`gedung_id`) REFERENCES `gedung` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `fk_komentar_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `fk_ruangan_gedung` FOREIGN KEY (`gedung_id`) REFERENCES `gedung` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_instansi` FOREIGN KEY (`jinstansi_id`) REFERENCES `jenis_instansi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
