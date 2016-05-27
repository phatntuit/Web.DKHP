-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2016 at 09:29 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CHECK_LOGIN` (IN `ID` VARCHAR(12), IN `PWD` VARCHAR(60), OUT `ERROR` VARCHAR(60), OUT `CK` INT, OUT `Qout` VARCHAR(12))  BEGIN
  DECLARE r int;
    DECLARE p varchar(60);
  SELECT count(Manguoidung) into r
    FROM nguoidung
    WHERE Manguoidung=ID;
    IF r=0 THEN SET ERROR="Wrong ID";SET CK=0;SET Qout="None";
    ELSE
      SELECT Matkhau into p
        from nguoidung
        where Manguoidung=ID;
        IF p=PWD 
        THEN 
          SELECT Tenquyen into Qout 
            FROM nguoidung ng,quyendangnhap q
            WHERE ng.Quyen=q.Maquyen and Manguoidung=ID;
          SET ERROR="None";SET CK=1;
        ELSE 
          SET ERROR="Wrong password";SET CK=0;
        END IF;
    END IF; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getmamhcuahocphan` (IN `malop` VARCHAR(12), OUT `mamh` VARCHAR(12))  NO SQL
SELECT hocphan.Mamonhoc INTO mamh
FROM hocphan
WHERE hocphan.Malop=malop$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getmamhdadangky` (IN `mssv` VARCHAR(12), IN `mahk` VARCHAR(12), IN `manh` VARCHAR(12), OUT `mamh` VARCHAR(12))  NO SQL
SELECT hocphan.Mamonhoc into mamh
FROM hocphan,ct_phieudangky
WHERE hocphan.Malop=ct_phieudangky.Malop AND ct_phieudangky.Mssv=mssv AND ct_phieudangky.Manamhoc=manh and ct_phieudangky.Mahocky=mahk$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getsucchua` (IN `maphong` VARCHAR(12))  NO SQL
SELECT phong.Succhua,phong.Loaiphong
FROM phong
WHERE phong.Maphong=maphong$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Gettinchi` (IN `Mamonhoc` VARCHAR(12), IN `hinhthuc` VARCHAR(12), OUT `tc` INT)  BEGIN
    IF hinhthuc='LT'
    THEN
        select Sotinchi_lt into tc
        from monhoc mh
        where mh.Mamonhoc=Mamonhoc;
    ELSE
      select mh.Sotinchi_th into tc
        from monhoc mh
        where mh.Mamonhoc;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_CHAR` (IN `NAMHOC` VARCHAR(12), OUT `CH` VARCHAR(2))  BEGIN
  SELECT namhoc.Character INTO CH
    FROM namhoc
    WHERE namhoc.Tennamhoc=NAMHOC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_GV` ()  NO SQL
SELECT Magiaovien,Tengiaovien,Tenhocvi,Gioitinh,Ngaysinh,Diachi,Dienthoai,Email
FROM giaovien gv,hocvi hv
WHERE gv.Mahocvi=hv.Mahocvi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_SV` ()  NO SQL
SELECT Mssv,Hoten,Gioitinh,Ngaysinh,Quequan,Tennganh,Makhoahoc
FROM sinhvien sv,nganh ng
WHERE sv.Manganh=ng.Manganh$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_THAMSO` ()  NO SQL
SELECT thamso.Hocky,thamso.Namhoc,thamso.Ngaybatdaudk,thamso.Ngayketthucdk
FROM thamso
ORDER BY id DESC
LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `join_hocphan` ()  NO SQL
SELECT hp.Malop,mh.Tenmonhoc,k.Tenkhoa,g.Tengiaovien,hp.Maphong,nh.Tennamhoc,hk.Tenhocky,hp.Thu,hp.Tietbatdau,hp.Tietketthuc,hp.Cachtuan,hp.Sotinchi,hp.Hinhthuc,hp.Sisodukien,hp.Ngaybatdau,hp.Ngayketthuc
FROM khoa k,hocphan hp,giaovien g,hocky hk,monhoc mh,namhoc nh
WHERE g.Magiaovien=hp.Magiaovien and hp.Mahocky=hk.Mahocky and k.Makhoa=hp.Makhoa and hp.Mamonhoc=mh.Mamonhoc and nh.Manamhoc=hp.Manamhoc$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kiemtramalop` (IN `malop` VARCHAR(12), OUT `xn` INT)  NO SQL
SELECT COUNT(hocphan.Malop) as xn
FROM hocphan
WHERE hocphan.Malop=malop$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `kiemtraphongtrong` (IN `mahocky` VARCHAR(12), IN `manamhoc` VARCHAR(12), IN `thu` VARCHAR(12), IN `maphong` VARCHAR(12), IN `tietbd` INT, IN `tietkt` INT)  NO SQL
SELECT COUNT(Malop) as row_count FROM hocphan
WHERE hocphan.Manamhoc=manamhoc and hocphan.Mahocky=mahocky AND hocphan.Maphong=maphong and hocphan.Thu=thu AND (hocphan.Tietbatdau=tietbd OR hocphan.Tietketthuc=tietkt OR hocphan.Tietbatdau=tietkt OR hocphan.Tietketthuc=tietbd OR (hocphan.Tietbatdau<tietbd AND hocphan.Tietketthuc>tietkt)OR(hocphan.Tietbatdau>tietbd AND hocphan.Tietketthuc<tietkt))$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `KT_SL` (IN `MALOP` VARCHAR(12), OUT `CK` INT)  BEGIN
  DECLARE SISO INT;
    DECLARE SISODK INT;
    SELECT HP.Sisohientai,HP.Sisodukien into SISO,SISODK
    FROM hocphan HP
    WHERE HP.Malop=MALOP;
    IF SISO = SISODK THEN SET CK=1;
    ELSE SET CK=0;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `KT_TH` (IN `mamonhoc` VARCHAR(12), OUT `ck` INT)  BEGIN 
  DECLARE tcth int;
    SELECT monhoc.Sotinchi_th INTO tcth
    FROM monhoc
    WHERE monhoc.Mamonhoc=mamonhoc;
    IF tcth=0 THEN SET ck=0;
    ELSE SET ck=1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test` (IN `t` INT)  IF @t>3 THEN SELECT "Case 1";
ELSE SELECT "Case 3";
end if$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `test_2` (IN `Mamonhoc` VARCHAR(60))  BEGIN
  IF @Mamonhoc='SS001'
    THEN
    SELECT "Case 1";
    ELSE SELECT "Case 2";
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TEST_IF` (IN `PARA` INT)  BEGIN
  IF PARA=1 
    THEN
      SELECT "case 1";
        ELSE SELECT * FROM sinhvien;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bangdiem`
--

CREATE TABLE `bangdiem` (
  `Mssv` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Manamhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mahocky` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mamonhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Malop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Diem` float(4,2) NOT NULL
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

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_daicuong`
--

