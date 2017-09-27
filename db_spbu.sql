-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 27 Sep 2017 pada 14.37
-- Versi Server: 5.7.19-0ubuntu0.17.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spbu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_fasilitas`
--

CREATE TABLE `tbl_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_fasilitas`
--

INSERT INTO `tbl_fasilitas` (`id_fasilitas`, `nama`) VALUES
(1, 'Toilet'),
(2, 'Mushola'),
(3, 'Ganti Oli'),
(4, 'Nitrogen'),
(5, 'restoran'),
(6, 'ATM'),
(7, 'kolam renang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_fasilitas_ken`
--

CREATE TABLE `tbl_fasilitas_ken` (
  `id_fasilitas` int(11) NOT NULL,
  `id_spbu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_fasilitas_ken`
--

INSERT INTO `tbl_fasilitas_ken` (`id_fasilitas`, `id_spbu`, `id_user`) VALUES
(1, 1, 0),
(1, 1, 1),
(2, 1, 0),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kendaraan`
--

CREATE TABLE `tbl_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `nama_kendaraan` varchar(20) NOT NULL,
  `jarak` int(5) NOT NULL,
  `merek` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kendaraan`
--

INSERT INTO `tbl_kendaraan` (`id_kendaraan`, `nama_kendaraan`, `jarak`, `merek`) VALUES
(1, 'Avanza', 20, 'Toyota'),
(2, 'Xenia', 25, 'Daihatsu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ken_user`
--

CREATE TABLE `tbl_ken_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ken_user`
--

INSERT INTO `tbl_ken_user` (`id`, `id_user`, `id_kendaraan`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(11) NOT NULL,
  `id_spbu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `id_spbu`, `id_user`, `rate`) VALUES
(1, 3, 1, 5),
(2, 3, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_spbu`
--

CREATE TABLE `tbl_spbu` (
  `id_spbu` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `lnglat` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `buka` time NOT NULL,
  `tutup` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_spbu`
--

INSERT INTO `tbl_spbu` (`id_spbu`, `nama`, `lnglat`, `alamat`, `buka`, `tutup`) VALUES
(1, 'SPBU 5560', '-7.9611474122827035,112.55561828613281', 'kasin', '07:00:00', '22:00:00'),
(2, 'SPBU TIDAR', '-7.9646325397584965,112.60344743728638', 'jl. Tidar', '00:00:00', '23:00:00'),
(3, 'branntas', '-7.980803992950426,112.63759732246399', 'gjhjhjhgjhgjhg', '06:00:00', '24:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `alamat`, `telp`, `email`, `username`, `password`) VALUES
(1, 'Rafi Rizaldi', 'bululawang', '1235', 'rafi@gmail.com', 'rafi', 'rafi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_fasilitas`
--
ALTER TABLE `tbl_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `tbl_fasilitas_ken`
--
ALTER TABLE `tbl_fasilitas_ken`
  ADD PRIMARY KEY (`id_fasilitas`,`id_spbu`,`id_user`),
  ADD KEY `id_spbu` (`id_spbu`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `tbl_ken_user`
--
ALTER TABLE `tbl_ken_user`
  ADD PRIMARY KEY (`id`,`id_user`,`id_kendaraan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kendaraan` (`id_kendaraan`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_spbu`
--
ALTER TABLE `tbl_spbu`
  ADD PRIMARY KEY (`id_spbu`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_fasilitas`
--
ALTER TABLE `tbl_fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_kendaraan`
--
ALTER TABLE `tbl_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_ken_user`
--
ALTER TABLE `tbl_ken_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_spbu`
--
ALTER TABLE `tbl_spbu`
  MODIFY `id_spbu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_fasilitas_ken`
--
ALTER TABLE `tbl_fasilitas_ken`
  ADD CONSTRAINT `tbl_fasilitas_ken_ibfk_1` FOREIGN KEY (`id_spbu`) REFERENCES `tbl_spbu` (`id_spbu`),
  ADD CONSTRAINT `tbl_fasilitas_ken_ibfk_2` FOREIGN KEY (`id_fasilitas`) REFERENCES `tbl_fasilitas` (`id_fasilitas`);

--
-- Ketidakleluasaan untuk tabel `tbl_ken_user`
--
ALTER TABLE `tbl_ken_user`
  ADD CONSTRAINT `tbl_ken_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`),
  ADD CONSTRAINT `tbl_ken_user_ibfk_2` FOREIGN KEY (`id_kendaraan`) REFERENCES `tbl_kendaraan` (`id_kendaraan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
