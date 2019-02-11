-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `dokumen`;
CREATE TABLE `dokumen` (
  `id_dokumen` int(11) NOT NULL AUTO_INCREMENT,
  `post_by` varchar(255) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `dokumen_file` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id_dokumen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `dokumen` (`id_dokumen`, `post_by`, `nama_dokumen`, `dokumen_file`, `create_date`) VALUES
(2,	'1',	'surat',	'20190123120154aji.docx',	'2019-01-23 00:01:54'),
(4,	'4',	'surat penting',	'20190123020240309805-beautiful-8-bit-wallpaper-2560x1440-for-iphone-6.jpg',	'2019-01-23 02:02:40'),
(5,	'1',	'dokumen',	'201901241219515_6289301657289228348.pdf',	'2019-01-24 00:19:51');

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto_pengguna` varchar(255) NOT NULL,
  `des_pengguna` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `email`, `password`, `foto_pengguna`, `des_pengguna`) VALUES
(1,	'admin',	'admin@kecamatan.com',	'4984f20f6bdf502f2090796f392cb157',	'20190122100424agumon.png',	'                                            '),
(4,	'dani',	'dani@canisnfelis.com',	'4984f20f6bdf502f2090796f392cb157',	'2019012209553034225-mothercartoon.png',	'hello world');

DROP TABLE IF EXISTS `surat_keluar`;
CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `dokumen_id` int(11) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `send_date` datetime NOT NULL,
  `message` enum('standart','perhatian','sangat penting') NOT NULL,
  PRIMARY KEY (`id_surat_keluar`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `surat_keluar` (`id_surat_keluar`, `dokumen_id`, `from`, `to`, `send_date`, `message`) VALUES
(1,	2,	'1',	'4',	'2019-01-23 00:57:26',	'standart'),
(2,	4,	'4',	'1',	'2019-01-23 02:02:51',	'sangat penting'),
(3,	2,	'1',	'4',	'2019-01-23 22:36:42',	'perhatian'),
(4,	4,	'1',	'4',	'2019-01-23 22:38:24',	'perhatian');

DROP TABLE IF EXISTS `surat_masuk`;
CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `dokumen_id` int(11) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `send_date` datetime NOT NULL,
  `status` enum('0','1') NOT NULL,
  `message` enum('standart','perhatian','sangat penting') NOT NULL,
  PRIMARY KEY (`id_surat_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `surat_masuk` (`id_surat_masuk`, `dokumen_id`, `from`, `to`, `send_date`, `status`, `message`) VALUES
(1,	2,	'1',	'4',	'2019-01-23 00:57:26',	'0',	'standart'),
(2,	4,	'4',	'1',	'2019-01-23 02:02:51',	'1',	'sangat penting'),
(5,	4,	'1',	'4',	'2019-01-23 22:38:24',	'1',	'perhatian');

-- 2019-02-08 13:08:55
