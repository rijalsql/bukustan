-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Apr 2026 pada 18.30
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
-- Database: `bukustan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `denda_per_hari` int(11) DEFAULT 2000,
  `penulis` varchar(45) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `kategori` enum('Kitab','Novel','Cerita','Ilmu','Teknik') DEFAULT 'Cerita',
  `harga` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `stok`, `denda_per_hari`, `penulis`, `foto`, `kategori`, `harga`) VALUES
(12, 'Selalu Ada Ruang Untuk Pulang', 41, 20000, 'Karima Ifha', '1776449896_8d27842442f25d486c3c.jpg', NULL, 0),
(13, 'Sanusi', 12, 20000, 'Imam Nawawi Al Bantani', '1776449413_23bc83af0073d67d1652.jpg', 'Kitab', 0),
(14, 'riyadul badiah', 22, 20000, 'Syekh Muhammad bin Sulaiman Hasbullah', '1776449550_a4c003b49f45cd95c1a2.jpg', 'Kitab', 0),
(15, 'Safinatun Najah', 23, 20000, 'Syekh Salim bin Abdullah bin Sa\'ad bin Sumair', '1776449674_e50542b73817c613a2d7.jpg', 'Kitab', 0),
(16, 'Laut Bercerita', 22, 20000, 'Leila S. Chudori', '1776449794_70a352ecbfdcfee93c76.jpg', 'Novel', 0),
(18, 'Malin Kundang', 23, 20000, 'Dian K', '1776450181_acf76867c0f64fa04758.jpeg', 'Cerita', 0),
(19, 'Timun Mas', 34, 2000, 'Genderwo', '1776450224_7a730e1416be45e582ff.jpg', 'Cerita', 0),
(20, 'Joko kendil', 42, 20000, 'Jokowii', '1776450277_27772e97294b8553c561.jpg', 'Cerita', 0),
(21, 'Filsafat Ilmu Pengetahuan', 34, 20000, 'Amaliah Kadir M.pd', '1776450382_5e475c6b8a5d5bd27bdd.jpg', 'Ilmu', 0),
(22, 'Ilmu Debat', 24, 20000, 'Muhammad Nuruddin', '1776450422_7b04ebc68e146c1e598b.jpg', 'Ilmu', 0),
(23, 'Ilmu Maqulat', 44, 20000, 'Muhammad Nuruddin', '1776450480_192c56fe045cc18bcf4d.jpg', 'Ilmu', 0),
(24, 'Buya Hamka', 44, 20000, 'A Fuadi', '1776450543_3e9a1b888cbf229ef1cd.jpg', 'Novel', 0),
(25, 'Rinjani', 43, 20000, 'Nabila N Harris', '1776450622_88d68374d003790c777f.jpg', 'Novel', 0),
(26, 'Manajemen Teknik', 47, 2000, 'Sriyono D Siswoyo ', '1776450736_9f0216f67439a5019801.jpg', 'Teknik', 0),
(27, 'Dasar Teknik Digital', 40, 20000, 'Ahmad Yanie S.T.M.T', '1776450792_46fec1348b5efebbaa72.jpg', 'Teknik', 0),
(28, 'Gambar Teknik', 12, 20000, 'Istiana Adianti S.T.,M.Sc', '1776450861_ff9c4e5f544e52bd2a59.jpg', 'Teknik', 0),
(34, 'Bumi Manusia', 17, 20000, 'Pramoedya Ananta Toer', '1776699815_19a185a6c8e517340b13.jpg', 'Novel', 0),
(35, 'Ta\'lim al-Muta\'allim Tariq al-Ta\'allum', 19, 20000, 'Syekh Burhanuddin Ibrahim bin Ismail az-Zarnu', '1776700022_348e1e702a97851fc427.jpg', 'Kitab', 0),
(36, 'Malin Kundang', 21, 20000, 'Dian Aprilia Dewi', '1776700146_685715bb034224630b7c.jpg', 'Cerita', 0),
(37, 'Ilmu Negara', 22, 20000, 'Dr.Mohammad Syaiful Aris S.H.,M.H.,LLM.', '1776700281_cb89a1415ab8fb4ca1f5.jpg', 'Ilmu', 0),
(38, 'Teknik Sepeda Motor', 22, 20000, 'Drs Daryanto', '1776700392_3270b66d65c048929598.jpg', 'Teknik', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_dikembalikan` date DEFAULT NULL,
  `total_denda` int(11) DEFAULT 0,
  `status` enum('pending_pinjam','dipinjam','pending_kembali','kembali') DEFAULT 'pending_pinjam',
  `rating` enum('1','2','3','4','5') DEFAULT NULL,
  `ulasan` text DEFAULT NULL,
  `denda` int(11) DEFAULT 0,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status_bayar` enum('belum','proses','lunas') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `id_user`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `tgl_dikembalikan`, `total_denda`, `status`, `rating`, `ulasan`, `denda`, `bukti_bayar`, `status_bayar`) VALUES
(19, 6, 2, '2026-04-16', '2026-04-23', '2026-04-16', 0, 'kembali', '', NULL, 0, NULL, 'belum'),
(20, 6, 2, '2026-04-17', '2026-04-24', '2026-04-17', 0, 'kembali', '', NULL, 0, NULL, 'belum'),
(28, 5, 2, '2026-04-17', '2026-04-24', NULL, 0, 'dipinjam', NULL, NULL, 0, NULL, 'belum'),
(57, 6, 24, '2026-04-20', '2026-04-27', NULL, 0, '', NULL, NULL, 0, NULL, 'belum'),
(58, 6, 27, '2026-04-20', '2026-04-27', NULL, 0, '', NULL, NULL, 0, NULL, 'belum'),
(64, 7, 38, '2026-04-06', '2026-04-07', NULL, 0, '', NULL, NULL, 0, NULL, 'belum'),
(65, 7, 48, '2026-04-20', '2026-04-27', NULL, 0, 'dipinjam', NULL, NULL, 0, NULL, 'belum'),
(68, 7, 37, '2026-04-20', '2026-04-27', NULL, 0, '', NULL, NULL, 0, NULL, 'belum'),
(74, 7, 37, '2026-04-21', '2026-04-28', '2026-04-21', 0, 'kembali', '5', 'keren', 0, NULL, 'belum'),
(75, 7, 38, '2026-04-01', '2026-04-06', '2026-04-21', 30000, 'kembali', '5', '', 0, NULL, 'belum'),
(76, 7, 35, '2026-04-07', '2026-04-09', NULL, 24000, 'kembali', '5', 'gagah', 0, '1776755428_da5793086831aab754d9.jpg', 'lunas'),
(77, 7, 36, '2026-04-07', '2026-04-09', NULL, 24000, 'kembali', '5', 'maap telat', 0, '1776755509_497da04a8170178e6376.jpg', 'lunas'),
(78, 6, 37, '2026-04-21', '2026-04-28', NULL, 0, 'kembali', '5', '', 0, NULL, 'belum'),
(79, 6, 35, '2026-04-21', '2026-04-28', NULL, 0, 'kembali', '5', 'gagah', 0, NULL, 'belum'),
(80, 6, 34, '2026-04-01', '2026-04-08', NULL, 26000, 'kembali', '5', '', 0, '1776782817_71340a232ee028f5379b.jpg', 'lunas'),
(81, 6, 27, '2026-04-08', '2026-04-13', NULL, 0, 'pending_kembali', NULL, NULL, 0, '1776783061_279bf0ede8d03dd29a22.jpg', 'lunas'),
(82, 6, 20, '2026-04-01', '2026-04-07', NULL, 0, 'dipinjam', NULL, NULL, 0, '1776783199_bda5ec39bb363c712522.jpg', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','anggota') DEFAULT 'anggota',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `role`, `foto`, `status`, `created_at`) VALUES
(5, 'ijall', 'rijalatantowi@gmail.com', 'ijall', '$2y$10$JEOcCYwavqfWwSNdIoHvUelnLPUH4UfpSruvn9tw9TmDrdc2GoIO.', 'admin', '1775966822_394d3145720c2c5a9fb9.jpg', 'aktif', '2026-04-12 04:07:02'),
(6, 'ganjar', 'ganjarkejer@gmail.com', 'ganjar', '$2y$10$lj0MabwURt06N2sNrlB7Wex9KSzVazNbhv.MwhkLdllrceHWh39xK', 'anggota', '1776414362_0a2acc690650ae4f3aca.jpg', 'aktif', '2026-04-16 01:52:47'),
(7, 'Lisa Black Pink', 'Lisssaaaaa@gmail.com', 'Lisa', '$2y$10$kI7VmizxOF1ivhOO8IZyKevqBZD6I2DU4vYuqNNmG.AS7QTnxhrrO', 'anggota', '1776414472_6ddda2e6caf5b5aafa77.jpg', 'aktif', '2026-04-17 06:31:46'),
(8, 'nizma', 'rijalatantowi@gmail.com', 'ima', '$2y$10$72487hkdGXd5Ts.c9EMKj.ThE6FJgddsMD7mBzCOWvG0h9P5zjaMu', 'admin', '1776703310_fa9d669e1000abffd33f.jpg', 'aktif', '2026-04-20 16:41:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
