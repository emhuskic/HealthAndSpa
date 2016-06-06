-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 30, 2016 at 09:11 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eminawt`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tekst` text,
  `Autor_id` int(11) DEFAULT NULL,
  `Vijest_id` int(11) DEFAULT NULL,
  `Vrijeme` datetime DEFAULT NULL,
  `AnonimniKorisnik` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `Tekst`, `Autor_id`, `Vijest_id`, `Vrijeme`, `AnonimniKorisnik`) VALUES
(1, 'Neki komentar na ovu novu objavejst kerimove slike hahahaha ', 1, 8, '2016-05-30 15:44:00', NULL),
(2, 'Neki komentar na ovu novu objavejst kerimove slike mamamamamamamama', 1, 8, '2016-05-30 15:46:00', NULL),
(3, ' Novi komentar', 1, 8, '2016-05-30 08:00:50', NULL),
(4, ' i ja komentarisem', 0, 8, '2016-05-30 08:04:40', 'Neko nekovic'),
(5, ' i ja komentarisem', 0, 8, '2016-05-30 08:05:24', 'Neko nekovic'),
(6, ' Komentar', 1, 9, '2016-05-30 09:02:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `komentarodgovor`
--

CREATE TABLE IF NOT EXISTS `komentarodgovor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Tekst` text,
  `Autor_id` int(11) DEFAULT NULL,
  `Komentar_id` int(11) DEFAULT NULL,
  `Vrijeme` datetime DEFAULT NULL,
  `AnonimniKorisnik` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `komentarodgovor`
--

INSERT INTO `komentarodgovor` (`id`, `Tekst`, `Autor_id`, `Komentar_id`, `Vrijeme`, `AnonimniKorisnik`) VALUES
(1, 'ODgovor na komentar', 1, 1, '2016-05-30 05:30:00', NULL),
(2, '', 0, 1, '2016-05-30 08:49:27', 'Neko'),
(3, ' Novi komentar', 0, 1, '2016-05-30 08:50:37', 'Novi'),
(4, ' Novi odgovor', 0, 1, '2016-05-30 08:54:42', 'Neko nekovic'),
(5, ' Odgovor', 1, 6, '2016-05-30 09:02:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) DEFAULT NULL,
  `Prezime` varchar(20) DEFAULT NULL,
  `BrojTelefona` varchar(20) DEFAULT NULL,
  `Username` varchar(20) DEFAULT NULL,
  `Password` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `Ime`, `Prezime`, `BrojTelefona`, `Username`, `Password`) VALUES
(1, 'Kerim', 'Balic', '062257026', 'kerim', 'ac27a3e30b1c11701b5fe3bfbd28ed24');

-- --------------------------------------------------------

--
-- Table structure for table `obavijest`
--

CREATE TABLE IF NOT EXISTS `obavijest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(200) DEFAULT NULL,
  `Tekst` text,
  `Vrijeme` datetime DEFAULT NULL,
  `Autor_id` int(11) DEFAULT NULL,
  `Slika` varchar(300) DEFAULT NULL,
  `Komentari` bit(1) DEFAULT NULL,
  `Drzava` varchar(20) DEFAULT NULL,
  `Telefon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `obavijest`
--

INSERT INTO `obavijest` (`id`, `Naslov`, `Tekst`, `Vrijeme`, `Autor_id`, `Slika`, `Komentari`, `Drzava`, `Telefon`) VALUES
(1, 'rrr', ' fff', '2016-05-30 15:43:33', 1, 'slike/kerim/kerim.jpg', NULL, NULL, NULL),
(2, 'Naslov', ' Tekast', '2016-05-30 15:45:55', 1, 'slike/kerim/kerim.jpg', NULL, NULL, NULL),
(3, 'f', ' f', '2016-05-30 15:49:24', 1, 'slike/kerim/kerim.jpg', NULL, NULL, NULL),
(4, 'e', ' d', '2016-05-30 15:50:09', 1, 'slike/kerim/kerim.jpg', NULL, NULL, NULL),
(5, 'Kerim', ' kkkkkk', '2016-05-30 16:00:14', 1, 'slike/kerim/kerim.jpg', NULL, NULL, NULL),
(6, 'Novi', ' gg', '2016-05-30 16:03:46', 1, 'slike/kerim/1620663_10203221120074035_155597304_n.jpg', NULL, 'ba', '062'),
(7, 'Kerim', ' ff', '2016-05-30 16:05:05', 1, 'slike/kerim/paranoia-image04.jpg', NULL, 'ba', ''),
(8, 'Ide nova', ' Znaci friska slika i ovo je neki tekst o ovoj sliki je li vam jasno ako nije nema problema ali volio bih da em razumijete.', '2016-05-30 17:36:22', 1, 'slike/kerim/10435004_10204458353604100_420585321168093488_n.jpg', '1', 'ba', '062257026'),
(9, 'Novi sa komentarima', ' Novi post sa komentarima', '2016-05-30 21:02:28', 1, 'slike/kerim/10435004_10204458353604100_420585321168093488_n.jpg', '1', 'ba', ''),
(10, 'Bez komentara', ' Post bez komentara', '2016-05-30 21:03:29', 1, 'slike/kerim/paranoia-image04.jpg', '1', 'ba', ''),
(11, 'bez opet', ' bez', '2016-05-30 21:04:43', 1, 'slike/kerim/paranoia-image04.jpg', '1', 'ba', ''),
(12, 'bb', ' dd', '2016-05-30 21:08:40', 1, 'slike/kerim/1620663_10203221120074035_155597304_n.jpg', '1', 'ba', ''),
(13, 'fff', ' gg', '2016-05-30 21:09:56', 1, 'slike/kerim/paranoia-image04.jpg', '0', 'ba', ''),
(14, 'sa', ' tt', '2016-05-30 21:10:25', 1, 'slike/kerim/kerim.jpg', '1', 'ba', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
