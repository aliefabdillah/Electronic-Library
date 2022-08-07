/*
 Navicat Premium Data Transfer

 Source Server         : MyConnection
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : db_e-library

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 16/06/2022 20:19:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_anggota
-- ----------------------------
DROP TABLE IF EXISTS `tbl_anggota`;
CREATE TABLE `tbl_anggota`  (
  `id_anggota` int NOT NULL AUTO_INCREMENT,
  `kode_anggota` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_aktif` date NOT NULL,
  PRIMARY KEY (`id_anggota`) USING BTREE,
  UNIQUE INDEX `kode_anggota`(`kode_anggota`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_anggota
-- ----------------------------
INSERT INTO `tbl_anggota` VALUES (1, 'MB001', '32042800132022', 'Rendra Sujono', 'rendrasuj@gmail.com', 'Jl. kenangan 3 no 25 Jakarta Barat', '088281828022', '2023-04-07');
INSERT INTO `tbl_anggota` VALUES (2, 'MB002', '32042800132532', 'Valentini Rossa', 'rosivalen@gmail.com', 'Jl. Borneo 3 No 38 RT 09 RW 10 Kabupaten Bandung', '088283223030', '2022-10-07');
INSERT INTO `tbl_anggota` VALUES (3, 'MB003', '32042800132432', 'Ramadhan Hadi', 'hadiramadhan@gmail.com', 'Desa Sukamakmur Kota Tangerang', '082112280441', '2023-05-05');
INSERT INTO `tbl_anggota` VALUES (10, 'MB004', '', 'Alief Abdillah', 'aliefmabdillah09@gmail.com', 'Griya Utama Rancaekek\r\nJl. Borneo 2 no 38', '082215760138', '2022-06-10');

-- ----------------------------
-- Table structure for tbl_biblio
-- ----------------------------
DROP TABLE IF EXISTS `tbl_biblio`;
CREATE TABLE `tbl_biblio`  (
  `id_biblio` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_buku` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pengarang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `penerbit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `thn_terbit` year NULL DEFAULT NULL,
  `bahasa` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isbn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jmlh_buku` int NULL DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_biblio`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_biblio
-- ----------------------------
INSERT INTO `tbl_biblio` VALUES ('BBL001', '551.8.SUD.S.100', 'Alphabetical Ordering', 'Dadang Bambang', 'Sinar Dunia', 2005, 'Indonesia', '929-2939-212-3', 'Aljabar', 3, '97dc72b5690142e50b8b820cf7973394.jpg');
INSERT INTO `tbl_biblio` VALUES ('BBL1', '519.6.KAD.P.3', 'Pemrograman Database dengan Delphi7 Menggunakan Access ADO', 'Abdul Kadir', 'Penerbit Andi', 2004, 'Indonesia', '979-731-631-9', 'Komputer', 3, 'Pemrograman Database dengan Delphi7 Menggunakan Access ADO.jpg');
INSERT INTO `tbl_biblio` VALUES ('BBL2', '519.Mun.M.1', 'Matematika Diskrit', 'Rinaldi Munir', 'Informatika', 2012, 'Indonesia', '978-602-6232-13-7', 'Terapan/Komputer', 3, 'Matematika Diskrit.jpg');
INSERT INTO `tbl_biblio` VALUES ('BBL3', '512.5.Leo.A.10', 'Aljabar Linear dan Aplikasinya Edisi 5', 'Steven J. Leon', 'Erlangga', 2001, 'Indonesia', '979-688-173', 'Aljabar', 2, 'Aljabar Linear dan Aplikasinya (Edisi 5)l.jpg');
INSERT INTO `tbl_biblio` VALUES ('BBL4', '519.6.Str.T.1', 'the C++ Programming Language third edition', 'Bjarne Stroustrup', 'AT&T Labs', 1997, 'Inggris', ' 0-201-70073-5', 'Komputer', 1, 'the C++ Programming Language third edition.jpg');

-- ----------------------------
-- Table structure for tbl_koleksi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_koleksi`;
CREATE TABLE `tbl_koleksi`  (
  `id_koleksi` int NOT NULL AUTO_INCREMENT,
  `kode_koleksi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_biblio` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_reg` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `posisi_rak` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kondisi` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_koleksi`) USING BTREE,
  UNIQUE INDEX `kode_koleksi`(`kode_koleksi`) USING BTREE,
  INDEX `id_biblio`(`id_biblio`) USING BTREE,
  CONSTRAINT `tbl_koleksi_ibfk_1` FOREIGN KEY (`id_biblio`) REFERENCES `tbl_biblio` (`id_biblio`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_koleksi
-- ----------------------------
INSERT INTO `tbl_koleksi` VALUES (1, 'KOL001', 'BBL1', 'REF000', 'RAK-111', 'Tidak Dapat Dipinjam', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (2, 'KOL002', 'BBL1', 'REG0001', 'RAK-112', 'Tersedia', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (3, 'KOL003', 'BBL1', 'REG0002', 'RAK-115', 'Tersedia', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (4, 'KOL004', 'BBL2', 'REF000', 'RAK-211', 'Tidak Dapat Dipinjam', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (5, 'KOL005', 'BBL2', 'REG0003', 'RAK-221', 'Dipinjam', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (6, 'KOL006', 'BBL2', 'REG0004', 'RAK-114', 'Tersedia', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (7, 'KOL007', 'BBL3', 'REF000', 'RAK-222', 'Tidak Dapat Dipinjam', 'Kurang Baik');
INSERT INTO `tbl_koleksi` VALUES (8, 'KOL008', 'BBL3', 'REG0005', 'RAK-213', 'Tersedia', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (9, 'KOL009', 'BBL4', 'REF000', 'RAK-225', 'Tidak Dapat Dipinjam', 'Baik');
INSERT INTO `tbl_koleksi` VALUES (10, 'KOL0010', 'BBL4', 'REG0006', 'RAK-235', 'Tersedia', 'Kurang Baik');

-- ----------------------------
-- Table structure for tbl_login
-- ----------------------------
DROP TABLE IF EXISTS `tbl_login`;
CREATE TABLE `tbl_login`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_login
-- ----------------------------
INSERT INTO `tbl_login` VALUES (5, 'Alrida Arjuna', 'alridajuna@gmail.com', 'e0d86dbc19718ca5a6ab5d7f3277464f', 1);
INSERT INTO `tbl_login` VALUES (8, 'Rojali Ihcsan', 'rojaliihscan@gmail.com', 'e0d86dbc19718ca5a6ab5d7f3277464f', 2);
INSERT INTO `tbl_login` VALUES (9, 'Rojali Ihcsan', 'aliefmabdillah09@upi.edu', 'e0d86dbc19718ca5a6ab5d7f3277464f', 2);
INSERT INTO `tbl_login` VALUES (11, 'Alief Abdillah', 'aliefmabdillah09@gmail.com', 'e62dcca729b685cade1a5fae7b458d05', 2);

-- ----------------------------
-- Table structure for tbl_sirkulasi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sirkulasi`;
CREATE TABLE `tbl_sirkulasi`  (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `judul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_pinjam` date NULL DEFAULT NULL,
  `tgl_kembali` date NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_anggota` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_koleksi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE,
  UNIQUE INDEX `nomor_transaksi`(`kode_transaksi`) USING BTREE,
  UNIQUE INDEX `no_transaksi`(`kode_transaksi`) USING BTREE,
  INDEX `id_anggota`(`kode_anggota`) USING BTREE,
  INDEX `id_koleksi`(`kode_koleksi`) USING BTREE,
  CONSTRAINT `tbl_sirkulasi_ibfk_2` FOREIGN KEY (`kode_koleksi`) REFERENCES `tbl_koleksi` (`kode_koleksi`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 60 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_sirkulasi
-- ----------------------------
INSERT INTO `tbl_sirkulasi` VALUES (32, 'TR-21052022-001', 'Pemrograman Database dengan Delphi7 Menggunakan Access ADO', '2022-05-28', '2022-05-29', 'Dikembalikan', 'MB001', 'KOL002');
INSERT INTO `tbl_sirkulasi` VALUES (33, 'TR-21052022-002', 'Pemrograman Database dengan Delphi7 Menggunakan Access ADO', '2022-06-04', '2022-06-11', 'Dikembalikan', 'MB003', 'KOL002');
INSERT INTO `tbl_sirkulasi` VALUES (38, 'TR-21052022-005', 'Matematika Diskrit', '2022-05-31', '2022-06-04', 'Dipinjam', 'MB001', 'KOL005');
INSERT INTO `tbl_sirkulasi` VALUES (41, 'TR-22052022-006', 'the C++ Programming Language third edition', '2022-05-15', '2022-05-20', 'Dipinjam', 'MB002', 'KOL0010');
INSERT INTO `tbl_sirkulasi` VALUES (52, 'TR-01062022-007', 'Aljabar Linear dan Aplikasinya Edisi 5', '2022-06-01', '2022-06-02', 'Not Accepted', 'MB004', 'KOL008');

SET FOREIGN_KEY_CHECKS = 1;
