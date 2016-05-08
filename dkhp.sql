-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2016 at 04:44 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dkhp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangdiem`
--

CREATE TABLE `bangdiem` (
  `MSSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaLop` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `HocKy` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `NamHoc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DTB` float DEFAULT NULL,
  `MaMH` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5373de78c979c2c44697840f39c16c1d27ed0bb9', '::1', 1462162733, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436323136323730313b757365725f69647c693a323b757365726e616d657c733a353a2261646d696e223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a313b69735f61646d696e7c623a313b),
('806c9104b594eb066c75c9b88e3fe62f223983a0', '::1', 1462162575, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436323136323335373b757365725f69647c693a323b757365726e616d657c733a393a227068617470726f706b223b6c6f676765645f696e7c623a313b69735f636f6e6669726d65647c623a303b69735f61646d696e7c623a303b),
('ea948a5be3b5c89048ad4b7fd32e786d43e6e55c', '::1', 1462162314, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436323136323233313b);

-- --------------------------------------------------------

--
-- Table structure for table `ct_doituong`
--

CREATE TABLE `ct_doituong` (
  `MSSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaDoiTuong` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doituong`
--

CREATE TABLE `doituong` (
  `MaDoiTuong` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenDoiTuong` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TiLeGiamHP` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `MaGV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenGV` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `HocVi` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `HocKy` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `NamHoc` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocphi`
--

CREATE TABLE `hocphi` (
  `MSSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HocKy` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `NamHoc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TongNo` decimal(8,0) DEFAULT NULL,
  `SoTienConlai` decimal(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `MaKhoa` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenKhoa` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaimonhoc`
--

CREATE TABLE `loaimonhoc` (
  `MaLoai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Tenloai` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `MaMH` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaMHTienQuyet` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaLoai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenMH` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoTinChiLT` int(11) DEFAULT NULL,
  `SoTinChiTH` int(11) DEFAULT NULL,
  `SoTietLT` int(11) DEFAULT NULL,
  `SoTietTH` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monhoctienquyet`
--

CREATE TABLE `monhoctienquyet` (
  `MaMH` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaMHTienQuyet` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `MaNganh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaKhoa` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenNganh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieudangkymonhoc`
--

CREATE TABLE `phieudangkymonhoc` (
  `MSSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaLop` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `HocKy` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `NamHoc` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phieuthu`
--

CREATE TABLE `phieuthu` (
  `MaPhieuThu` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MSSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `HocKy` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `NamHoc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `NgayThu` datetime DEFAULT NULL,
  `SoTien` decimal(8,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `MaPhong` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenPhong` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MSSV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TenSV` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NgaySinh` datetime DEFAULT NULL,
  `Tinh` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Huyen` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MaNganh` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `GioiTinh` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `TenTaiKhoan` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`TenTaiKhoan`, `MatKhau`) VALUES
('admin', '*FD89EDDC5BFF78FD805'),
('master', '*FD89EDDC5BFF78FD805'),
('phatnt.uit', '28061995P');

-- --------------------------------------------------------

--
-- Table structure for table `thamso`
--

CREATE TABLE `thamso` (
  `TenThamSo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `GiaTri` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thoikhoabieu`
--

CREATE TABLE `thoikhoabieu` (
  `MaLop` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MaGV` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaMH` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `MaPhong` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `SoLuongSV` int(11) DEFAULT NULL,
  `SoTinChi` int(11) DEFAULT NULL,
  `Thu` int(11) DEFAULT NULL,
  `HinhThu` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TietBatDau` int(11) DEFAULT NULL,
  `TietKetThuc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD PRIMARY KEY (`MSSV`,`MaLop`,`HocKy`,`NamHoc`),
  ADD KEY `FK_MaMH_BangDiem` (`MaMH`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `ct_doituong`
--
ALTER TABLE `ct_doituong`
  ADD PRIMARY KEY (`MSSV`,`MaDoiTuong`),
  ADD KEY `FK_CTDOITUONG_DOITUONG` (`MaDoiTuong`);

--
-- Indexes for table `doituong`
--
ALTER TABLE `doituong`
  ADD PRIMARY KEY (`MaDoiTuong`);

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`MaGV`);

--
-- Indexes for table `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`HocKy`,`NamHoc`);

--
-- Indexes for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD PRIMARY KEY (`MSSV`,`HocKy`,`NamHoc`),
  ADD KEY `FK_HOCPHI_HOCKY` (`HocKy`,`NamHoc`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`MaKhoa`);

--
-- Indexes for table `loaimonhoc`
--
ALTER TABLE `loaimonhoc`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaMH`),
  ADD KEY `FK_MONHOC_LOAIMONHOC` (`MaLoai`);

--
-- Indexes for table `monhoctienquyet`
--
ALTER TABLE `monhoctienquyet`
  ADD PRIMARY KEY (`MaMH`,`MaMHTienQuyet`),
  ADD KEY `FK_MONHOC_MONHOCTIENQUYET` (`MaMHTienQuyet`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`MaNganh`),
  ADD KEY `FK_NGANH_KHOA` (`MaKhoa`);

--
-- Indexes for table `phieudangkymonhoc`
--
ALTER TABLE `phieudangkymonhoc`
  ADD PRIMARY KEY (`MSSV`,`MaLop`,`HocKy`,`NamHoc`),
  ADD KEY `FK_PHIEUDANGKY_HOCKY` (`HocKy`,`NamHoc`),
  ADD KEY `FK_PHIEUDANGKY_THOIKHOABIEU` (`MaLop`);

--
-- Indexes for table `phieuthu`
--
ALTER TABLE `phieuthu`
  ADD PRIMARY KEY (`MaPhieuThu`),
  ADD KEY `FK_PHIEUTHU_SINHVIEN` (`MSSV`),
  ADD KEY `FK_PHIEUTHU_HOCKY` (`HocKy`,`NamHoc`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`MaPhong`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MSSV`),
  ADD KEY `FK_SINHVIEN_NGANH` (`MaNganh`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`TenTaiKhoan`);

--
-- Indexes for table `thamso`
--
ALTER TABLE `thamso`
  ADD PRIMARY KEY (`TenThamSo`);

--
-- Indexes for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD PRIMARY KEY (`MaLop`),
  ADD KEY `FK_THOIKHOABIEU_MONHOC` (`MaMH`),
  ADD KEY `FK_THOIKHOABIEU_PHONG` (`MaPhong`),
  ADD KEY `FK_THOIKHOABIEU_GIAOVIEN` (`MaGV`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD CONSTRAINT `FK_BANGDIEM_PHIEUDANGKY` FOREIGN KEY (`MSSV`,`MaLop`,`HocKy`,`NamHoc`) REFERENCES `phieudangkymonhoc` (`MSSV`, `MaLop`, `HocKy`, `NamHoc`),
  ADD CONSTRAINT `FK_MaMH_BangDiem` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`);

--
-- Constraints for table `ct_doituong`
--
ALTER TABLE `ct_doituong`
  ADD CONSTRAINT `FK_CTDOITUONG_DOITUONG` FOREIGN KEY (`MaDoiTuong`) REFERENCES `doituong` (`MaDoiTuong`),
  ADD CONSTRAINT `FK_CTDOITUONG_SINHVIEN` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`);

--
-- Constraints for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD CONSTRAINT `FK_HOCPHI_HOCKY` FOREIGN KEY (`HocKy`,`NamHoc`) REFERENCES `hocky` (`HocKy`, `NamHoc`),
  ADD CONSTRAINT `FK_HOCPHI_SINHVIEN` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`);

--
-- Constraints for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD CONSTRAINT `FK_MONHOC_LOAIMONHOC` FOREIGN KEY (`MaLoai`) REFERENCES `loaimonhoc` (`MaLoai`);

--
-- Constraints for table `monhoctienquyet`
--
ALTER TABLE `monhoctienquyet`
  ADD CONSTRAINT `FK_MONHOC_MONHOCTIENQUYET` FOREIGN KEY (`MaMHTienQuyet`) REFERENCES `monhoc` (`MaMH`);

--
-- Constraints for table `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `FK_NGANH_KHOA` FOREIGN KEY (`MaKhoa`) REFERENCES `khoa` (`MaKhoa`);

--
-- Constraints for table `phieudangkymonhoc`
--
ALTER TABLE `phieudangkymonhoc`
  ADD CONSTRAINT `FK_PHIEUDANGKY_HOCKY` FOREIGN KEY (`HocKy`,`NamHoc`) REFERENCES `hocky` (`HocKy`, `NamHoc`),
  ADD CONSTRAINT `FK_PHIEUDANGKY_SINHVIEN` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`),
  ADD CONSTRAINT `FK_PHIEUDANGKY_THOIKHOABIEU` FOREIGN KEY (`MaLop`) REFERENCES `thoikhoabieu` (`MaLop`);

--
-- Constraints for table `phieuthu`
--
ALTER TABLE `phieuthu`
  ADD CONSTRAINT `FK_PHIEUTHU_HOCKY` FOREIGN KEY (`HocKy`,`NamHoc`) REFERENCES `hocky` (`HocKy`, `NamHoc`),
  ADD CONSTRAINT `FK_PHIEUTHU_SINHVIEN` FOREIGN KEY (`MSSV`) REFERENCES `sinhvien` (`MSSV`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `FK_SINHVIEN_NGANH` FOREIGN KEY (`MaNganh`) REFERENCES `nganh` (`MaNganh`);

--
-- Constraints for table `thoikhoabieu`
--
ALTER TABLE `thoikhoabieu`
  ADD CONSTRAINT `FK_THOIKHOABIEU_GIAOVIEN` FOREIGN KEY (`MaGV`) REFERENCES `giaovien` (`MaGV`),
  ADD CONSTRAINT `FK_THOIKHOABIEU_MONHOC` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`),
  ADD CONSTRAINT `FK_THOIKHOABIEU_PHONG` FOREIGN KEY (`MaPhong`) REFERENCES `phong` (`MaPhong`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