CREATE TABLE `ctdt_daicuong` (
  `Makhoahoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mamonhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Hocky` int(11) DEFAULT NULL,
  `Ghichu` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ctdt_nganh`
--

CREATE TABLE `ctdt_nganh` (
  `Makhoahoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Manganh` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mamonhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Hocky` int(11) DEFAULT NULL,
  `Ghichu` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ct_phieudangky`
--

CREATE TABLE `ct_phieudangky` (
  `MaCT` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `MaDK` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Malop` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Triggers `ct_phieudangky`
--
DELIMITER $$
CREATE TRIGGER `AFTER_CT_PHIEUDANGKY_DELETE` AFTER DELETE ON `ct_phieudangky` FOR EACH ROW BEGIN
  DECLARE MADK VARCHAR(12);
    DECLARE MALOP VARCHAR(12);
    DECLARE MAHK VARCHAR(12);
    DECLARE MANH VARCHAR(12);
    DECLARE MSSV VARCHAR(12);
    DECLARE MAMH VARCHAR(12);
    DECLARE HINHTHUC VARCHAR(12);
    DECLARE SOTC INT;
    DECLARE SOTIEN DECIMAL(10,2);
    DECLARE HOCPHI DECIMAL(10,2);
    DECLARE TONGTC INT;
    DECLARE HPTC DECIMAL(10,2);
    
    SET MADK=OLD.MaDK;
    SET MALOP=OLD.Malop;
    
    SELECT DK.Mahocky,DK.Manamhoc,DK.Mssv,DK.Tongsotinchi,DK.Hocphitamtinh INTO MAHK,MANH,MSSV,TONGTC,HOCPHI FROM phieudangky DK WHERE DK.MaDK=MADK;
    
    SELECT HP.Mamonhoc,HP.Sotinchi,HP.Hinhthuc INTO MAMH,SOTC,HINHTHUC FROM hocphan HP WHERE HP.Malop=MALOP AND HP.Manamhoc=MANH AND HP.Mahocky=MAHK;
    
    SELECT TS.Tientinchi INTO HPTC FROM thamso TS WHERE TS.Hocky=MAHK AND TS.Namhoc=MANH;
    
    IF HINHTHUC="LT" THEN SET SOTIEN=SOTC*HPTC;
    ELSE SET SOTIEN=SOTC*2*HPTC;
    END IF;
    
    UPDATE `phieudangky`
    SET `Tongsotinchi`=TONGTC-SOTC,`Hocphitamtinh`=HOCPHI-SOTIEN
    WHERE `MaDK`=MADK;
    
    DELETE FROM bangdiem WHERE bangdiem.Mssv=MSSV AND bangdiem.Mamonhoc=MAMH AND bangdiem.Mahocky=MAHK AND bangdiem.Manamhoc=MANH;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AFTER_CT_PHIEUDANGKY_INSERT` AFTER INSERT ON `ct_phieudangky` FOR EACH ROW BEGIN
  DECLARE MADK VARCHAR(12);
    DECLARE MALOP VARCHAR(12);
    DECLARE MAHK VARCHAR(12);
    DECLARE MANH VARCHAR(12);
    DECLARE MSSV VARCHAR(12);
    DECLARE MAMH VARCHAR(12);
    DECLARE HINHTHUC VARCHAR(12);
    DECLARE SOTC INT;
    DECLARE SOTIEN DECIMAL(10,2);
    DECLARE HOCPHI DECIMAL(10,2);
    DECLARE TONGTC INT;
    DECLARE HPTC DECIMAL(10,2);
    
    SET MADK=NEW.MaDK;
    SET MALOP=NEW.Malop;
    
    SELECT DK.Mahocky,DK.Manamhoc,DK.Mssv,DK.Tongsotinchi,DK.Hocphitamtinh INTO MAHK,MANH,MSSV,TONGTC,HOCPHI FROM phieudangky DK WHERE DK.MaDK=MADK;
    
    SELECT HP.Mamonhoc,HP.Sotinchi,HP.Hinhthuc INTO MAMH,SOTC,HINHTHUC FROM hocphan HP WHERE HP.Malop=MALOP AND HP.Manamhoc=MANH AND HP.Mahocky=MAHK;
    
    SELECT TS.Tientinchi INTO HPTC FROM thamso TS WHERE TS.Hocky=MAHK AND TS.Namhoc=MANH;
    
    IF HINHTHUC="LT" THEN SET SOTIEN=SOTC*HPTC;
    ELSE SET SOTIEN=SOTC*2*HPTC;
    END IF;
    
    UPDATE `phieudangky`
    SET `Tongsotinchi`=TONGTC+SOTC,`Hocphitamtinh`=HOCPHI+SOTIEN
    WHERE `MaDK`=MADK;
    
    INSERT INTO `bangdiem`(`Mssv`, `Manamhoc`, `Mahocky`, `Mamonhoc`, `Malop`) VALUES(MSSV,MANH,MAHK,MAMH,MALOP);

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `doituong`
--

CREATE TABLE `doituong` (
  `Madoituong` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tendoituong` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Tilegiam_hp` float(3,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giaovien`
--

CREATE TABLE `giaovien` (
  `Magiaovien` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tengiaovien` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Mahocvi` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Gioitinh` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Ngaysinh` date NOT NULL,
  `Diachi` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Dienthoai` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giaovien`
--

INSERT INTO `giaovien` (`Magiaovien`, `Tengiaovien`, `Mahocvi`, `Gioitinh`, `Ngaysinh`, `Diachi`, `Dienthoai`, `Email`) VALUES
('GV0001', 'Nguyễn Thành Thật', 'HV001', 'Nam', '1986-05-08', 'Tây Ninh', '0932090009', 'thatnt@uit.edu.vn'),
('GV0002', 'Nguyễn Thành Tín', 'HV001', 'Nam', '1976-05-09', 'Tây Ninh', '0932090567', 'tintnt@uit.edu.vn'),
('GV0003', 'Nguyễn Thị Nhật', 'HV002', 'Nữ', '1973-05-09', 'Tây Ninh', '0989090009', 'nhatnt@uit.edu.vn'),
('GV0004', 'Nguyễn Thị Kim Phụng', 'HV001', 'Nữ', '1982-05-09', 'TP.HCM', '0969090009', 'phungntk@uit.edu.vn'),
('GV0005', 'Phát Nguyễn', 'HV001', 'Nam', '1990-05-25', 'Thủ Đức', '0985305846', '13520604@gm.uit.edu.vn'),
('GV0006', 'Test', 'HV003', 'Nam', '1992-05-24', 'Tây Ninh', '01234567890', '13520604@gm.uit.edu.vn'),
('GV0007', 'Test 2', 'HV003', 'Nam', '1990-05-22', 'Tay Ninh', '0989099099', 'phatnt.uit@gmail.com'),
('GV0008', 'Phat', 'HV001', 'Nam', '1969-05-22', 'Tay Ninh', '0909000099', '13520604@gm.uit.edu.vn'),
('GV0009', 'test', 'HV003', 'Nam', '1926-05-30', 'sdgdfjkh', '0128900090', '13520604@gm.uit.edu.vn');

-- --------------------------------------------------------

--
-- Table structure for table `hocky`
--

CREATE TABLE `hocky` (
  `Mahocky` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocky`
--

INSERT INTO `hocky` (`Mahocky`) VALUES
('HK1'),
('HK2'),
('HK3');

-- --------------------------------------------------------

--
-- Table structure for table `hocphan`
--

CREATE TABLE `hocphan` (
  `Malop` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mamonhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Makhoa` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Magiaovien` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Maphong` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Manamhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mahocky` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Thu` int(11) DEFAULT NULL,
  `Tietbatdau` int(11) DEFAULT NULL,
  `Tietketthuc` int(11) NOT NULL,
  `Cachtuan` int(11) DEFAULT NULL,
  `Sotinchi` int(11) DEFAULT NULL,
  `Hinhthuc` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `Sisodukien` int(11) NOT NULL,
  `Ngaybatdau` date NOT NULL,
  `Ngayketthuc` date NOT NULL,
  `Sisohientai` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocphan`
--

INSERT INTO `hocphan` (`Malop`, `Mamonhoc`, `Makhoa`, `Magiaovien`, `Maphong`, `Manamhoc`, `Mahocky`, `Thu`, `Tietbatdau`, `Tietketthuc`, `Cachtuan`, `Sotinchi`, `Hinhthuc`, `Sisodukien`, `Ngaybatdau`, `Ngayketthuc`, `Sisohientai`) VALUES
('EN001.F21', 'EN001', 'HTTT', 'GV0004', 'C310', '2016-2017', 'HK2', 3, 1, 5, 1, 4, 'LT', 40, '2016-05-01', '2016-05-31', 0),
('IS008.G31', 'IT008', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 4, 4, 5, 0, 2, 'LT', 50, '2016-09-02', '2016-12-22', 13),
('IS201.G32', 'IS201', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 2, 1, 3, 0, 4, 'LT', 50, '2016-09-02', '2016-12-22', 50),
('IS207.G31', 'IS207', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 3, 1, 3, 0, 4, 'LT', 50, '2016-09-02', '2016-12-22', 50),
('IS217.G32', 'IS217', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 3, 1, 3, 0, 4, 'LT', 50, '2016-09-02', '2016-12-22', 45),
('IS334.G31', 'IS334', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 4, 1, 3, 0, 4, 'LT', 50, '2016-09-02', '2016-12-22', 50),
('IS351.G31.1', 'IS351', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 4, 1, 4, 1, 1, 'TH', 50, '2016-09-02', '2016-12-22', 13),
('MA001.G32', 'MA001', 'HTTT', 'GV0002', 'C107', '2016-2017', 'HK1', 2, 1, 3, 0, 4, 'LT', 50, '2016-09-02', '2016-12-22', 13),
('SS001.F21', 'SS001', 'HTTT', 'GV0002', 'C310', '2016-2017', 'HK2', 2, 1, 5, 1, 4, 'LT', 50, '2016-05-01', '2016-05-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hocphi`
--

CREATE TABLE `hocphi` (
  `Mssv` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Manamhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mahocky` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Hocphi` decimal(10,2) NOT NULL,
  `Sotiendadong` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Sotienconlai` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hocvi`
--

CREATE TABLE `hocvi` (
  `Mahocvi` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tenhocvi` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hocvi`
--

INSERT INTO `hocvi` (`Mahocvi`, `Tenhocvi`) VALUES
('HV001', 'Thạc sĩ'),
('HV002', 'Tiến sĩ'),
('HV003', 'Cử nhân');

-- --------------------------------------------------------

--
-- Table structure for table `khoa`
--

CREATE TABLE `khoa` (
  `Makhoa` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tenkhoa` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoa`
--

INSERT INTO `khoa` (`Makhoa`, `Tenkhoa`) VALUES
('HTTT', 'Hệ Thống Thông Tin');

-- --------------------------------------------------------

--
-- Table structure for table `khoahoc`
--

CREATE TABLE `khoahoc` (
  `Makhoahoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Thoigiandaicuong` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khoahoc`
--

INSERT INTO `khoahoc` (`Makhoahoc`, `Thoigiandaicuong`) VALUES
('KH008', 2);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc`
--

CREATE TABLE `monhoc` (
  `Mamonhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tenmonhoc` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sotinchi_lt` int(11) DEFAULT NULL,
  `Sotinchi_th` int(11) DEFAULT '0',
  `Sotinchi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `monhoc`
--

INSERT INTO `monhoc` (`Mamonhoc`, `Tenmonhoc`, `Sotinchi_lt`, `Sotinchi_th`, `Sotinchi`) VALUES
('EN001', 'Anh Văn 1', 4, 0, 4),
('EN002', 'Anh Văn 2', 4, 0, 4),
('EN003', 'Anh Văn 3', 4, 0, 4),
('IS201', 'Phân tích thiết kế hệ thống thông tin', 3, 1, 4),
('IS207', 'Phát triển ứng dụng web', 3, 1, 4),
('IS210', 'Hệ quản trị cơ sở dữ liệu', 3, 1, 4),
('IS217', 'Kho dữ liệu và Olap', 3, 1, 4),
('IS252', 'Khai thác dữ liệu', 3, 1, 4),
('IS254', 'Hệ hỗ trợ ra quyết định', 3, 0, 3),
('IS334', 'Thương mại điện tử', 3, 0, 3),
('IS351', 'Phân tích không gian', 3, 1, 4),
('IS403', 'Phân tích dữ liệu kinh doanh', 3, 0, 3),
('IT002', 'Lập trình hướng đối tượng', 3, 1, 4),
('IT003', 'Cấu trúc dữ liệu và giải thuật', 3, 1, 4),
('IT004', 'Cơ sở dữ liệu', 3, 1, 4),
('IT005', 'Nhập môn mạng máy tính', 3, 1, 4),
('IT006', 'Kiến trúc máy tính', 3, 0, 3),
('IT007', 'Hệ điều hành', 3, 1, 4),
('IT008', 'Giới thiệu ngành', 2, 0, 2),
('MA001', 'Giải tích 1', 3, 0, 3),
('MA002', 'Giải tích 2', 3, 0, 3),
('SE104', 'Nhập môn CNPM', 3, 1, 4),
('SE401', 'Công nghệ .NET', 3, 1, 4),
('SS001', 'Những nguyên lí cơ bản Mac-Lenin', 5, 0, 5),
('SS002', 'Đường lối cách mạng Đang CSVN', 3, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `monhoc_tienquyet`
--

CREATE TABLE `monhoc_tienquyet` (
  `Mamonhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mamonhoc_tq` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `namhoc`
--

CREATE TABLE `namhoc` (
  `Manamhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Character` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `namhoc`
--

INSERT INTO `namhoc` (`Manamhoc`, `Character`) VALUES
('2016-2017', 'H'),
('2017-2018', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `nganh`
--

CREATE TABLE `nganh` (
  `Manganh` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Makhoa` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Tennganh` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nganh`
--

INSERT INTO `nganh` (`Manganh`, `Makhoa`, `Tennganh`) VALUES
('NG001', 'HTTT', 'Thương Mại Điện Tử');

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `Manguoidung` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Matkhau` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Quyen` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`Manguoidung`, `Matkhau`, `Email`, `Quyen`) VALUES
('13520543', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'MQ002'),
('13520604', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'MQ002'),
('13520686', 'e10adc3949ba59abbe56e057f20f883e', '13520686@gm.uit.edu.vn', 'MQ002'),
('admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, 'MQ001');

-- --------------------------------------------------------

--
-- Table structure for table `phieudangky`
--

CREATE TABLE `phieudangky` (
  `MaDK` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mssv` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Manamhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mahocky` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tongsotinchi` int(11) NOT NULL DEFAULT '0',
  `Hocphitamtinh` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phieudangky`
--

INSERT INTO `phieudangky` (`MaDK`, `Mssv`, `Manamhoc`, `Mahocky`, `Tongsotinchi`, `Hocphitamtinh`) VALUES
('DK001', '13520049', '2016-2017', 'HK2', 0, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `phieuthu`
--

CREATE TABLE `phieuthu` (
  `Maphieuthu` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mssv` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Hocky` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Namhoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Ngaythu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Sotien` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `Maphong` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Succhua` int(11) DEFAULT NULL,
  `Loaiphong` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'LT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`Maphong`, `Succhua`, `Loaiphong`) VALUES
('C107', 50, 'LT'),
('C310', 50, 'LT');

-- --------------------------------------------------------

--
-- Table structure for table `quyendangnhap`
--

CREATE TABLE `quyendangnhap` (
  `Maquyen` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Tenquyen` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quyendangnhap`
--

INSERT INTO `quyendangnhap` (`Maquyen`, `Tenquyen`) VALUES
('MQ001', 'ADMIN'),
('MQ002', 'SV');

-- --------------------------------------------------------

--
-- Table structure for table `sinhvien`
--

CREATE TABLE `sinhvien` (
  `Mssv` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Hoten` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Gioitinh` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Ngaysinh` date NOT NULL,
  `Quequan` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Manganh` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Makhoahoc` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Manguoidung` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sinhvien`
--

INSERT INTO `sinhvien` (`Mssv`, `Hoten`, `Gioitinh`, `Ngaysinh`, `Quequan`, `Manganh`, `Makhoahoc`, `Manguoidung`) VALUES
('13520049', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13520404', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13520543', 'Nguyễn Trọng Nghĩa', 'Nam', '1995-10-28', 'Đồng Nai', 'NG001', 'KH008', '13520543'),
('13520604', 'Nguyễn Tấn Phát', 'Nam', '1995-06-28', 'Tây Ninh', 'NG001', 'KH008', '13520604'),
('13520686', 'Vòng Anh Quyền', 'Nam', '1995-10-05', 'Đồng Nai', 'NG001', 'KH008', '13520686'),
('13520704', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13520764', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13520794', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13520799', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13521704', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604'),
('13526704', 'Phương Tài', 'Nam', '1995-06-28', 'Bình Thuận', 'NG001', 'KH008', '13520604');

-- --------------------------------------------------------

--
-- Table structure for table `sv_dt`
--

CREATE TABLE `sv_dt` (
  `Mssv` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Madoituong` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thamso`
--

CREATE TABLE `thamso` (
  `id` int(11) NOT NULL,
  `Hocky` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Namhoc` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Ngaybatdaudk` date NOT NULL,
  `Ngayketthucdk` date NOT NULL,
  `Sotinchitoithieu` int(11) NOT NULL DEFAULT '13',
  `Sotinchitoida` int(11) NOT NULL DEFAULT '30',
  `Tientinchi` decimal(10,2) NOT NULL DEFAULT '180000.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thamso`
--

INSERT INTO `thamso` (`id`, `Hocky`, `Namhoc`, `Ngaybatdaudk`, `Ngayketthucdk`, `Sotinchitoithieu`, `Sotinchitoida`, `Tientinchi`) VALUES
(1, 'HK2', '2016-2017', '2016-05-01', '2016-05-31', 13, 30, '180000.00'),
(2, 'HK3', '2016-2017', '2016-07-01', '2016-08-31', 13, 30, '180000.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD PRIMARY KEY (`Mssv`,`Mahocky`,`Manamhoc`,`Mamonhoc`),
  ADD KEY `fk_bangdiem_mahocky` (`Mahocky`),
  ADD KEY `fk_bangdiem_manamhoc` (`Manamhoc`),
  ADD KEY `fk_bangdiem_mamonhoc` (`Mamonhoc`),
  ADD KEY `fk_bangdiem_malop` (`Malop`);

--
-- Indexes for table `ctdt_daicuong`
--
ALTER TABLE `ctdt_daicuong`
  ADD PRIMARY KEY (`Makhoahoc`,`Mamonhoc`),
  ADD KEY `fk_mamhdc` (`Mamonhoc`);

--
-- Indexes for table `ctdt_nganh`
--
ALTER TABLE `ctdt_nganh`
  ADD PRIMARY KEY (`Makhoahoc`,`Manganh`,`Mamonhoc`),
  ADD KEY `fk_manganh` (`Manganh`),
  ADD KEY `fk_mamh` (`Mamonhoc`);

--
-- Indexes for table `ct_phieudangky`
--
ALTER TABLE `ct_phieudangky`
  ADD PRIMARY KEY (`MaCT`,`MaDK`,`Malop`),
  ADD KEY `fk_ct_phieudangky_madk` (`MaDK`),
  ADD KEY `fk_ct_phieudangky_malop` (`Malop`);

--
-- Indexes for table `doituong`
--
ALTER TABLE `doituong`
  ADD PRIMARY KEY (`Madoituong`);

--
-- Indexes for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD PRIMARY KEY (`Magiaovien`),
  ADD KEY `fk_mahocvi` (`Mahocvi`);

--
-- Indexes for table `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`Mahocky`);

--
-- Indexes for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD PRIMARY KEY (`Malop`),
  ADD KEY `fk_manamhoc` (`Manamhoc`),
  ADD KEY `fk_mahocky` (`Mahocky`),
  ADD KEY `fk_magiaovien` (`Magiaovien`),
  ADD KEY `fk_maphong` (`Maphong`),
  ADD KEY `fk_mamonhochp` (`Mamonhoc`),
  ADD KEY `fk_makhoahp` (`Makhoa`);

--
-- Indexes for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD PRIMARY KEY (`Mssv`,`Manamhoc`,`Mahocky`),
  ADD KEY `fk_manamhoc_hocphi` (`Manamhoc`),
  ADD KEY `fk_mahocky_hocphi` (`Mahocky`);

--
-- Indexes for table `hocvi`
--
ALTER TABLE `hocvi`
  ADD PRIMARY KEY (`Mahocvi`);

--
-- Indexes for table `khoa`
--
ALTER TABLE `khoa`
  ADD PRIMARY KEY (`Makhoa`);

--
-- Indexes for table `khoahoc`
--
ALTER TABLE `khoahoc`
  ADD PRIMARY KEY (`Makhoahoc`);

--
-- Indexes for table `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`Mamonhoc`);

--
-- Indexes for table `monhoc_tienquyet`
--
ALTER TABLE `monhoc_tienquyet`
  ADD PRIMARY KEY (`Mamonhoc`,`Mamonhoc_tq`),
  ADD KEY `fk_mamonhoctd` (`Mamonhoc_tq`);

--
-- Indexes for table `namhoc`
--
ALTER TABLE `namhoc`
  ADD PRIMARY KEY (`Manamhoc`);

--
-- Indexes for table `nganh`
--
ALTER TABLE `nganh`
  ADD PRIMARY KEY (`Manganh`),
  ADD KEY `fk_makhoa` (`Makhoa`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`Manguoidung`),
  ADD KEY `fk_maquyen_BANGDIEM` (`Quyen`);

--
-- Indexes for table `phieudangky`
--
ALTER TABLE `phieudangky`
  ADD PRIMARY KEY (`MaDK`),
  ADD KEY `fk_mssv_phieudangky` (`Mssv`),
  ADD KEY `fk_manamhoc_phieudangky` (`Manamhoc`),
  ADD KEY `fk_mahocky_phieudangky` (`Mahocky`);

--
-- Indexes for table `phieuthu`
--
ALTER TABLE `phieuthu`
  ADD PRIMARY KEY (`Maphieuthu`),
  ADD KEY `fk_mssv_phieuthu` (`Mssv`),
  ADD KEY `fk_namhoc_phieuthu` (`Namhoc`),
  ADD KEY `fk_hocky_phieuthu` (`Hocky`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`Maphong`);

--
-- Indexes for table `quyendangnhap`
--
ALTER TABLE `quyendangnhap`
  ADD PRIMARY KEY (`Maquyen`);

--
-- Indexes for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`Mssv`),
  ADD KEY `fk_manganh_sinhvien` (`Manganh`),
  ADD KEY `fk_makhoahoc_sinhvien` (`Makhoahoc`),
  ADD KEY `fk_manguoidung_sinhvien` (`Manguoidung`);

--
-- Indexes for table `sv_dt`
--
ALTER TABLE `sv_dt`
  ADD PRIMARY KEY (`Mssv`,`Madoituong`),
  ADD KEY `fk_madoituong_svdt` (`Madoituong`);

--
-- Indexes for table `thamso`
--
ALTER TABLE `thamso`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD CONSTRAINT `fk_bangdiem_mahocky` FOREIGN KEY (`Mahocky`) REFERENCES `hocky` (`Mahocky`),
  ADD CONSTRAINT `fk_bangdiem_malop` FOREIGN KEY (`Malop`) REFERENCES `hocphan` (`Malop`),
  ADD CONSTRAINT `fk_bangdiem_mamonhoc` FOREIGN KEY (`Mamonhoc`) REFERENCES `monhoc` (`Mamonhoc`),
  ADD CONSTRAINT `fk_bangdiem_manamhoc` FOREIGN KEY (`Manamhoc`) REFERENCES `namhoc` (`Manamhoc`),
  ADD CONSTRAINT `fk_bangdiem_mssv` FOREIGN KEY (`Mssv`) REFERENCES `sinhvien` (`Mssv`);

--
-- Constraints for table `ctdt_daicuong`
--
ALTER TABLE `ctdt_daicuong`
  ADD CONSTRAINT `fk_makhoahocdc` FOREIGN KEY (`Makhoahoc`) REFERENCES `khoahoc` (`Makhoahoc`),
  ADD CONSTRAINT `fk_mamhdc` FOREIGN KEY (`Mamonhoc`) REFERENCES `monhoc` (`Mamonhoc`);

--
-- Constraints for table `ctdt_nganh`
--
ALTER TABLE `ctdt_nganh`
  ADD CONSTRAINT `fk_makhoahoc` FOREIGN KEY (`Makhoahoc`) REFERENCES `khoahoc` (`Makhoahoc`),
  ADD CONSTRAINT `fk_mamh` FOREIGN KEY (`Mamonhoc`) REFERENCES `monhoc` (`Mamonhoc`),
  ADD CONSTRAINT `fk_manganh` FOREIGN KEY (`Manganh`) REFERENCES `nganh` (`Manganh`);

--
-- Constraints for table `ct_phieudangky`
--
ALTER TABLE `ct_phieudangky`
  ADD CONSTRAINT `fk_ct_phieudangky_madk` FOREIGN KEY (`MaDK`) REFERENCES `phieudangky` (`MaDK`),
  ADD CONSTRAINT `fk_ct_phieudangky_malop` FOREIGN KEY (`Malop`) REFERENCES `hocphan` (`Malop`);

--
-- Constraints for table `giaovien`
--
ALTER TABLE `giaovien`
  ADD CONSTRAINT `fk_mahocvi` FOREIGN KEY (`Mahocvi`) REFERENCES `hocvi` (`Mahocvi`);

--
-- Constraints for table `hocphan`
--
ALTER TABLE `hocphan`
  ADD CONSTRAINT `fk_magiaovien` FOREIGN KEY (`Magiaovien`) REFERENCES `giaovien` (`Magiaovien`),
  ADD CONSTRAINT `fk_mahocky` FOREIGN KEY (`Mahocky`) REFERENCES `hocky` (`Mahocky`),
  ADD CONSTRAINT `fk_makhoahp` FOREIGN KEY (`Makhoa`) REFERENCES `khoa` (`Makhoa`),
  ADD CONSTRAINT `fk_mamonhochp` FOREIGN KEY (`Mamonhoc`) REFERENCES `monhoc` (`Mamonhoc`),
  ADD CONSTRAINT `fk_manamhoc` FOREIGN KEY (`Manamhoc`) REFERENCES `namhoc` (`Manamhoc`),
  ADD CONSTRAINT `fk_maphong` FOREIGN KEY (`Maphong`) REFERENCES `phong` (`Maphong`);

--
-- Constraints for table `hocphi`
--
ALTER TABLE `hocphi`
  ADD CONSTRAINT `fk_mahocky_hocphi` FOREIGN KEY (`Mahocky`) REFERENCES `hocky` (`Mahocky`),
  ADD CONSTRAINT `fk_manamhoc_hocphi` FOREIGN KEY (`Manamhoc`) REFERENCES `namhoc` (`Manamhoc`),
  ADD CONSTRAINT `fk_mssv_hocphi` FOREIGN KEY (`Mssv`) REFERENCES `sinhvien` (`Mssv`);

--
-- Constraints for table `monhoc_tienquyet`
--
ALTER TABLE `monhoc_tienquyet`
  ADD CONSTRAINT `fk_mamonhoc` FOREIGN KEY (`Mamonhoc`) REFERENCES `monhoc` (`Mamonhoc`),
  ADD CONSTRAINT `fk_mamonhoctd` FOREIGN KEY (`Mamonhoc_tq`) REFERENCES `monhoc` (`Mamonhoc`);

--
-- Constraints for table `nganh`
--
ALTER TABLE `nganh`
  ADD CONSTRAINT `fk_makhoa` FOREIGN KEY (`Makhoa`) REFERENCES `khoa` (`Makhoa`);

--
-- Constraints for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `fk_maquyen_BANGDIEM` FOREIGN KEY (`Quyen`) REFERENCES `quyendangnhap` (`Maquyen`);

--
-- Constraints for table `phieudangky`
--
ALTER TABLE `phieudangky`
  ADD CONSTRAINT `fk_mahocky_phieudangky` FOREIGN KEY (`Mahocky`) REFERENCES `hocky` (`Mahocky`),
  ADD CONSTRAINT `fk_manamhoc_phieudangky` FOREIGN KEY (`Manamhoc`) REFERENCES `namhoc` (`Manamhoc`),
  ADD CONSTRAINT `fk_mssv_phieudangky` FOREIGN KEY (`Mssv`) REFERENCES `sinhvien` (`Mssv`);

--
-- Constraints for table `phieuthu`
--
ALTER TABLE `phieuthu`
  ADD CONSTRAINT `fk_hocky_phieuthu` FOREIGN KEY (`Hocky`) REFERENCES `hocky` (`Mahocky`),
  ADD CONSTRAINT `fk_mssv_phieuthu` FOREIGN KEY (`Mssv`) REFERENCES `sinhvien` (`Mssv`),
  ADD CONSTRAINT `fk_namhoc_phieuthu` FOREIGN KEY (`Namhoc`) REFERENCES `namhoc` (`Manamhoc`);

--
-- Constraints for table `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `fk_makhoahoc_sinhvien` FOREIGN KEY (`Makhoahoc`) REFERENCES `khoahoc` (`Makhoahoc`),
  ADD CONSTRAINT `fk_manganh_sinhvien` FOREIGN KEY (`Manganh`) REFERENCES `nganh` (`Manganh`),
  ADD CONSTRAINT `fk_manguoidung_sinhvien` FOREIGN KEY (`Manguoidung`) REFERENCES `nguoidung` (`Manguoidung`);

--
-- Constraints for table `sv_dt`
--
ALTER TABLE `sv_dt`
  ADD CONSTRAINT `fk_madoituong_svdt` FOREIGN KEY (`Madoituong`) REFERENCES `doituong` (`Madoituong`),
  ADD CONSTRAINT `fk_mssv_svdt` FOREIGN KEY (`Mssv`) REFERENCES `sinhvien` (`Mssv`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
