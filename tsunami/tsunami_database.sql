-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2025 pada 15.51
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
-- Database: `tsunami_database`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin_waver', 'admin123'),
(2, 'operator_waver', 'operator123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `judul` varchar(150) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tanggal_publikasi` date DEFAULT NULL,
  `url_gambar` varchar(255) DEFAULT NULL,
  `link_artikel_eksternal` varchar(255) DEFAULT NULL,
  `konten` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `id_admin`, `judul`, `kategori`, `tanggal_publikasi`, `url_gambar`, `link_artikel_eksternal`, `konten`) VALUES
(1, 1, 'Mitigasi Tsunami: Persiapan yang Harus Dilakukan', 'Kesiapsiagaan', '2025-11-15', 'img/mitigasi.jpg', NULL, 'Artikel lengkap tentang langkah-langkah mitigasi tsunami untuk masyarakat pesisir...'),
(2, 2, 'Sistem Peringatan Dini Tsunami di Indonesia', 'Teknologi', '2025-11-12', 'img/peringatan-dini.jpg', NULL, 'Penjelasan tentang sistem peringatan dini tsunami yang diterapkan di Indonesia...'),
(3, 1, 'Kisah Selamat dari Tsunami Palu 2025', 'Kisah Inspiratif', '2025-11-08', 'img/kisah-palu.jpg', NULL, 'Kisah inspiratif warga yang selamat dari tsunami Palu dengan mengikuti prosedur evakuasi...');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kejadian`
--

CREATE TABLE `kejadian` (
  `id_kejadian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `magnitudo` decimal(4,2) DEFAULT NULL,
  `kedalaman` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kejadian`
--

INSERT INTO `kejadian` (`id_kejadian`, `tanggal`, `lokasi`, `magnitudo`, `kedalaman`, `status`, `deskripsi`) VALUES
(1, '2025-11-10', 'Palu, Sulawesi Tengah', 6.90, 10, 'Aktif', 'Tsunami menerjang pesisir Palu setelah gempa berkekuatan 6.9 SR. Gelombang mencapai ketinggian 3 meter. Evakuasi sedang berlangsung.'),
(2, '2025-11-05', 'Mentawai, Sumatera Barat', 7.10, 15, 'Pemantauan', 'Gempa berkekuatan 7.1 SR memicu peringatan tsunami. Warga diimbau mengungsi ke tempat aman. Status waspada tinggi.'),
(3, '2025-10-30', 'Aceh Besar', 6.80, 12, 'Selesai', 'Gempa di laut menyebabkan gelombang kecil. Tidak ada kerusakan signifikan. Status sudah normal.'),
(4, '2025-10-25', 'Bengkulu', 6.50, 8, 'Selesai', 'Tsunami kecil terdeteksi di perairan Bengkulu. Tidak ada korban jiwa. Kondisi sudah stabil.'),
(5, '2025-10-18', 'Selat Sunda', 6.70, 5, 'Selesai', 'Aktivitas vulkanik dan gempa menyebabkan gelombang tinggi di Selat Sunda. Transportasi laut sempat terganggu.'),
(6, '2025-10-12', 'Banda Aceh', 7.30, 20, 'Pemantauan', 'Gempa besar memicu peringatan tsunami. Evakuasi dilakukan secara menyeluruh. Monitoring intensif.'),
(7, '2025-10-08', 'Lombok, NTB', 6.60, 11, 'Aktif', 'Gempa Lombok memicu peringatan tsunami level 2. Warga pesisir diungsikan. Bantuan sedang dikordinir.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'user1', 'user123'),
(2, 'user2', 'user123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `volunteer`
--

CREATE TABLE `volunteer` (
  `id_volunteer` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nomor_telpon` varchar(20) DEFAULT NULL,
  `id_kejadian` int(11) DEFAULT NULL,
  `alamat_lengkap` text DEFAULT NULL,
  `usia` int(11) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `pengalaman` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `volunteer`
--

INSERT INTO `volunteer` (`id_volunteer`, `nama`, `email`, `nomor_telpon`, `id_kejadian`, `alamat_lengkap`, `usia`, `alasan`, `pengalaman`) VALUES
(1, 'Ahmad Wijaya', 'ahmad@email.com', '081234567890', 1, 'Jl. Merdeka No. 123, Palu', 28, 'Ingin membantu sesama yang terdampak tsunami', 'Pernah menjadi relawan bencana gempa 2023'),
(2, 'Siti Rahayu', 'siti@email.com', '081298765432', 1, 'Jl. Sudirman No. 45, Palu', 25, 'Peduli dengan korban bencana alam', 'Berpengalaman di bidang logistik'),
(3, 'Budi Santoso', 'budi@email.com', '081345678901', 2, 'Jl. Diponegoro No. 67, Mentawai', 30, 'Siap membantu evakuasi warga', 'Pelatihan SAR dasar'),
(4, 'Maya Sari', 'maya@email.com', '081376543210', 2, 'Jl. Gatot Subroto No. 89, Mentawai', 27, 'Ingin memberikan dukungan psikologis', 'Psikolog dengan spesialisasi trauma'),
(5, 'Rizki Pratama', 'rizki@email.com', '081456789012', 7, 'Jl. Majapahit No. 34, Lombok', 32, 'Berkontribusi untuk masyarakat Lombok', 'Pengalaman 5 tahun di organisasi kemanusiaan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `kejadian`
--
ALTER TABLE `kejadian`
  ADD PRIMARY KEY (`id_kejadian`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`id_volunteer`),
  ADD KEY `id_kejadian` (`id_kejadian`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kejadian`
--
ALTER TABLE `kejadian`
  MODIFY `id_kejadian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `id_volunteer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`id_kejadian`) REFERENCES `kejadian` (`id_kejadian`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
