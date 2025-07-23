-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2025 pada 09.12
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengaduan_masyarakat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `masyarakat_id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `foto_selesai` varchar(255) DEFAULT NULL,
  `status` enum('pending','proses','selesai') DEFAULT 'pending',
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `masyarakat_id`, `isi`, `foto`, `foto_selesai`, `status`, `tanggal`) VALUES
(1, 2, 'jalan rusak parah', 'Gambar WhatsApp 2024-10-30 pukul 11.17.43_0e2a2ddd.jpg', NULL, 'proses', '2025-07-22 01:37:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` int(11) NOT NULL,
  `pengaduan_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id`, `pengaduan_id`, `petugas_id`, `isi`, `tanggal`, `foto`) VALUES
(1, 1, 3, 'sedang tahap pengerjaan', '2025-07-21 00:00:00', NULL),
(7, 1, 4, 'sedang dalam proses', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('masyarakat','petugas','admin') DEFAULT 'masyarakat',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '$2a$12$Z5Ul3EI.6/69HpqciTZo1eQmZTBVgwn7CKHXJcODnKxM3r1YUNczm', 'admin', '2025-07-22 19:52:03'),
(2, 'Cahya Aji Saputra', 'aji', '$2y$10$1Vkd9HVRTZZuMZKOUhRNZ.tA3dQXDM3iSkJ4EufaQbFY0kvVzZBjW', 'masyarakat', '2025-07-22 19:52:03'),
(3, 'agus', 'agus', '$2y$10$.4VSK5nV/60BvFlQwSDIi.E7lg1tKB06kCrZWV1WoLwtx3WPHvtZG', 'petugas', '2025-07-22 19:52:03'),
(4, 'Nur Audina Fatimah', 'audina', '$2y$10$NgHU8j/hjfaD6cBudQDY2uxieGeL6t8QFAWvSSY.0Ytmx9I3cpVBe', 'petugas', '2025-07-22 20:28:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masyarakat_id` (`masyarakat_id`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pengaduan` (`pengaduan_id`),
  ADD KEY `id_petugas` (`petugas_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`masyarakat_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
