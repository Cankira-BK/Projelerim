-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 02 Oca 2026, 02:03:15
-- Sunucu sürümü: 10.5.26-MariaDB
-- PHP Sürümü: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `nuyacom_site`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_categories`
--

CREATE TABLE `admin_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL,
  `user_id` int(2) NOT NULL DEFAULT 0,
  `user_name` varchar(80) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `admin_log`
--

INSERT INTO `admin_log` (`id`, `user_id`, `user_name`, `content`, `date`) VALUES
(84, 1, 'Admin', 'Giriş Yaptı', '2025-11-23 18:36:34'),
(83, 1, 'Admin', 'Giriş Yaptı', '2025-10-07 19:49:10'),
(82, 1, 'Admin', 'Giriş Yaptı', '2025-08-27 11:41:00'),
(81, 1, 'Admin', 'Giriş Yaptı', '2025-08-27 02:19:44');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `api_kasagame`
--

CREATE TABLE `api_kasagame` (
  `SiparisID` int(20) NOT NULL,
  `Kullanici` varchar(24) NOT NULL,
  `Fiyat` varchar(250) NOT NULL,
  `EPMiktar` varchar(250) NOT NULL,
  `IPAdresi` varchar(255) NOT NULL,
  `Tarih` datetime NOT NULL,
  `Durum` varchar(255) NOT NULL DEFAULT 'NO',
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `api_paytr`
--

CREATE TABLE `api_paytr` (
  `id` int(11) NOT NULL,
  `KullaniciID` varchar(24) NOT NULL,
  `EPMiktar` varchar(250) NOT NULL,
  `IPAdresi` varchar(255) NOT NULL,
  `Tarih` datetime NOT NULL,
  `Durum` varchar(255) NOT NULL DEFAULT 'NO'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `api_paywant`
--

CREATE TABLE `api_paywant` (
  `ID` int(11) NOT NULL,
  `SiparisID` int(11) NOT NULL DEFAULT 0,
  `UserID` int(11) NOT NULL DEFAULT 0,
  `ReturnData` varchar(255) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 0,
  `OdemeKanali` tinyint(4) NOT NULL DEFAULT 0,
  `OdemeTutari` double NOT NULL DEFAULT 0,
  `NetKazanc` double NOT NULL DEFAULT 0,
  `ExtraData` varchar(255) DEFAULT NULL,
  `Tarih` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `api_teckcard`
--

CREATE TABLE `api_teckcard` (
  `ID` int(11) NOT NULL,
  `SiparisID` varchar(150) DEFAULT NULL,
  `UserID` int(11) NOT NULL DEFAULT 0,
  `UserName` varchar(255) DEFAULT NULL,
  `ExtraData` int(11) NOT NULL DEFAULT 0,
  `Status` int(3) NOT NULL DEFAULT 0,
  `Tarih` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `autopatcher`
--

CREATE TABLE `autopatcher` (
  `id` int(3) NOT NULL,
  `type` enum('HABER','SLIDER','MENU') DEFAULT 'HABER',
  `label` enum('1','2','3','4','5','6') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `tarih` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `autopatcher`
--

INSERT INTO `autopatcher` (`id`, `type`, `label`, `title`, `url`, `image`, `content`, `tarih`) VALUES
(1, 'MENU', NULL, 'TANITIM', NULL, NULL, 'Server hakkında bilgi edinin. Tıklayın.', '2021-01-27 06:57:17'),
(2, 'MENU', NULL, 'KAYIT OL', NULL, NULL, 'Henüz kayıt olmadınız mı? Hemen Tıkla Kayıt Ol!', '2021-01-27 06:57:17'),
(3, 'MENU', NULL, 'DESTEK MERKEZİ', NULL, NULL, 'Sorun mu yaşıyorsunuz? Çözümü burada.', '2021-01-27 06:57:17'),
(4, 'MENU', NULL, 'DUYURULAR', NULL, NULL, 'Etkinlik ve duyuruları takip etmek için tıklayınız.', '2021-01-27 06:57:17'),
(5, 'MENU', NULL, 'FORUM', NULL, NULL, 'Herhangi bir konu hakkında tartışmak veya öneride mi bulunmak istiyorsunuz? Tıklayın.', '2021-01-27 06:57:17'),
(6, 'MENU', NULL, 'NESNE MARKET', NULL, NULL, 'Kostüm, başlık, pet vb almak istiyor musunuz?', '2021-01-27 06:57:17'),
(7, 'MENU', NULL, 'FACEBOOK GRUP', NULL, NULL, 'Sohbet Muhabbet etmek istiyorsanız. Tıklayın.', '2021-01-27 06:57:17'),
(8, 'MENU', NULL, 'FACEBOOK SAYFASI', NULL, NULL, 'Sorun mu bildirmek istiyorsunuz? Tıklayın.', '2021-01-27 06:57:17');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banner`
--

CREATE TABLE `banner` (
  `id` int(3) NOT NULL,
  `type` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `content` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `banner`
--

INSERT INTO `banner` (`id`, `type`, `image`, `title`, `content`) VALUES
(1, '0', 'https://gf3.geo.gfsrv.net/cdn85/73710b0e9893be93562199eaa5f21d.jpg', 'Simya Efsun Nesnesi nesne markette', 'Ejderha Taşı Simyası için tasarlanmış yeni efsun nesnesi ile simyalarızın efsununu değiştirip, yeniden dönüştürmüş gibi efsunlayabilirsiniz.'),
(2, '1', 'https://gf2.geo.gfsrv.net/cdn78/26c8a254118d6bbbd8ae871744024e.jpg', 'Metin2 Nesne Marketi', 'Ejderhalara layık kampanya ürünleri'),
(3, '0', 'https://gf3.geo.gfsrv.net/cdnbb/48143cd4b941ca5e7383049f1646f3.jpg', 'Hazine avcılarının dikkatine!', 'Aramaların bir sonu var: Şimdi Dükkan\'da gizemli Babil hazinesini keşfet, bunu adım adım geliştir ve nadir Grifon petler, ritüel taşları gibi akla hay'),
(4, '0', 'https://gf3.geo.gfsrv.net/cdn5c/17d4dc6ce00fb6ae7cee2eb4dbf4d5.jpg', 'Noel şahane geçecek', '30.11. tarihinden itibaren okey kart oyunu ve yepyeni etkinliklerle süslenmiş maceralara atıl. Tombala veya kader çarkında kazan ve Dükkan\'dan eşsiz k');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ban_list`
--

CREATE TABLE `ban_list` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `why` varchar(255) DEFAULT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 2,
  `who` varchar(255) NOT NULL DEFAULT 'Admin'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ep_log`
--

CREATE TABLE `ep_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `aid` int(11) NOT NULL DEFAULT 0,
  `pid` int(11) NOT NULL DEFAULT 0,
  `name` varchar(64) DEFAULT NULL,
  `what` longtext DEFAULT NULL,
  `item_vnum` int(11) NOT NULL DEFAULT 0,
  `item_name` varchar(24) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ep_price`
--

CREATE TABLE `ep_price` (
  `id` int(5) NOT NULL,
  `ep` int(11) NOT NULL DEFAULT 0,
  `tl` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Tablo döküm verisi `ep_price`
--

INSERT INTO `ep_price` (`id`, `ep`, `tl`) VALUES
(1, 30, 10),
(2, 60, 20),
(3, 90, 30),
(4, 120, 40),
(5, 150, 50),
(6, 180, 60),
(7, 210, 70),
(8, 240, 80),
(9, 270, 90),
(10, 300, 100),
(11, 700, 200),
(12, 1200, 300),
(13, 1550, 400),
(14, 2000, 500);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `day` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `owner` int(1) NOT NULL DEFAULT 2
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `events`
--

INSERT INTO `events` (`id`, `day`, `name`, `time`, `owner`) VALUES
(1, 'Pazartesi', 'Okey Etkinliği', '20:00-21:00', 1),
(2, 'Salı', 'Sertifika Etkinliği', '20:00-21:00', 2),
(3, 'Çarşamba', 'Futbol Topu Etkinliği', '20:00-21:00', 3),
(4, 'Perşembe', 'Ayışığı Etkinliği', '20:00-21:00', 4),
(5, 'Cuma', 'Dönüşüm Küresi Etkinliği', '20:00-21:00', 5),
(6, 'Cumartesi', 'Beceri Kitabı Etkinliği', '20:00-21:00', 6),
(7, 'Pazar', 'Ramazan Simit Etkinliği', '20:00-21:00', 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `event_crone`
--

CREATE TABLE `event_crone` (
  `id` int(11) NOT NULL,
  `startDate` datetime DEFAULT NULL,
  `eventFlag` varchar(32) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `eventNotice` text DEFAULT NULL,
  `finishDate` datetime DEFAULT NULL,
  `eventName` varchar(255) DEFAULT NULL,
  `day` varchar(2) DEFAULT NULL,
  `month` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `event_list`
--

CREATE TABLE `event_list` (
  `id` int(2) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `eventFlag` varchar(32) DEFAULT NULL,
  `gameNotice` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `event_list`
--

INSERT INTO `event_list` (`id`, `name`, `eventFlag`, `gameNotice`) VALUES
(1, 'Ayışığı Define Sandığı Etkinliği', 'ayisigi', 'Ayışığı define sandığı etkinliği başladı.[END_ENTER]Ayışığı Define Sandığı etkinliği bitti.'),
(2, 'Altıgen Hediye Paketi Etkinliği', 'gen_drop', 'Altıgen hediye paketi etkinliği başladı.[END_ENTER]Altıgen Hediye Paketi etkinliği bitti.'),
(3, 'Kuzey Kutusu Etkinliği', 'kuzeykutusu', 'Kuzey Kutusu etkinliği etkinliği başladı.[END_ENTER]Kuzey Kutusu Etkinliği bitti.'),
(4, 'Gül & Lolipop Etkinliği', 'gizemli_sandik', 'Gül & Lolipop etkinliği başladı.[END_ENTER]Gül & Lolipop etkinliği bitti.'),
(5, 'Cadılar Bayramı Sandığı Etkinliği', 'hallowen', 'Cadılar bayramı sandığı etkinliği başladı.[END_ENTER]Cadılar Bayramı Sandığı etkinliği bitti.'),
(6, 'Binek Sertifikaları Etkinliği', 'sertifika', 'Binek sertifikaları etkinliği başladı.[END_ENTER]Binek Sertifikaları etkinliği bitti.'),
(7, 'Futbol Topu Etkinliği', 'futboltopu', 'Futbol topu etkinliği başladı.[END_ENTER]Futbol Topu etkinliği bitti.'),
(8, 'Bulmaca Kutusu Etkinliği', 'kids_day_quiz', 'Bulmaca kutusu etkinliği başladı![END_ENTER]Bulmaca Kutusu etkinliği bitti.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `extra_page`
--

CREATE TABLE `extra_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `tarih` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `extra_page`
--

INSERT INTO `extra_page` (`id`, `title`, `content`, `tarih`) VALUES
(1, 'SOZLESME', 'tetetqeteqt', '2020-05-30 00:16:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `findme_list`
--

CREATE TABLE `findme_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `total` int(1) NOT NULL DEFAULT 2
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `findme_list`
--

INSERT INTO `findme_list` (`id`, `name`, `total`) VALUES
(1, 'Facebook', 12),
(2, 'İtemci', 1),
(3, 'Google', 1),
(4, 'Youtube', 0),
(5, 'Turkmmo', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `index_basliklar`
--

CREATE TABLE `index_basliklar` (
  `kategori_id` int(11) NOT NULL,
  `kategori_adi` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `index_basliklar`
--

INSERT INTO `index_basliklar` (`kategori_id`, `kategori_adi`) VALUES
(1, 'Tester'),
(2, 'Test2'),
(3, '513'),
(4, '135'),
(5, '15'),
(13, 'as'),
(7, '5315'),
(8, '15135'),
(9, '15135'),
(10, '135135');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `index_biyolog`
--

CREATE TABLE `index_biyolog` (
  `ayar_id` int(11) NOT NULL,
  `ork` text NOT NULL,
  `lanet` text NOT NULL,
  `seytan` text NOT NULL,
  `buz` text NOT NULL,
  `zelkova` text NOT NULL,
  `tug` text NOT NULL,
  `krm` text NOT NULL,
  `lider` text NOT NULL,
  `kem` text NOT NULL,
  `bilge` text NOT NULL,
  `orksayi` varchar(100) NOT NULL,
  `lanetsayi` varchar(100) NOT NULL,
  `seytansayi` varchar(100) NOT NULL,
  `buzsayi` varchar(100) NOT NULL,
  `zelkovasayi` varchar(100) NOT NULL,
  `tugsayi` varchar(100) NOT NULL,
  `krmsayi` varchar(100) NOT NULL,
  `lidersayi` varchar(100) NOT NULL,
  `kemsayi` varchar(100) NOT NULL,
  `bilgesayi` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `index_biyolog`
--

INSERT INTO `index_biyolog` (`ayar_id`, `ork`, `lanet`, `seytan`, `buz`, `zelkova`, `tug`, `krm`, `lider`, `kem`, `bilge`, `orksayi`, `lanetsayi`, `seytansayi`, `buzsayi`, `zelkovasayi`, `tugsayi`, `krmsayi`, `lidersayi`, `kemsayi`, `bilgesayi`) VALUES
(1, 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması (Süresiz)', 'Süre sınırlaması ( 1 Saat )', 'Süre sınırlaması ( 1 Saat )', 'Süre sınırlaması ( 1 Saat )', '10', '15', '15', '20', '25', '30', '40', '50', '10', '20');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `index_detay`
--

CREATE TABLE `index_detay` (
  `konu_id` int(11) NOT NULL,
  `konu_baslik` varchar(300) NOT NULL,
  `konu_bir` text NOT NULL,
  `konu_iki` text NOT NULL,
  `konu_uc` text NOT NULL,
  `konu_dort` text NOT NULL,
  `konu_resim` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `index_detay`
--

INSERT INTO `index_detay` (`konu_id`, `konu_baslik`, `konu_bir`, `konu_iki`, `konu_uc`, `konu_dort`, `konu_resim`) VALUES
(1, 'Test Özellik', 'Testttetet', 'teqtqetqet', 'asdasdasd', 'fgdafgadgadg', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `index_efsun`
--

CREATE TABLE `index_efsun` (
  `ayar_id` int(11) NOT NULL,
  `guczeka` int(11) NOT NULL,
  `maxhp` int(11) NOT NULL,
  `maxsp` int(11) NOT NULL,
  `shizi` int(11) NOT NULL,
  `hhizi` int(11) NOT NULL,
  `bhizi` int(11) NOT NULL,
  `hpspuretimi` int(11) NOT NULL,
  `zsy` int(11) NOT NULL,
  `kritdel` int(11) NOT NULL,
  `yari` int(11) NOT NULL,
  `buyu` int(11) NOT NULL,
  `misolumsuz` int(11) NOT NULL,
  `savunma` int(11) NOT NULL,
  `guczeka2` int(11) NOT NULL,
  `maxhp2` int(11) NOT NULL,
  `maxsp2` int(11) NOT NULL,
  `shizi2` int(11) NOT NULL,
  `hhizi2` int(11) NOT NULL,
  `bhizi2` int(11) NOT NULL,
  `hpspuretimi2` int(11) NOT NULL,
  `zsy2` int(11) NOT NULL,
  `kritdel2` int(11) NOT NULL,
  `yari2` int(11) NOT NULL,
  `buyu2` int(11) NOT NULL,
  `misolumsuz2` int(11) NOT NULL,
  `savunma2` int(11) NOT NULL,
  `guczeka3` int(11) NOT NULL,
  `maxhp3` int(11) NOT NULL,
  `maxsp3` int(11) NOT NULL,
  `shizi3` int(11) NOT NULL,
  `hhizi3` int(11) NOT NULL,
  `bhizi3` int(11) NOT NULL,
  `hpspuretimi3` int(11) NOT NULL,
  `zsy3` int(11) NOT NULL,
  `kritdel3` int(11) NOT NULL,
  `yari3` int(11) NOT NULL,
  `buyu3` int(11) NOT NULL,
  `misolumsuz3` int(11) NOT NULL,
  `savunma3` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Tablo döküm verisi `index_efsun`
--

INSERT INTO `index_efsun` (`ayar_id`, `guczeka`, `maxhp`, `maxsp`, `shizi`, `hhizi`, `bhizi`, `hpspuretimi`, `zsy`, `kritdel`, `yari`, `buyu`, `misolumsuz`, `savunma`, `guczeka2`, `maxhp2`, `maxsp2`, `shizi2`, `hhizi2`, `bhizi2`, `hpspuretimi2`, `zsy2`, `kritdel2`, `yari2`, `buyu2`, `misolumsuz2`, `savunma2`, `guczeka3`, `maxhp3`, `maxsp3`, `shizi3`, `hhizi3`, `bhizi3`, `hpspuretimi3`, `zsy3`, `kritdel3`, `yari3`, `buyu3`, `misolumsuz3`, `savunma3`) VALUES
(1, 10, 2000, 200, 8, 8, 10, 15, 8, 10, 10, 10, 10, 10, 12, 3000, 300, 10, 10, 12, 20, 10, 12, 12, 12, 15, 12, 15, 4000, 400, 12, 12, 15, 30, 12, 15, 15, 15, 20, 15);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `index_market`
--

CREATE TABLE `index_market` (
  `id` int(11) NOT NULL,
  `market_adi` varchar(100) NOT NULL,
  `market_resim` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `index_market`
--

INSERT INTO `index_market` (`id`, `market_adi`, `market_resim`) VALUES
(1, 'Market Adı 1', 'https://i.hizliresim.com/7ay7Ya.jpg'),
(2, 'Market Adı 2', 'https://i.hizliresim.com/8aNPPQ.jpg'),
(3, 'Market Adı 3', 'https://i.hizliresim.com/DYyBB6.jpg'),
(4, 'Market Adı 3', 'https://i.hizliresim.com/DYyBB6.jpg'),
(5, 'Market Adı 3', 'https://i.hizliresim.com/DYyBB6.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ip_list`
--

CREATE TABLE `ip_list` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `decription` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `ip_list`
--

INSERT INTO `ip_list` (`id`, `ip`, `decription`) VALUES
(1, '::1', 'localhost');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `itemci_price`
--

CREATE TABLE `itemci_price` (
  `id` int(5) NOT NULL,
  `ep` int(11) NOT NULL,
  `tl` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Tablo döküm verisi `itemci_price`
--

INSERT INTO `itemci_price` (`id`, `ep`, `tl`) VALUES
(1, 30, 10),
(2, 60, 20),
(3, 90, 30),
(4, 120, 40),
(5, 150, 50),
(6, 180, 60),
(7, 210, 70),
(8, 240, 80),
(11, 270, 90),
(12, 300, 100),
(13, 700, 200),
(14, 1200, 300),
(15, 1550, 400),
(16, 2000, 500);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `items`
--

CREATE TABLE `items` (
  `id` int(11) UNSIGNED NOT NULL,
  `item_id` int(11) NOT NULL DEFAULT 0,
  `vnum` int(11) NOT NULL DEFAULT 0,
  `item_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `item_image` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `coins` int(8) NOT NULL DEFAULT 0,
  `count_1` int(5) NOT NULL DEFAULT 0,
  `count_2` int(5) NOT NULL DEFAULT 0,
  `count_3` int(5) NOT NULL DEFAULT 0,
  `count_4` int(5) NOT NULL DEFAULT 0,
  `count_5` int(5) NOT NULL DEFAULT 0,
  `kategori_id` int(5) NOT NULL DEFAULT 0,
  `durum` int(1) NOT NULL DEFAULT 0,
  `item_time` int(1) NOT NULL DEFAULT 0,
  `discount_1` int(3) NOT NULL DEFAULT 0,
  `discount_2` int(3) NOT NULL DEFAULT 0,
  `discount_3` int(3) NOT NULL DEFAULT 0,
  `discount_4` int(3) NOT NULL DEFAULT 0,
  `discount_5` int(3) NOT NULL DEFAULT 0,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `attrtype0` int(8) NOT NULL DEFAULT 0,
  `attrtype1` int(8) NOT NULL DEFAULT 0,
  `attrtype2` int(8) NOT NULL DEFAULT 0,
  `attrtype3` int(8) NOT NULL DEFAULT 0,
  `attrtype4` int(8) NOT NULL DEFAULT 0,
  `attrtype5` int(8) NOT NULL DEFAULT 0,
  `attrtype6` int(8) NOT NULL DEFAULT 0,
  `attrvalue0` int(8) NOT NULL DEFAULT 0,
  `attrvalue1` int(8) NOT NULL DEFAULT 0,
  `attrvalue2` int(8) NOT NULL DEFAULT 0,
  `attrvalue3` int(8) NOT NULL DEFAULT 0,
  `attrvalue4` int(8) NOT NULL DEFAULT 0,
  `attrvalue5` int(8) NOT NULL DEFAULT 0,
  `attrvalue6` int(8) NOT NULL DEFAULT 0,
  `socket0` int(8) NOT NULL DEFAULT 0,
  `socket1` int(8) NOT NULL DEFAULT 0,
  `socket2` int(8) NOT NULL DEFAULT 0,
  `socket3` int(8) NOT NULL DEFAULT 0,
  `socket4` int(8) NOT NULL DEFAULT 0,
  `socket5` int(8) NOT NULL DEFAULT 0,
  `tarih` datetime DEFAULT NULL,
  `coins_old` int(8) NOT NULL DEFAULT 0,
  `information` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `popularite` int(1) NOT NULL DEFAULT 0,
  `multi_count` int(1) NOT NULL DEFAULT 0,
  `discount_status` int(1) NOT NULL DEFAULT 0,
  `faq_status` int(1) NOT NULL DEFAULT 0,
  `wear_flag` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `applytype0` int(11) NOT NULL DEFAULT 0,
  `applytype1` int(11) NOT NULL DEFAULT 0,
  `applytype2` int(11) NOT NULL DEFAULT 0,
  `unit_price` int(3) NOT NULL DEFAULT 1,
  `item_time2` int(1) NOT NULL DEFAULT 0,
  `buy_count` int(11) NOT NULL DEFAULT 0,
  `is_giftbox` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `items_log`
--

CREATE TABLE `items_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `account_name` varchar(255) DEFAULT '',
  `item_id` int(11) NOT NULL DEFAULT 0,
  `item_image` varchar(255) DEFAULT '',
  `vnum` int(11) NOT NULL DEFAULT 0,
  `item_name` varchar(255) DEFAULT NULL,
  `coins` int(11) NOT NULL DEFAULT 0,
  `adet` int(11) NOT NULL DEFAULT 0,
  `tarih` datetime DEFAULT NULL,
  `tur` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kuponlar`
--

CREATE TABLE `kuponlar` (
  `id` int(11) NOT NULL DEFAULT 0,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `anahtar` varchar(255) DEFAULT NULL,
  `ep` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_date` datetime DEFAULT NULL,
  `use_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `language`
--

CREATE TABLE `language` (
  `id` int(2) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `language`
--

INSERT INTO `language` (`id`, `code`, `name`) VALUES
(1, 'tr', 'Türkçe'),
(2, 'en', 'English'),
(3, 'de', 'Deutsch');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `login_log`
--

CREATE TABLE `login_log` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `login` varchar(100) DEFAULT NULL,
  `ip` varchar(100) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `login_log`
--

INSERT INTO `login_log` (`id`, `account_id`, `login`, `ip`, `date`, `type`) VALUES
(19, 4444, 'cankira', '188.132.164.12', '2025-11-23 18:36:26', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `log_virustotal`
--

CREATE TABLE `log_virustotal` (
  `id` int(11) NOT NULL,
  `User` varchar(80) DEFAULT NULL,
  `ScanType` varchar(255) DEFAULT NULL,
  `ScanID` varchar(255) DEFAULT NULL,
  `ScanURL` varchar(255) DEFAULT NULL,
  `Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `mainmenu` int(11) NOT NULL DEFAULT 99,
  `status` int(11) NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `other` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL,
  `alone` int(1) DEFAULT 1,
  `permission` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `menu`
--

INSERT INTO `menu` (`id`, `name`, `mainmenu`, `status`, `icon`, `other`, `link`, `alone`, `permission`) VALUES
(1, 'Anasayfa', 99, 0, 'home', '', 'index', 0, 1),
(2, 'Market Yönetimi', 99, 0, 'shopping-cart', '', 'product', 1, 2),
(3, 'Eşya Ekle', 2, 1, 'plus', '', 'product/view', 1, 3),
(4, 'Eşya Listesi', 2, 1, 'list', '', 'product/views', 1, 4),
(5, 'Çark Eşya Ekle', 2, 1, 'plus', '', 'product/wheel', 1, 5),
(6, 'Çark Eşya Listesi', 2, 1, 'list', '', 'product/wheel_liste', 1, 6),
(7, 'Kategori Ekle', 2, 1, 'plus', '', 'product/categoryadd', 1, 7),
(8, 'Kategori Listesi', 2, 1, 'list', '', 'product/categorylist', 1, 8),
(9, 'Kupon Yönetimi', 99, 0, 'barcode', '', 'coupon', 1, 9),
(10, 'Kupon Oluştur', 9, 1, 'plus-square', '', 'coupon/create', 1, 10),
(11, 'Kullanılmış Kuponlar', 9, 1, 'lock', '', 'coupon/used', 1, 11),
(12, 'Kullanılmamış Kuponlar', 9, 1, 'unlock', '', 'coupon/unused', 1, 12),
(13, 'Ticket Yönetimi', 99, 0, 'ticket', '', 'ticket', 1, 13),
(14, 'Yanıtlanmış Ticketlar', 13, 1, 'send', '', 'ticket/read', 1, 14),
(15, 'Yanıtlanmamış Ticketlar', 13, 1, 'send-o', '', 'ticket/unread', 1, 15),
(16, 'Ayarlar', 99, 0, 'wrench', '', 'setting', 1, 16),
(17, 'Online Sayısı', 16, 1, 'globe', '', 'setting/online', 0, 17),
(18, 'Genel Ayarları', 16, 1, 'gears', '', 'setting/site', 1, 18),
(19, 'Database Ayarları', 16, 1, 'database', '', 'setting', 1, 19),
(20, 'Market Ayarları', 16, 1, 'shopping-cart', '', 'setting/shop', 1, 20),
(21, 'Çark Ayarları', 16, 1, 'gamepad', '', 'setting/wheel', 1, 21),
(22, 'Mail Ayarları', 16, 1, 'envelope', '', 'setting/mail', 1, 22),
(23, 'Link Ayarları', 16, 1, 'link', '', 'setting/link', 1, 23),
(24, 'Sayaç Ayarları', 16, 1, 'tachometer', '', 'setting/counter', 1, 24),
(25, 'Socket Ayarları', 16, 1, 'code', '', 'setting/socket', 1, 25),
(26, 'Recaptcha Ayarları', 16, 1, 'key', '', 'setting/captcha', 1, 26),
(27, 'Sistem Ayarları', 16, 1, 'database', '', 'management/game_systems', 1, 27),
(28, 'PayTR Ayarları', 16, 1, 'cc-visa', '', 'setting/paytr', 1, 28),
(29, 'İtemci Ayarları', 16, 1, 'cc-visa', '', 'setting/itemci', 1, 29),
(30, 'EP-TL Ayarları', 16, 1, 'try', '', 'setting/epprice', 1, 30),
(31, 'Ticket Ayarları', 16, 1, 'ticket', '', 'setting/ticket', 1, 31),
(32, 'KasaGame Ayarları', 16, 1, 'cc-visa', '', 'setting/kasagame', 1, 32),
(33, 'SanalPay Ayarları', 16, 1, 'cc-visa', '', 'setting/sanalpay', 1, 33),
(34, 'Paywant Ayarları', 16, 1, 'cc-visa', '', 'setting/paywant', 1, 34),
(35, 'Payreks Ayarları', 16, 1, 'cc-visa', '', 'setting/payreks', 1, 35),
(36, 'İtem Sultan Ayarları', 16, 1, 'cc-visa', '', 'setting/itemsultan', 1, 36),
(37, 'Oyun Alışveriş Ayarları', 16, 1, 'cc-visa', '', 'setting/oyunalisverisi', 1, 37),
(38, 'Hesap Yönetimi', 99, 0, 'users', '', 'account', 1, 38),
(39, 'Hesap Oluştur', 38, 1, 'plus', '', 'account/create', 1, 39),
(40, 'Epi Olan Hesaplar', 38, 1, 'cubes', '', 'account/gotep', 1, 40),
(41, 'Aktif GüvenliPC', 38, 1, 'list', '', 'log/guvenlipc', 1, 41),
(42, 'Tüm Hesaplar', 38, 1, 'users', '', 'account/alllist', 1, 42),
(43, 'Banlı Hespalar', 38, 1, 'user-times', '', 'account/banlist', 1, 43),
(44, 'Event İşlemleri', 99, 0, 'shield', '', 'event', 1, 44),
(45, 'Event Aç', 44, 1, 'plus-circle', '', 'event/create', 1, 45),
(46, 'Event Planla', 44, 1, 'road', '', 'event/plan', 1, 46),
(47, 'Event Listesi', 44, 1, 'list', '', 'event/liste', 1, 47),
(48, 'Yönetici Ayarları', 99, 0, 'child', '', 'user', 1, 48),
(49, 'Yönetici Oluştur', 48, 1, 'plus-square', '', 'user/index', 1, 49),
(50, 'Yönetici Listesi', 48, 1, 'list', '', 'user/users', 1, 50),
(51, 'Socket İşlemleri', 99, 0, 'code', '', 'socket', 1, 51),
(52, 'Dropları Aç', 51, 1, 'gift', '', 'socket/drop', 1, 52),
(53, 'DC Atma', 51, 1, 'exclamation', '', 'socket/dc', 1, 53),
(54, 'Chat Ban', 51, 1, 'wechat', '', 'socket/chat', 1, 54),
(55, 'Oyun İçi Duyuru', 51, 1, 'bullhorn', '', 'socket/notice', 1, 55),
(56, 'Müzik Yönetimi', 51, 1, 'wechat', '', 'socket/play', 1, 56),
(57, 'Log Kayıtlları', 99, 0, 'bars', '', 'log', 1, 57),
(58, 'Market Logları', 57, 1, 'credit-card', '', 'log/shop', 1, 58),
(59, 'Ban Logları', 57, 1, 'ban', '', 'log/ban', 1, 59),
(60, 'HWID Ban Logları', 57, 1, 'ban', '', 'log/hwidban', 1, 60),
(61, 'Paywant Logları', 57, 1, 'credit-card-alt', '', 'log/paywant', 1, 61),
(62, 'Payreks Logları', 57, 1, 'credit-card-alt', '', 'log/payreks', 1, 62),
(63, 'KasaGame Logları', 57, 1, 'credit-card-alt', '', 'log/kasagame', 1, 63),
(64, 'Haber Yönetimi', 99, 0, 'newspaper-o', '', 'news', 1, 64),
(65, 'Haber Ekle', 64, 1, 'plus', '', 'news/add', 1, 65),
(66, 'Haber Listesi', 64, 1, 'list', '', 'news/liste', 1, 66),
(67, 'Market Haber Ekle', 64, 1, 'plus', '', 'news/shopadd', 1, 67),
(68, 'Market Haber Listesi', 64, 1, 'list', '', 'news/shopnewslist', 1, 68),
(69, 'Pack Yönetimi', 99, 0, 'files-o ', '', 'pack', 1, 69),
(70, 'Pack Ekle', 69, 1, 'plus', '', 'pack/add', 1, 70),
(71, 'Pack Listesi', 69, 1, 'list', '', 'pack/liste', 1, 71),
(72, 'Site Yönetimi', 99, 0, 'cog', '', 'site', 1, 72),
(73, 'Tema Seçimi', 72, 1, 'file', '', 'site/theme', 1, 73),
(74, 'Logo Yönetimi', 72, 1, 'eye-slash', '', 'site/logo', 1, 74),
(75, 'Güvenlik Ayarları', 72, 1, 'key', '', 'site/security', 1, 75),
(76, 'Discord Ayarları', 72, 1, 'microphone', '', 'site/discord', 1, 76),
(77, 'Tawk.To Ayarları', 72, 1, 'handshake-o', '', 'site/support', 1, 77),
(78, 'Sıralama Ayarları', 72, 1, 'group', '', 'site/ranked', 1, 78),
(79, 'Kayıt Ayarları', 72, 1, 'drivers-license', '', 'site/register', 1, 79),
(81, 'Bakım Sayfası Yönetimi', 72, 1, 'eye-slash', '', 'site/care', 1, 81),
(82, 'Market Yedek İşlemleri', 72, 1, 'upload', '', 'management/shop_backup', 1, 82),
(83, 'CloudFlare API Yönetimi', 72, 1, 'cloud', '', 'site/cloudflare', 1, 83),
(84, 'Eşya Ara', 99, 0, 'search', '', 'proto', 0, 84),
(85, 'Lisans Bilgileri', 99, 0, 'download', '', 'update', 0, 73),
(86, 'Bonus Ekle', 2, 1, 'plus', '', 'product/bonusadd', 1, 3),
(87, 'Bonus Listesi', 2, 1, 'list', '', 'product/bonuslist', 1, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `old_password`
--

CREATE TABLE `old_password` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `old_password` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `old_password`
--

INSERT INTO `old_password` (`id`, `account_id`, `old_password`, `date`) VALUES
(1, 4, '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', '2023-04-23 05:26:25');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pack`
--

CREATE TABLE `pack` (
  `id` int(2) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `pack`
--

INSERT INTO `pack` (`id`, `name`, `size`, `url`, `image`, `tarih`, `type`) VALUES
(2, 'Nuya 2 pack ', '999 MB ', 'https://drive.google.com/file/d/1ud7jjlvLBm_MFGzpNgdb9WWUKekcJymB/view', './data/flags/file.png', '2025-10-07 19:54:15', 1),
(3, 'Nuya 2 pack ', '999 MB ', 'https://drive.google.com/file/d/1ud7jjlvLBm_MFGzpNgdb9WWUKekcJymB/view', './data/flags/file.png', '2025-10-07 19:54:22', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `patch`
--

CREATE TABLE `patch` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `content2` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `patch`
--

INSERT INTO `patch` (`id`, `title`, `content`, `image`, `tarih`, `content2`) VALUES
(3, '???? Nuya2: 1-99 Oldschool Açılıyor!', '???? Nuya2: 1-99 Oldschool Açılıyor!Metin2 tutkunlarının heyecanla beklediği yepyeni bir macera başlıyor!\r\nNuya2 adıyla yola çıkan bu özel Metin2 PVP server’ı, 1-99 level arası gerçek oldschool deneyimi yaşatmak için kapılarını oyunculara açıyor.???? Oyun Dünyasına Sadık, Yeniliklerle GüçlüNuya2, klasik Metin2 deneyimini modern dokunuşlarla birleştiriyor. Orijinal sistemlere sadık kalınarak hazırlanan oyun içeriği, eski günlerin nostaljisini yaşatırken, günümüz oyuncularının ihtiyaçlarına da cevap veriyor. Dengeli ekonomi, sade arayüz ve hatasız bir oyun yapısıyla dikkat çekiyor.????️ Özellikler:\r\n\r\n✅ 1-99 Seviye Oldschool Sistem\r\n\r\n✅ Dengeli karakter sınıfları ve PvP yapısı\r\n\r\n\r\n✅ Lonca savaşları için optimize edilmiş haritalar\r\n\r\n\r\n✅ Pay-to-win’e karşı net duruş – tamamen emek odaklı sistem\r\n\r\n\r\n✅ Aktif GM ekibi ve düzenli etkinlik takvimi\r\n\r\n⏳ Açılış Tarihi &amp; KayıtlarServer açılış tarihi yakında resmi olarak duyurulacak. Ancak şimdiden Discord sunucusuna katılarak güncellemelerden haberdar olabilir, topluluğun bir parçası olabilirsiniz.???? Seni de Bu Efsaneye Bekliyoruz!Eğer sen de gerçek bir Metin2 deneyimi arıyor, yıllar önceki atmosferi tekrar yaşamak istiyorsan, Nuya2 tam sana göre!\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n????️ Takipte kalın!\r\n???? [Discord Sunucusu Linki]\r\n???? www.nuya2.com', 'data/upload/s9TaQKRfK8tGGjo.jpg', '2025-06-28 12:50:26', 'Metin2 tutkunlarının heyecanla beklediği yepyeni bir macera başlıyor!');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `payreks_log`
--

CREATE TABLE `payreks_log` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `user_info` varchar(255) DEFAULT NULL,
  `credit` int(11) NOT NULL DEFAULT 0,
  `pay_label` varchar(50) DEFAULT NULL,
  `net_price` double NOT NULL DEFAULT 0,
  `date_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `player_log`
--

CREATE TABLE `player_log` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sanalpay_api`
--

CREATE TABLE `sanalpay_api` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `login` varchar(255) DEFAULT NULL,
  `ep` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `anahtar` varchar(150) DEFAULT NULL,
  `deger` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `anahtar`, `deger`) VALUES
(1, 'eposta_onay', '0'),
(2, 'smtp_username', 'info@nuya2.com'),
(3, 'smtp_port', '587'),
(4, 'smtp_secure', 'tls'),
(5, 'smtp_password', '135790.nuyaa'),
(6, 'admin_mail', 'info@nuya2.com'),
(7, 'smtp_debug', '0'),
(8, 'smtp_from', 'Nuya2 Yönetimi'),
(9, 'smtp_host', 'mail.nuya2.com'),
(10, 'client', 'metin2-tr'),
(11, 'admin', 'admin'),
(12, 'shop', 'ishop'),
(13, 'mutual', 'destek'),
(14, 'android', 'android'),
(15, 'homein', 'OGS_Index1'),
(16, 'caretheme', 'OGS_Bakim02'),
(17, 'cachetime', '3600'),
(18, 'oyun_adi', 'Nuya2'),
(19, 'slogan', '1-99 Oldschool'),
(20, 'logo', 'data/upload/68603ae680a6b2.93769684_qpfjlkemhinog.png'),
(21, 'logo_width', '200px'),
(22, 'logo_filter', 'drop-shadow(0px 0px 10px rgba(0,0,0,1)) drop-shadow(0px 0px 5px rgba(0,0,0,1))'),
(23, 'logo_position_x', '0'),
(24, 'logo_position_y', '-60px'),
(25, 'logo_hover', 'none'),
(26, 'logo_default_width', '200px'),
(27, 'sitekey', '6LfnynArAAAAAB8Llt7Mz0S2eSTzKsTiDdg9pin2'),
(28, 'secretkey', '6LfnynArAAAAAM67w5a-mySrk5bjpkpA0ryELQa3'),
(29, 'generalkey', 'inpinos'),
(30, 'passwordkey', '296By3d4kXhKPNIs'),
(31, 'licence_key', 'N37377D9'),
(32, 'licence_secret', 'N3PCKOGAV3MMP6OZ'),
(33, 'ch1_port', '25000'),
(34, 'ch2_port', '25010'),
(35, 'ch3_port', '25020'),
(36, 'ch4_port', '25030'),
(37, 'serverResponse', 'GETOGSTUDIO'),
(38, 'type', 'mysql'),
(39, 'ip', '88.209.248.228'),
(40, 'user', 'root'),
(41, 'password', 'wold'),
(42, 'sshpassword', 'Nuya2.13579'),
(43, 'db', 'account'),
(44, 'dbkey', '552158s4fg5awwer554'),
(45, 'dbkey_new', 'Cankira.1'),
(46, 'gamekey', 'GF9001'),
(47, 'tokenkey', 'YA9RQ5IYS5WTSFV3'),
(48, 'android_key', 'JU681D0AKPP5KTPI'),
(49, 'multi_languages', '1'),
(50, 'default_language', 'tr'),
(51, 'facebook', 'http://www.facebook.com/Metin2'),
(52, 'youtube', '#'),
(53, 'tanitim', '#'),
(54, 'wiki', '#'),
(55, 'forum', '#'),
(56, 'instagram', '#'),
(57, 'realtime', '0'),
(58, 'online', '0'),
(59, 'totalaccount', '0'),
(60, 'totalplayer', '0'),
(61, 'todaylogin', '0'),
(62, 'activepazar', '0'),
(63, 'recaptcha', '0'),
(64, 'maintenance', '0'),
(65, 'indexhome', '0'),
(66, 'facebook_status', '0'),
(67, 'down_status', '0'),
(68, 'facebook_like_status', '0'),
(69, 'socket_status', '2'),
(70, 'total_online_status', '1'),
(71, 'today_login_status', '1'),
(72, 'total_account_status', '1'),
(73, 'total_player_status', '1'),
(74, 'active_pazar_status', '1'),
(75, 'ticket_status', '1'),
(76, 'register_gift_status', '0'),
(77, 'register_drop_status', '0'),
(78, 'register_gift_count', '0'),
(79, 'player_rank_status', '1'),
(80, 'guild_rank_status', '1'),
(81, 'register_status', '1'),
(82, 'findme_status', '0'),
(83, 'tawkto_status', '0'),
(84, 'discord_status', '0'),
(85, 'player_rank', '20'),
(86, 'guild_rank', '20'),
(87, 'event_type', '2'),
(88, 'offline_shop_npc', 'offlineshop_shops'),
(89, 'offline_shop_item', 'offlineshop_shop_items'),
(90, 'cash', 'coins'),
(91, 'mileage', 'cash'),
(92, 'shop_status', '1'),
(93, 'shop_recaptcha_status', '0'),
(94, 'free_sell_item', '0'),
(95, 'wheel', '0'),
(96, 'wheelcoins', '149'),
(97, 'slot_cash_status', '0'),
(98, 'slot_cash_count', '10'),
(99, 'slot_cash_gift', '10'),
(100, 'happy_hour', '0'),
(101, 'happy_hour_discount', '0'),
(102, 'itemci_commission', '15'),
(103, 'itemci_link', 'https://www.itemci.com/'),
(104, 'itemsultan_link', 'https://www.epinsultan.com/'),
(105, 'oyunalisverisi_link', 'https://www.oyunalisveris.com/'),
(106, 'paywantKey', '#'),
(107, 'paywantSecret', '#'),
(108, 'payreks_api', '#'),
(109, 'payreks_secret', '#'),
(110, 'sanalpay_api', '#'),
(111, 'sanalpay_hash', '#'),
(112, 'paytr_id', '#'),
(113, 'paytr_salt', '#'),
(114, 'paytr_key', '#'),
(115, 'kasagame_merc_id', '#'),
(116, 'kasagame_api_key', '#'),
(117, 'paywant_token', '#'),
(118, 'itemci_status', '0'),
(119, 'paytr_status', '0'),
(120, 'paywant_status', '0'),
(121, 'kasagame_status', '0'),
(122, 'payreks_status', '0'),
(123, 'sanalpay_status', '0'),
(124, 'itemsultan_status', '0'),
(125, 'oyunalisverisi_status', '0'),
(126, 'payreks_notification_status', '0'),
(127, 'payreks_notification_token', '#'),
(128, 'tawkto_id', '#'),
(129, 'discord_id', '#'),
(130, 'discord_link', '#'),
(131, 'discord_theme', 'banner2'),
(132, 'cloud_status', '0'),
(133, 'cloud_mail', '#'),
(134, 'cloud_auth', '#'),
(135, 'cloud_dom', '#'),
(136, 'virustotal_api', '92f1e89a8b9c1b0b08ecb4cd8b13203bca9766dfea983cd7d4645a26e9b71b10'),
(137, 'scan_csx', '1763933795'),
(138, 'footer_name', 'Nuya2'),
(139, 'footer_link', '#'),
(140, 'version', '1.0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shop_bonus`
--

CREATE TABLE `shop_bonus` (
  `id` int(3) NOT NULL,
  `wear_flag` enum('weapon','armor','wrist','foots','neck','head','shield','ear','costume_body','costume_weapon','costume_hair','costume_mount','costume_pet','costume_pendant','other') NOT NULL DEFAULT 'other',
  `apply` varchar(255) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL DEFAULT 'UNKNOW',
  `rate` varchar(255) CHARACTER SET latin5 COLLATE latin5_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shop_menu`
--

CREATE TABLE `shop_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `mainmenu` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `alone` int(1) NOT NULL DEFAULT 0,
  `icon` varchar(150) DEFAULT NULL,
  `who` int(11) NOT NULL DEFAULT 0,
  `icon_type` int(1) NOT NULL DEFAULT 0,
  `owner` int(2) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `shop_menu`
--

INSERT INTO `shop_menu` (`id`, `name`, `mainmenu`, `status`, `alone`, `icon`, `who`, `icon_type`, `owner`) VALUES
(1, 'Kuşanma', 0, 0, 0, 'https://i.hizliresim.com/smqqYt.png', 1, 1, 0),
(2, 'Stil', 0, 0, 0, 'https://i.hizliresim.com/Zh6UXJ.png', 2, 1, 0),
(3, 'Hizmet', 0, 0, 0, 'https://i.hizliresim.com/uuEaBB.png', 3, 1, 0),
(4, 'Arındırma & Geliştirme', 0, 0, 0, 'https://i.hizliresim.com/PaQJSW.png', 4, 1, 0),
(5, 'Silahlar (PvM)', 1, 1, 1, '', 1, 0, 0),
(6, 'Zırhlar (PvM)', 1, 1, 1, '', 1, 0, 0),
(7, 'Takılar (PvM)', 1, 1, 1, '', 1, 0, 0),
(8, 'Kask & Kalkan (PvM)', 1, 1, 1, '', 1, 0, 0),
(9, 'Silahlar (PvP)', 1, 1, 1, '', 1, 0, 0),
(10, 'Zırhlar (PvP)', 1, 1, 1, '', 1, 0, 0),
(11, 'Takılar (PvP)', 1, 1, 1, '', 1, 0, 0),
(12, 'Kask & Kalkan (PvP)', 1, 1, 1, '', 1, 0, 0),
(13, 'Kemerler', 1, 1, 1, '', 1, 0, 0),
(14, 'PvM Kostümleri', 2, 1, 1, '', 2, 0, 0),
(15, 'PvM Saç Modelleri', 2, 1, 1, '', 2, 0, 0),
(16, 'PvM Silah Fişleri', 2, 1, 1, '', 2, 0, 0),
(17, 'PvP Kostümleri', 2, 1, 1, '', 2, 0, 0),
(18, 'PvP Saç Modelleri', 2, 1, 1, '', 2, 0, 0),
(19, 'PvP Silah Fişleri', 2, 1, 1, '', 2, 0, 0),
(20, 'Binekler', 2, 1, 1, '', 2, 0, 0),
(21, 'Evcil Hayvanlar (Petler)', 2, 1, 1, '', 2, 0, 0),
(22, 'Taşlar', 3, 1, 1, '', 3, 0, 0),
(23, 'Dönüşüm Nesneleri', 3, 1, 1, '', 3, 0, 0),
(24, 'Yükseltme Nesneleri', 3, 1, 1, '', 3, 0, 0),
(25, 'Geçit Biletleri', 3, 1, 1, '', 3, 0, 0),
(26, 'Karakter Yükseltme', 4, 1, 1, '', 4, 0, 0),
(27, 'Biyolog Nesneleri', 4, 1, 1, '', 4, 0, 0),
(28, 'İksirler ve Balıklar', 4, 1, 1, '', 4, 0, 0),
(29, 'Cevherler', 4, 1, 1, '', 4, 0, 0),
(30, 'Özel Nesneler', 4, 1, 1, '', 4, 0, 0),
(31, 'EP Kuponları', 3, 1, 1, NULL, 3, 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slot_gift_log`
--

CREATE TABLE `slot_gift_log` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `login` varchar(255) NOT NULL DEFAULT '',
  `roulette` varchar(255) NOT NULL DEFAULT '',
  `roulette0` varchar(255) NOT NULL DEFAULT '',
  `roulette1` varchar(255) NOT NULL DEFAULT '',
  `roulette2` varchar(255) NOT NULL DEFAULT '',
  `cash` int(11) NOT NULL DEFAULT 0,
  `date_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slot_log`
--

CREATE TABLE `slot_log` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 0,
  `login` varchar(255) NOT NULL DEFAULT '',
  `cash` int(11) NOT NULL DEFAULT 0,
  `date_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `systems`
--

CREATE TABLE `systems` (
  `id` int(11) NOT NULL,
  `anahtar` varchar(150) DEFAULT NULL,
  `deger` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `systems`
--

INSERT INTO `systems` (`id`, `anahtar`, `deger`) VALUES
(1, 'bossgaya_durum', '0'),
(2, 'bossgaya_sutun', 'gaya1'),
(3, 'metingaya_durum', '0'),
(4, 'metingaya_sutun', 'gaya'),
(5, 'won_durum', '0'),
(6, 'won_sutun', 'cheque'),
(7, 'np_durum', '0'),
(8, 'np_sutun', 'np'),
(9, 'rebirth_durum', '0'),
(10, 'rebirth_sutun', 'rebirth'),
(11, 'rutbe_durum', '0'),
(12, 'rutbe_sutun', 'prestige'),
(13, 'pin_durum', '0'),
(14, 'pin_sutun', 'web_admin'),
(15, 'pin_adet', '4'),
(16, 'itemkilit_durum', '0'),
(17, 'itemkilit_sutun', 'web_admin'),
(18, 'hesapkilit_durum', '0'),
(19, 'hesapkilit_tablo', 'ban_log'),
(20, 'karakterkilit_durum', '0'),
(21, 'karakterkilit_sutun', 'security_password'),
(22, 'guvenlipc_durum', '0'),
(23, 'guvenlipc_sutun', 'web_admin'),
(24, 'guvenlipc_tablo1', 'ban_log'),
(25, 'guvenlipc_tablo2', 'ban_log');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticketid` int(9) NOT NULL DEFAULT 0,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `username` varchar(150) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `divs` varchar(30) DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `first` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket_count`
--

CREATE TABLE `ticket_count` (
  `id` bigint(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=FIXED;

--
-- Tablo döküm verisi `ticket_count`
--

INSERT INTO `ticket_count` (`id`, `count`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket_status`
--

CREATE TABLE `ticket_status` (
  `id` int(11) NOT NULL,
  `ticketid` int(9) NOT NULL DEFAULT 0,
  `accountid` int(11) NOT NULL DEFAULT 0,
  `username` varchar(150) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `tarih` datetime DEFAULT NULL,
  `type` int(1) NOT NULL DEFAULT 0,
  `first` int(1) NOT NULL DEFAULT 0,
  `whoid` int(5) NOT NULL DEFAULT 0,
  `whoname` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticket_title`
--

CREATE TABLE `ticket_title` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `ticket_title`
--

INSERT INTO `ticket_title` (`id`, `title`) VALUES
(1, 'EP Bildirimi'),
(2, 'Twitch & Youtuber Başvurusu'),
(3, 'Nuya2 Ticket Bildirimi...');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `permission` int(2) NOT NULL DEFAULT 0,
  `name` varchar(150) DEFAULT NULL,
  `permissionName` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `imza` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `allPermission` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `permission`, `name`, `permissionName`, `avatar`, `last_login`, `imza`, `allPermission`) VALUES
(1, 'cankira', 'af2b7daff8571246743b8ab446c599f4', 99, 'Admin', 'index/product/coupon/ticket/setting/account/event/user/socket/log/news/pack/proto/update/site/management/sql/ssh', 'data/upload/HBmKKLZXxX9VqBM.png', '2025-11-23 18:37:23', 'Metin2 Yönetim', '1a/1b/1c/1d/1e/1f/3/4/5/6/7/8/10/11/12/14/15/17/18/19/20/21/22/23/24/25/26/27/28/29/30/31/32/33/34/35/36/37/39/40/41/42/43/45/46/47/49/50/52/53/54/55/56/58/59/60/61/62/63/65/66/67/68/70/71/73/74/75/76/77/78/79/80/81/82/83/84/85'),
(2, 'mkdbilisim', 'd932ec842251fab81ed4cf5dafa528fa', 99, 'Kağan', 'index/product/coupon/ticket/setting/account/event/user/socket/log/news/pack/proto/update/site/management/sql/ssh', 'data/upload/HBmKKLZXxX9VqBM.png', '2025-06-28 01:47:24', 'Metin2 Yönetim', '1a/1b/1c/1d/1e/1f/3/4/5/6/7/8/10/11/12/14/15/17/18/19/20/21/22/23/24/25/26/27/28/29/30/31/32/33/34/35/36/37/39/40/41/42/43/45/46/47/49/50/52/53/54/55/56/58/59/60/61/62/63/65/66/67/68/70/71/73/74/75/76/77/78/79/80/81/82/83/84/85');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `wheel_items`
--

CREATE TABLE `wheel_items` (
  `id` int(11) UNSIGNED NOT NULL,
  `vnum` int(11) NOT NULL DEFAULT 0,
  `item_name` varchar(150) DEFAULT NULL,
  `item_image` varchar(150) DEFAULT NULL,
  `count` int(5) NOT NULL DEFAULT 0,
  `item_time` int(1) NOT NULL DEFAULT 0,
  `attrtype0` int(8) NOT NULL DEFAULT 0,
  `attrtype1` int(8) NOT NULL DEFAULT 0,
  `attrtype2` int(8) NOT NULL DEFAULT 0,
  `attrtype3` int(8) NOT NULL DEFAULT 0,
  `attrtype4` int(8) NOT NULL DEFAULT 0,
  `attrtype5` int(8) NOT NULL DEFAULT 0,
  `attrtype6` int(8) NOT NULL DEFAULT 0,
  `attrvalue0` int(8) NOT NULL DEFAULT 0,
  `attrvalue1` int(8) NOT NULL DEFAULT 0,
  `attrvalue2` int(8) NOT NULL DEFAULT 0,
  `attrvalue3` int(8) NOT NULL DEFAULT 0,
  `attrvalue4` int(8) NOT NULL DEFAULT 0,
  `attrvalue5` int(8) NOT NULL DEFAULT 0,
  `attrvalue6` int(8) NOT NULL DEFAULT 0,
  `socket0` int(8) NOT NULL DEFAULT 0,
  `socket1` int(8) NOT NULL DEFAULT 0,
  `socket2` int(8) NOT NULL DEFAULT 0,
  `socket3` int(8) NOT NULL DEFAULT 0,
  `socket4` int(8) NOT NULL DEFAULT 0,
  `socket5` int(8) NOT NULL DEFAULT 0,
  `information` text DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `wiki`
--

CREATE TABLE `wiki` (
  `id` int(11) NOT NULL,
  `title` enum('MobDrop','SpecialDrop','GameSystem','GameNpc','ItemUpgrade','Other') DEFAULT 'Other',
  `content` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT 'data/mobs/default.png',
  `mob` int(10) DEFAULT NULL,
  `item` varchar(500) DEFAULT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seo` varchar(500) DEFAULT 'SEOLINKHATALI',
  `status` int(1) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;

--
-- Tablo döküm verisi `wiki`
--

INSERT INTO `wiki` (`id`, `title`, `content`, `image`, `mob`, `item`, `tarih`, `seo`, `status`) VALUES
(1, 'MobDrop', 'Kırmızı Ejderha Yongbi Çölünde 4 Saat Ara İle Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2291.png', 2291, '50513,38055,71159,71160,70102,25041,70048,50080,31029', '2019-03-16 04:29:26', '1-kirmizi-ejderha', 1),
(2, 'MobDrop', 'Katakomp Azraili Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2598.png', 2598, '70253,70254,35542,71159,71160,38055,50186,70251,70252,31029', '2019-03-16 04:29:26', '2-kharoon', 1),
(3, 'MobDrop', 'Razadör Bossu 1 Saat Ara İle Kırmızı Ejderha Kalesi Girişle Yapılmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/6091.png', 6091, '70251,70252,70253,70254,80055,35542,71159,71160,38055', '2019-03-16 04:29:26', '3-razador', 0),
(4, 'MobDrop', 'Nemere Bossu 1 Saat Ara İle Nemerenin Gözetleme Kulesinden Girişle Yapılmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/6191.png', 6191, '70251,70252,70253,70254,80055,35542,71159,71160,38055,35544,31029', '2019-03-16 04:29:26', '4-nemere', 1),
(5, 'MobDrop', 'Örümcek Barones 1 Saat Ara İle Şeytan Kulesi Önünde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2092.png', 2092, '14163,14182,14201,16163,16182,16201,17163,17182,17201,13062,13082,13102,13122,13140,61411,61401,61415,71130,7153,7154,11293,11294,11493,11494,11693,11694,11893,11894,38055', '2019-03-16 04:29:26', '5-orumcek-barones', 1),
(6, 'MobDrop', 'Azrail Bossu Şeytan Kulesi Son Katında Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/1093.png', 1093, '30319,31029', '2019-03-16 04:29:26', '6-azrail', 1),
(7, 'MobDrop', 'Jeon-un Metini Kızıl Orman Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8027.png', 8027, '151,5091,143,3133,1102,7133,2143,11682,11881,11483,11283,17165,16166,14166,70012,70005,25041,80056,35543,70102,50513,35542', '2019-03-16 04:29:26', '7-metin-jeon-un', 1),
(8, 'MobDrop', 'Tu-Young Metini Kızıl Orman Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8026.png', 8026, '3142,1112,2132,7142,5102,162,242,11681,11881,11481,11281,70005,80056,35543,70102,50513,35542,25041', '2019-03-16 04:29:26', '8-metin-tu-young', 1),
(9, 'MobDrop', 'Ma-An Metini Hayalet Orman Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8025.png', 8025, '3141,3142,1111,1112,2131,2132,7141,7142,5101,5102,161,162,241,242,80056,35543,70102,50513,35542,27003,25041', '2019-03-16 04:29:26', '9-metin-ma-an', 1),
(10, 'MobDrop', 'Pung-Ma Metini Hayalet Orman ve Devler Diyarı Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8024.png', 8024, '3140,3141,1110,1111,2130,2131,7140,7141,5100,5101,160,161,240,241,80056,35543,70102,50513,35542,27003,25041,80056', '2019-03-16 04:29:26', '10-metin-pung-ma', 1),
(11, 'MobDrop', 'Katil Metini Doyyumhwan Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8019.png', 8019, '130,1090,2120,7120,5080,131,1091,2121,7121,5081,132,1092,2122,80056,61401,70102,35542,25041,50513', '2019-03-16 04:29:26', '11-katil-metini', 1),
(12, 'MobDrop', 'Ölüm Metini Sohan Dağı Bölgesinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8018.png', 8018, '120,1080,2110,7110,5070,121,1081,2111,7111,5071,122,1082,2112,7112,5072,80056,61401,70102,35542,25041,50513', '2019-03-16 04:29:26', '12-olum-metini', 1),
(13, 'MobDrop', 'Lanet Metini Şeytan Kulesi Civarında Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8017.png', 8017, '130,1090,2120,7120,5080,131,1091,2121,7121,5081,132,1092,2122,7122,5082,80056,61401,70102,35542,50513,25041', '2019-03-16 04:29:26', '13-lanet-metini', 1),
(14, 'MobDrop', 'Şeytan Metini Sohan Dağı Bölgelerşnde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8016.png', 8016, '120,1080,2110,7110,5070,121,1081,2111,7111,5071,122,1082,2112,7112,5072,80056,61401,70102,35542,25041,50513', '2019-03-16 04:29:26', '14-seytan-metini', 1),
(15, 'MobDrop', 'Şeytan Kulesi Bölgesinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8015.png', 8015, '110,1070,2100,7100,5060,111,1071,2101,7101,5061,80056,61401,70102,35542,25041,50513', '2019-03-16 04:29:26', '15-dayaniklilik-metini', 1),
(16, 'MobDrop', 'Dayanıklılık Metini  Şeytan Kulesi Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8014.png', 8014, '130,1090,2120,7120,5080,131,1091,2121,7121,5081,132,1092,2122,7122,5082,80056,61401,70102,50513,35542,25041', '2019-03-16 04:29:26', '16-katil-metini', 1),
(17, 'MobDrop', 'Şeytan Metini Şeytan Kulesinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8013.png', 8013, '120,1080,2110,7110,5070,121,1081,2111,7111,5071,122,1082,2112,7112,5072,80056,61401,70102,50513,35542,25041,50084', '2019-03-16 04:29:26', '17-olum-metini', 1),
(18, 'MobDrop', 'Lanet Metini Kat Atlama amacıyla Şeytan Kulesi Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8012.png', 8012, '130,1090,2120,7120,5080,131,1091,2121,7121,5081,132,1092,2122,7122,5082,80056,61401,70102,50513,35542,25041', '2019-03-16 04:29:26', '18-lanet-metini', 1),
(19, 'MobDrop', 'Şeytan Metini Şeytan Kulesi Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8011.png', 8011, '120,1080,2110,7110,5070,121,1081,2111,7111,5071,122,1082,2112,7112,5072,80056,61401,70102,50513,35542,25041', '2019-03-16 04:29:26', '19-seytan-metini', 1),
(20, 'MobDrop', 'Dayanıklılık Metini Yongbi Çölü Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8010.png', 8010, '110,1070,2100,7100,5060,111,1071,2101,7101,5061,80056,61401,70102,50513,35542,25041', '2019-03-16 04:29:26', '20-dayaniklilik-metini', 1),
(21, 'MobDrop', 'Gölge Metini Seungryoung Vadisi ve Yongbi Çölü Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8009.png', 8009, '5050,100,1060,2090,7090,5051,101,1061,2091,7091,5052,102,1062,2092,7092,11252,11452,00652,11852,80056,61401,70102,50513,35542,25041', '2019-03-16 04:29:26', '21-golge-metini', 1),
(22, 'MobDrop', 'Ruh Metini Yongbi Çölü Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8008.png', 8008, '90,1050,3080,2080,7080,5050,91,1051,3081,2081,7081,5051,80056,61401,70102,50513,35542,25041', '2019-03-16 04:29:26', '22-ruh-metini', 1),
(23, 'MobDrop', 'Kıskançlık Metini Tüm 2.Köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8007.png', 8007, '80056,35542', '2019-03-16 04:39:05', '23-kiskanclik-metini', 0),
(24, 'MobDrop', 'Karanlık Metini Tüm 2.Köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8006.png', 8006, '80056,35542', '2019-03-16 04:40:28', '24-karanlik-metin', 0),
(25, 'MobDrop', 'Siyah Metini Tüm 1.köy ve 2. köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8005.png', 8005, '80056,35542', '2019-03-16 04:40:28', '25-siyah-metin', 0),
(26, 'MobDrop', 'Hırs Metini Tüm 1.köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8004.png', 8004, '80056,35542', '2019-03-16 04:40:28', '26-hirs-metini', 0),
(27, 'MobDrop', 'Savaş Metini Tüm 1.köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8003.png', 8003, '80056,35542', '2019-03-16 04:40:28', '27-savas-metini', 0),
(28, 'MobDrop', 'Dövüş Metini Tüm 1.köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8002.png', 8002, '80056,35542', '2019-03-16 04:40:28', '28-dovus-metini', 0),
(29, 'MobDrop', 'Üzüntü Metini Tüm 1.köy Bölgelerinde Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/stone/8001.png', 8001, '80056,35542', '2019-03-16 04:40:28', '29-uzuntu-metini', 0),
(30, 'MobDrop', 'General Bossu Sürgün Mağarası 2.kat Bölgelerinde 45 Dakika Ara İle Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2495.png', 2495, '30179,11691,11491,11891,11291,13064,13084,13104,16204,17204,13124,15205,70050,70051,50009', '2019-03-16 04:29:26', '30-general', 1),
(31, 'MobDrop', 'Beran-Setaou Bossu Sürgün Mağarası 2.katta Ejderha Odasında Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2493.png', 2493, '27992,27993,27994,15370,15390,15410,15430,61401,50121,38100,70251,70252,70253,70254,71123,71159,71160,38055,31029,70024,25041,61411,50513', '2019-03-16 04:29:26', '31-beran-setaou', 1),
(32, 'MobDrop', 'General Bossu Sürgün Mağarası 2.kat Bölgelerinde 45 Dakika Ara İle Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2492.png', 2492, '30179,13063,14206,70051,13083,13103,15165,16203,17184,17203,13123,14143,15204,16184', '2019-03-16 04:29:26', '32-general', 1),
(33, 'MobDrop', 'Komutan Bossu Sürgün Mağarası 2.kat Ejderha Odası Önünde 45 Dakika Arayla Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2491.png', 2491, '30179,30196', '2019-03-16 04:29:26', '33-komutan', 1),
(34, 'MobDrop', 'Setaou Komutanı Sürgün Mağarası 2.kat Ejderha Odasında Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2414.png', 2414, '30199,30196,182,192,1132,5122,2172,50120,50121,50122', '2019-03-16 04:29:26', '34-setaou-komutani', 1),
(35, 'MobDrop', 'Alev Kral Bossu Doyumhwan Bölgesinde 30 Dakika Ara ile Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/2206.png', 2206, '50079,70024,90012,50513', '2019-03-16 04:29:26', '35-alev-kral', 1),
(36, 'MobDrop', 'Dokuz Kuyruk Bossu Sohan Dağı Bölgesinde 30 Dakika Ara ile Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/1901.png', 1901, '50077,70024,90010,50513', '2019-03-16 04:29:26', '36-dokuz-kuyruk', 1),
(37, 'MobDrop', 'Güçlü Buz Cadısı Bossu Sürgün Mağarası 1.Kat Sonu Bölgelerinde 45 Dakika Ara ile Çıkmaktadır.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/mobs/1192.png', 1192, '11294,11494,11694,11894,13066,13086,13106,13126,15187,15167,15207,15227,16207,16187,17147,17167,17187,17207,28430,28431,28432,28433,28434,28435,28436,28437,28438,28439,28440,28441,28442,28443,70031,35542', '2019-03-16 04:29:26', '37-guclu-buz-cadisi', 1),
(38, 'MobDrop', 'Ork Reisi Seungryong Vadisi üzerinde çıkmaktadır, Muhtemelen düşebilicek eşyalar aşağıdaki gibidir.', 'data/mobs/691.png', 691, '50070,90010,50513', '2019-03-16 04:29:26', '38-ork-reisi', 1),
(39, 'SpecialDrop', 'Kırmızı ejderha\'ya Ait Sandık.İçerisinde çok değerli eşyaları temin edebilirsin.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/53431.png', 53431, '90010,90011,90012,50633,50634,50635,71101,71193,30179,25040,25041,28441,28442,28443,53416,53417,30254,30319,30324,27987,70251,70252,70253,70254,27992,27993,27994,27802,27803,30169,30170,30171,71015,71017,28430,28431,28432,28433,28434,28435,28436,28437,28438,28439,28440', '2019-03-16 04:29:26', '39-mavi-olum-sandigi', 1),
(40, 'SpecialDrop', 'Mavi Ölüme Ait Sandık.Açıldığında Değerli Eşyalar elde edebilirsin.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/53430.png', 53430, '90010,90011,90012,50633,50634,50635,71101,71193,30179,25040,25041,28442,28443,53416,53417,28441,30254,30319,30324,27987,70251,70252,70253,70254,27993,27993,27994,27802,27803,30169,30170,30171,71015,71016,71017,28430,28431,28432,28433,28434,28435,28436,28437,28438,28439,28440', '2019-03-16 04:29:26', '40-kirmizi-ejderha-sandigi', 1),
(41, 'SpecialDrop', 'Beran-setaou\'ya Ait Sandık.Açıldığında Çok Değerli  Eşyalar elde edebilirsin.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/53429.png', 53429, '90010,90011,90012,50633,50634,50635,71101,71193,30179,25040,25041,28440,28441,28442,28443,53416,30264,30319,30324,27987,70251,70252,70253,70254,27992,27993,27994,27802,27803,30169,30170,30171,71015,71016,71017,28430,28431,28432,28433,28434,28435,28436,28437,28438,28439,28417', '2019-03-16 04:29:26', '41-beran-setaou-sandigi', 1),
(42, 'SpecialDrop', 'Ağır Sandıkta karanlık milletin kayıp sanılan servetleri Saklı olan sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50254.png', 50254, '25041,27992,27993,27994,70102,50513,27992,30193,39002,70048,41003,41004,30500,30501,30502,30503,30504,30505,30506,30507,30508,30509,30510,30511,30512,30513,30514,30515,30516,30517,30518,30519,30520,30521,30522,30523,16205,16206,16207,17205,17206,17207,14205,14206,14207,53501,53401,53411', '2019-03-16 04:29:26', '42-karanligin-sandigi', 1),
(43, 'SpecialDrop', 'Okey Sandığı Rastgele hediyeler sağlar', 'data/items/71196.png', 71196, '79506,25041, 61415,27992,27993,27994,41121,41120,41125,41126', '2019-03-16 04:29:26', '43-altin-okey-kutusu', 1),
(44, 'SpecialDrop', 'Okey Sandığı Rastgele hediyeler sağlar', 'data/items/71195.png', 71195, '79506,27999,25041,30338,61415,25106,71221,41119,41120', '2019-03-16 04:29:26', '44-kadim-kutsama-kuresi', 1),
(45, 'SpecialDrop', 'Okey Sandığı Rastgele hediyeler sağlar', 'data/items/71194.png', 71194, '79506,27999,70102,50300,71221', '2019-03-16 04:29:26', '45-kadim-arttirma-kagidi', 1),
(46, 'SpecialDrop', 'Şirin ve Sevimli Hayvan yavrularının olduğu eşsiz sandık.Açıldığında Rastgele bir sevimli hayvan elde edebilirsin.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/38055.png', 38055, '53001,53009,53014,53019,53027,53028,53029,53034,53036,53070', '2019-03-16 04:29:26', '46-yavrucuk-kutusu', 1),
(47, 'SpecialDrop', 'Bu Sandık buzdan yapılmıştır.Kapağı hafif bir tıkırtıyla açılır.ve içinden buz gibi bir soğuk yükselir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/38053.png', 38053, '27993,27992,27994,39029,39028,39004,53503,70039,71032,72724,72728,25040', '2019-03-16 04:29:26', '47-sonsuz-kis-sandigi', 1),
(48, 'SpecialDrop', 'Işıl ışıl buz mavisi renkli bir kutu.Rastgele bir eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/38057.png', 38057, '40137,40138,40139,40140,40141,40124', '2019-03-16 04:29:26', '48-kuzey-kutusu', 1),
(49, 'SpecialDrop', 'Bulmaca konulan bir kutu.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50034.png', 50034, '160,250,1110,2130,3140,7130,5090,1120,240,27992,27993,27994,25040', '2019-03-16 04:29:26', '49-bulmaca-kutusu', 1),
(50, 'SpecialDrop', 'Gizemli Sandık.Rastgele bir eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/38054.png', 38054, '71015,72006,39031,70102,50513,25040,58017,27992,27993,27994,72724,72728', '2019-03-16 04:29:26', '50-col-firtinasi-sandigi', 1),
(51, 'SpecialDrop', 'Kırmızı ejderha\'ya Ait Sandık.İçerisinde çok değerli eşyaları temin edebilirsin.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. (oyundaki gerçeği bu )', 'data/items/50080.png', 50080, '11294,11494,11694,11894,61413', '2019-03-16 04:29:26', '51-kirmizi-ejderha-sandigi', 1),
(52, 'SpecialDrop', 'Üzerinde Garip harfler olan Sandık.Rastgele bir eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50033.png', 50033, '58019,28430,28431,28433,28435,28436,28437,28438,28439,28440,28441,28442,28443', '2019-03-16 04:29:26', '52-gizemli-sandik', 1),
(53, 'SpecialDrop', 'Yuvarlak ve Altın Renginde Top.Rastgele bir eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50265.png', 50265, '58018,58019,80018,80019,80020,27003,27006,58017,30192,30193,30194,30195,30196,30197,30198,30199,27992,27993,27994', '2019-03-16 04:29:26', '53-altin-futbol-topu', 1),
(54, 'SpecialDrop', 'Bu Sandık tüm olimpiyatcılar için ödül olarak Rastgele bir eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50249.png', 50249, '27001,27002,27003,27004,27005,27006,70048,70102,70051,70049,25040,30045,30051,30038,30070,30023,30033,30011,30027,30082,30035,30010,30055,30006,30003,30017', '2019-03-16 04:29:26', '54-zafer-sandigi', 1),
(55, 'SpecialDrop', 'Hakiki bayan ve erkek kahramanlara özel sandık.Başarının karşılığında rastgele eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. (OYUNDA VAR)', 'data/items/71160.png', 71160, '41074,41004,41006,41008,41010,41012,41014,41026,41028,41030,41032,41034,41036,41038,41040,41042,41044,41046,41048,41050,41052,41054,41056,41058,41060,41062,41064,41066,41068,41070,41072,41080', '2019-03-16 04:29:26', '55-athenanin-sandigi', 1),
(56, 'SpecialDrop', 'Hakiki kahramanlara özel sandık.Başarının karşılığında rastgele eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. (OYUNDA VAR)', 'data/items/71159.png', 71159, '41003,41005,41007,41009,41011,41013,41025,41027,41029,41031,41033,41035,41037,41039,41041,41043,41045,41047,41049,41051,41053,41055,41057,41059,41061,41063,41065,41067,41069,41071,41073,41077,41079', '2019-03-16 04:29:26', '56-milonun-sandigi', 1),
(57, 'SpecialDrop', 'Kenarında balkabağı suratı olan bir sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50215.png', 50215, '27992,27993,27994,50513,58017', '2019-03-16 04:29:26', '57-cadilar-bayrami-sandigi', 1),
(58, 'SpecialDrop', 'Şeytani güçler bu sandığı kilitli tutuyor.İçinde değerli hazineler olmalı.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.(oyunda var)', 'data/items/50186.png', 50186, '170,250,1120,2180,3150,7150,11290,11291,11490,11491,11690,11691,11890,11891,152,153,5092,5093,142,143,3132,3133,1102,1103,7132,7133,2142,2143,11682,11683,11684,11882,11883,11884,11482,11483,11484,11282,11283,11284,180,190,1130,2170,3160,5120', '2019-03-16 04:29:26', '58-azrail-in-sandigi', 1),
(59, 'SpecialDrop', 'Hayret sandık çok hafif içi boşmuş gibi.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50126.png', 50126, '25040,71130,71083,71004,71018,71125', '2019-03-16 04:29:26', '59-esrarengiz-sandik', 1),
(60, 'SpecialDrop', 'Hayret sandık çok hafif içi boşmuş gibi.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50125.png', 50125, '71085,70039,71032,70024,25040,71012,71130,71083,71004,71018,25041,71125,50126', '2019-03-16 04:29:26', '60-esrarengiz-sandik', 1),
(61, 'SpecialDrop', 'Sanki derinlerden hayvan sesleri geliyor.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50124.png', 50124, '71114,71116,71118,71120', '2019-03-16 04:29:26', '61-eski-tahta-kutu', 1),
(62, 'SpecialDrop', 'Sürgün Mağarısından Gelen dayanıklı Sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50122.png', 50122, '17084,17102,17124,17144,17164,17184,17202,71034,71101,71020,50124,71004,72003,71016,71017,72015,72012,27987,71082', '2019-03-16 04:29:26', '62-demir-sandik', 1),
(63, 'SpecialDrop', 'Sürgün Mağarısından Gelen dayanıklı Sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50121.png', 50121, '16045,16065,16084,16104,16124,16144,16164,16184,16202,25040,70024,71004,72003,71016,71017,72015,72012,27987,71082', '2019-03-16 04:29:26', '63-demir-kutu', 1),
(64, 'SpecialDrop', 'Sürgün Mağarısından Gelen dayanıklı Sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50120.png', 50120, '14085,14185,14125,14142,14164,14184,14202,30190,71018,71019,71044,71004,72003,72006,71017,72015,72012,27987,71082', '2019-03-16 04:29:26', '64-demir-hazne', 1),
(65, 'SpecialDrop', 'Koyu Kır.Abanoz Sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50115.png', 50115, '71085,71084,50513,70102,25040,71032,71044,71045', '2019-03-16 04:29:26', '65-koyu-kirmizi-abanoz-sandik', 1),
(66, 'SpecialDrop', 'Mavi Abanoz Sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50114.png', 50114, '71085,71084,50513,70102,25040,71032,71044,71045', '2019-03-16 04:29:26', '66-mavi-abanoz-sandik', 1),
(67, 'SpecialDrop', 'Yeşil Abanoz Sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50113.png', 50113, '71085,71084,50513,70102,25040,71032,71044,71045', '2019-03-16 04:29:26', '67-yesil-abanoz-sandik', 1),
(68, 'SpecialDrop', 'Açık yeşil abanoz sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50112.png', 50112, '71085,71084,50513,70102,25040,71032,72003,72006', '2019-03-16 04:29:26', '68-acik-yesil-abanoz-sandik', 1),
(69, 'SpecialDrop', 'Sarı abanoz sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50111.png', 50111, '70048,70049,70050,70051,70052,50513,50300,70102,25040,71032,72003,72006', '2019-03-16 04:29:26', '69-sari-abanoz-sandik', 1),
(70, 'SpecialDrop', 'İhtişamlı abanoz sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50110.png', 50110, '50300,25040,71032,70003,72003,72006', '2019-03-16 04:29:26', '70-ihtisamli-abanoz-sandik', 1),
(71, 'SpecialDrop', 'Kırmızı abanoz sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50109.png', 50109, '50300,70102,25040,71044,71045,72003,72006', '2019-03-16 04:29:26', '71-kirmizi-abanoz-sandik', 1),
(72, 'SpecialDrop', 'Bal-jit elvedin gibi vuruş yap.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50096.png', 50096, '50300,70102,25040,80003,27003,27006,27002', '2019-03-16 04:29:26', '72-futbol-topu', 1),
(73, 'SpecialDrop', 'Balkabağı.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir. ', 'data/items/50095.png', 50095, '50300,70102,25040,80003,27003,27006,27002,27005', '2019-03-16 04:29:26', '73-balkabagi', 1),
(74, 'SpecialDrop', 'Ağır Sandıkta karanlık milletin kayıp sanılan servetleri Saklı olan sandık.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50090.png', 50090, '170,250,1120,2180,3150,7150,11290,11291,11490,11491,11690,11691,11890,11891,17204,17205,17206,16204,16205,16206,14204,14205,14206', '2019-03-16 04:29:26', '74-dokuzkuyruktilki-sandigi', 1),
(75, 'SpecialDrop', 'Lusifere ait sandık.İçinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50082.png', 50082, '170,250,1120,2180,3150,7150,11290,11291,11490,11491,11690,11691,11890,11891,152,153,5092,5093,142,143,3132,3133,1102,1103,7132,7133,2142,2143,11682,11683,11684,11882,11883,11884,11482,11483,11484,11282,11283,11284,180,190,1130,2170,3160,5120', '2019-03-16 04:29:26', '75-lusifer-sandigi', 1),
(76, 'SpecialDrop', 'Şeytan kralına ait sandık.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50081.png', 50081, '152,153,5092,5093,142,143,3132,3133,1102,1103,7132,7133,2142,2143,11682,11683,11684,11882,11883,11884,11482,11483,11484,11282,11283,11284,17184,17185,17186,16184,16185,16186,14184,14185,14186,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '76-seytan-kral-sandigi', 1),
(77, 'SpecialDrop', 'Ateş kralına ait sandık.içinde bazı kıymetli eşyalar mevcur.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50079.png', 50079, '151,152,153,5091,5092,5093,141,142,143,3131,3132,3133,1101,1102,1103,7131,7132,7133,2141,2142,2143,11681,11682,11683,11881,11882,11883,11481,11482,11483,11281,11282,11283,17164,17165,17166,16164,16165,16166,14164,14165,14166,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '77-ates-kral-sandigi', 1),
(78, 'SpecialDrop', 'Dev kaplana ait sandık.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50078.png', 50078, '152,153,5092,5093,142,143,3132,3133,1102,1103,7132,7133,2142,2143,11682,11683,11684,11882,11883,11884,11482,11483,11484,11282,11283,11284,17184,17185,17186,16184,16185,16186,14184,14185,14186,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '78-sari-kaplan-hayalet-sandigi', 1),
(79, 'SpecialDrop', 'Dokuz Kuyruk Sandığı.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50077.png', 50077, '151,152,5091,5092,141,142,3131,3132,1101,1102,7131,7132,2141,2142,11682,11683,11882,11883,11482,11483,11282,11283,17204,17205,17206,16204,16205,16206,14204,14205,14206,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '79-dokuz-kuyruk-sandigi', 1),
(80, 'SpecialDrop', 'Devçölkaplumbağasına ait sandık içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50076.png', 50076, '3142,3143,1112,1113,2132,2133,7142,7143,5102,5103,162,163,242,243,11681,11682,11881,11882,11481,11482,11281,11282,17184,17185,17186,16184,16185,16186,14184,14185,14186,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '80-devcolkaplumbaga-sandigi', 1),
(81, 'SpecialDrop', 'Dev örümceğe ait sandık.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50074.png', 50074, '150,151,5090,5091,140,141,3130,3131,1100,1101,7130,7131,2140,2141,11681,11682,11683,11881,11882,11883,11481,11482,11483,11281,11282,11283,14163,14164,17163,17164,16163,16164,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '81-dev-orumcegin-sandigi', 1),
(82, 'SpecialDrop', 'Kraliçe örümceğe ait sandık.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50073.png', 50073, '3142,3143,1112,1113,2132,2133,7142,7143,5102,5103,162,163,242,243,11680,11681,11880,11881,11480,11481,11280,11281,16201,16202,16203,17201,17202,17203,14201,14202,14203,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '82-kralice-orumcek-sandigi', 1),
(83, 'SpecialDrop', 'Öğreti liderine ait sandık.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50071.png', 50071, '3141,3142,1111,1112,2131,2132,7141,7142,5101,5102,161,162,241,242,11672,11673,11674,11272,11273,11274,11472,11473,11474,11872,11873,11874,16181,16182,16183,17181,17182,17183,14181,14182,14183,70012,70038,25040,70048,70037,70014,70043,70005,27112', '2019-03-16 04:29:26', '83-ogreti-lideri-sandigi', 1),
(84, 'SpecialDrop', 'Ork başkanına ait sandık.içinde bazı kıymetli eşyalar mevcut.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50070.png', 50070, '3140,3141,1110,1111,2130,2131,7140,7141,5100,5101,160,161,240,241,11671,11672,11271,11272,11471,11472,11871,11872,16161,16162,16163,17161,17162,17163,14161,14162,14163,70012,70038,25040,70048,70037,70014,70043,70005,70006,27112', '2019-03-16 04:29:26', '84-ork-baskaninin-sandigi', 1),
(85, 'SpecialDrop', '#aktifdeğil', 'data/items/50041.png', 50041, '72003,72006,72024', '2019-03-16 04:29:26', '85-hediye-paketi', 1),
(86, 'SpecialDrop', '#aktifdeğil', 'data/items/50040.png', 50040, '70003,70035,70039', '2019-03-16 04:29:26', '86-altin-sertifika', 1),
(87, 'SpecialDrop', '#aktifdeğil', 'data/items/50039.png', 50039, '25040,71044,71045', '2019-03-16 04:29:26', '87-gumus-sertifika', 1),
(88, 'SpecialDrop', '#aktifdeğil', 'data/items/50038.png', 50038, '70003,71034,71004', '2019-03-16 04:29:26', '88-tunc-sertifika', 1),
(89, 'SpecialDrop', 'Özel Kağıttan yapılmıştır.içinde nazik hediyeler olur.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50037.png', 50037, '27001,27002,27003,27004,27005,27006,70048,70102,70051,70049,25040,30045,30051,30038,30070,30023,30033,30011,30011,30082,30035,30010,30055,30006,30003,30017', '2019-03-16 04:29:26', '89-altigen-hediye-paketi', 1),
(90, 'SpecialDrop', 'Hoş bir paketleme kağıdına sarılmış hediye.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50036.png', 50036, '80004,80005,80006,50300,25040,71032,71004,70003,71018,71019,71020,50008,50108,50100,50101,50102,50103,50104,50105,11280,11260,11270,11880,11870,11860,11480,11470,11460,11680,11670,11660,90010,90011,90012', '2019-03-16 04:29:26', '90-hediye-mor', 1),
(91, 'SpecialDrop', 'Hoş bir paketleme kağıdına sarılmış hediye.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50035.png', 50035, '80004,80005,50300,25040,71032,71004,70003,71018,71019,71020,50008,50108,50100,50101,50102,50103,50104,50105,11280,11260,11270,11880,11870,11860,11480,11470,11460,11680,11670,11660,90010,90011,90012', '2019-03-16 04:29:26', '91-hediye-sari', 1),
(92, 'SpecialDrop', 'Üzerinde Garip harfler olan Sandık.Rastgele bir eşya içerir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50033.png', 50033, '50300,70102,25040', '2019-03-16 04:29:26', '92-gizemli-sandik', 1),
(93, 'SpecialDrop', 'Kakao süt yağ ve şekerden yapılır.çikolata sevgisi ifade eder sadece bayan karakterler kullanabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50032.png', 50032, '50300,70102,25040,80003,27003,27006,27002,27005', '2019-03-16 04:29:26', '93-lolipop', 1),
(94, 'SpecialDrop', 'Sevgi ifade eden romantik çiçek.sadece erkek karakterler kullanabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50031.png', 50031, '50300,70102,25040,80003,27003,27006,27002,27005', '2019-03-16 04:29:26', '94-gul', 1),
(95, 'SpecialDrop', 'Kakao süt yağ ve şekerden yapılır.çikolata sevgisi ifade eder sadece Erkek karakterler kullanabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50025.png', 50025, '50300,70102,25040,80003,27003,27006,27002,27005', '2019-03-16 04:29:26', '95-cikolata', 1),
(96, 'SpecialDrop', 'Sevgi ifade eden romantik çiçek.sadece Bayan karakterler kullanabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50024.png', 50024, '50300,70102,25040,80003,27003,27006,27002,27005', '2019-03-16 04:29:26', '96-gul', 1),
(97, 'SpecialDrop', 'Gümüş işlemeli sandık.gümüş anahtarla açılabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50013.png', 50013, '50002,70012,70008,70038,70048,70049,70050,70051,13192,13193,12222,12223,12362,12363,12502,12503,12642,12643,30015,30035,30058,30006,30082,30076,30018,30046,30021,30086,30005,30072,30080,30077,30069,30067,30075', '2019-03-16 04:29:26', '97-gumus-define-sandigi', 1),
(98, 'SpecialDrop', 'Altın işlemeli sandık.Altın anahtarla açılabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50012.png', 50012, '28430,28431,28432,28433,28434,28435,28436,28437,28438,28439,28440,28441,28442,28443,30192,30193,30194,30195,30196,30197,30198,30199', '2019-03-16 04:29:26', '98-altin-define-sandigi', 1),
(99, 'SpecialDrop', 'Göz alıcı süslemeleri insanları baştan çıkarır.Ayışığı aldığında doğa üstü şeyler olur.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50011.png', 50011, '27992,27993,27994,50513,70102,70031,58017,70039,50068,50067,25041,71032', '2019-03-16 04:29:26', '99-ayisigi-define-sandigi', 1),
(100, 'SpecialDrop', 'Bazı İnsanlar yılbaşında hediyelerini bu çorabın içine sokalar.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50010.png', 50010, '80003,50300,70201,70206,70203,70202,70204,70205,70048,70049,70050,70051,70102,71006,70008,70012,70038,27006,27003,27005,27002', '2019-03-16 04:29:26', '100-corap', 1),
(101, 'SpecialDrop', 'Gümüş işlemeli sandık.gümüş anahtarla açılabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50007.png', 50007, '27001,27002,27003,27004,27005,27006,30030,30032,30059,30056,30071,30075,30014,30061,30083,30074,30057,30016,30048,30009,30037,30039', '2019-03-16 04:29:26', '101-gumus-define-sandigi', 1),
(102, 'SpecialDrop', 'Altın işlemeli sandık.Altın anahtarla açılabilir.Muhtemelen Düşebilicek Eşyalar Aşşağıdaki Gibidir.', 'data/items/50006.png', 50006, '50300,80008,50002,70012,70008,70038,70048,70049,70050,70051,25040,121,122,1081,1082,3111,3112,2111,2112,5071,5072,7111,7112,30023,30045,30038,30051,30011,30070,30017,30033,30055,30053,30007,30031,30028,30047,30052,30027,30003,30081,30022,30010,30025,30004,30050,30075', '2019-03-16 04:29:26', '102-altin-define-sandigi', 1),
(103, 'SpecialDrop', '#aktifdeğil', 'data/items/30097.png', 30097, '25040,70024,70027', '2019-03-16 04:29:26', '103-magaza-sansli-kesesi', 1),
(104, 'SpecialDrop', '#aktifdeğil', 'data/items/53428.png', 53428, '70101', '2019-03-16 04:29:26', '104-lonca-kurma-kitabi-sandigi', 1),
(998, 'Other', '<div class=\"Karakter_Kutu haberler\" style=\"height:auto;\">\n		<div class=\"Karakter_Kutu_Baslik\">\n			<h2>BİYOLOG SİSTEMİ</h2>\n			<center><small>Biyolog sürelerinin ve geçme oranlarının bulunduğu tablo.</small></center>\n		</div>\n		<div class=\"Karakter_Kutu_Icerik Sol-Alt\" style=\"height:auto;\">\n			<table id=\"large\" cellspacing=\"0\" class=\"tablesorter\">\n				<thead>\n					<tr>\n						<th>Görev Nesnesi</th>\n						<th>Geçme Oranı</th>\n						<th>Bekleme Süresi</th>\n						<th>Ödül</th>\n					</tr>\n				</thead>\n				<tbody>\n					<tr>\n						<td>Ork Dişi <img src=\"data/items/30006.png\" alt=\"Ork Dişi\" title=\"Ork Dişi\"></td>\n						<td>100%</td>\n						<td>-</td>\n						<td>+10% Hareket Hızı</td>\n					</tr>\n					<tr>\n						<td>Lanet Kitabı <img src=\"data/items/30047.png\" alt=\"Lanet Kitabı\" title=\"Lanet Kitabı\"></td>\n						<td>85%</td>\n						<td>-</td>\n						<td>+5% Saldırı Hızı</td>\n					</tr>\n					<tr>\n						<td>Şeytan Hatırası <img src=\"data/items/30015.png\" alt=\"Şeytan Hatırası\" title=\"Şeytan Hatırası\"></td>\n						<td>75%</td>\n						<td>-</td>\n						<td>+60 Savunma</td>\n					</tr>\n					<tr>\n						<td>Buz Topu <img src=\"data/items/30050.png\" alt=\"Buz Topu\" title=\"Buz Topu\"></td>\n						<td>70%</td>\n						<td>-</td>\n						<td>+50 Saldırı Değeri</td>\n					</tr>\n					<tr>\n						<td>Zelkova Dalı <img src=\"data/items/30165.png\" alt=\"Zelkova Dalı\" title=\"Zelkova Dalı\"></td>\n						<td>70%</td>\n						<td>-</td>\n						<td>+11% Hareket Hızı <br>+10% Hasar Azaltma</td>\n					</tr>\n					<tr>\n						<td>Tugyis Tabelası <img src=\"data/items/30166.png\" alt=\"Tugyis Tabelası\" title=\"Tugyis Tabelası\"></td>\n						<td>70%</td>\n						<td>-</td>\n						<td>+6% Saldırı Hızı<br>+10% Saldırı Değeri</td>\n					</tr>\n					<tr>\n						<td>Kır. Hayalet Ağacı Dalı <img src=\"data/items/30167.png\" alt=\"Kır. Hayalet Ağacı Dalı\" title=\"Kır. Hayalet Ağacı Dalı\"></td>\n						<td>70%</td>\n						<td>20 Dakika</td>\n						<td>10% Yarı insan savunması</td>\n					</tr>\n					<tr>\n						<td>Liderlerin Notları<img src=\"data/items/30168.png\" alt=\"Liderlerin Notları\" title=\"Liderlerin Notları\"></td>\n						<td>70%</td>\n						<td>30 Dakika</td>\n						<td>8% Yarı insan saldırı hasarı</td>\n					</tr>\n					<tr>\n						<td>Kem Göz Mücevheri <img src=\"data/items/30251.png\" alt=\"Kem Göz Mücevheri\" title=\"Kem Göz Mücevheri\"></td>\n						<td>70%</td>\n						<td>1 Saat</td>\n						<td>1.000 HP veya<br>120 Savunma veya<br>50 Saldırı Değeri</td>\n					</tr>\n					<tr>\n						<td>Bilgelik Mücevheri <img src=\"data/items/30252.png\" alt=\"Bilgelik Mücevheri\" title=\"Bilgelik Mücevheri\"></td>\n						<td>70%</td>\n						<td>2 Saat</td>\n						<td>1.100 HP veya<br>140 Savunma veya<br>60 Saldırı Değeri</td>\n					</tr>\n				</tbody>\n			</table>\n			<div style=\"clear:both;\"></div>\n		</div>\n	</div>', 'data/wiki/other.png', 0, '', '2019-03-16 13:58:55', 'biyolog-sistemi', 1),
(999, 'Other', '<div class=\"Karakter_Kutu haberler\" style=\"height:auto;\">\r\n		<div class=\"Karakter_Kutu_Baslik\">\r\n			<h2>EFSUN ORANLARI</h2>\r\n			<center><small>Efsun oranlarını belirten tablo</small></center>\r\n		</div>\r\n		<div class=\"Karakter_Kutu_Icerik Sol-Alt\" style=\"height:auto;\">\r\n			<table id=\"large\" cellspacing=\"0\" class=\"tablesorter\">\r\n				<thead>\r\n					<tr>\r\n						<th>Efsun Adı</th>\r\n						<th>Efsun Oranı</th>\r\n						<th>Geçme Oranı</th>\r\n					</tr>\r\n				</thead>\r\n				<tbody>\r\n					<tr>\r\n						<td>Max HP</td>\r\n						<td>3000</td>\r\n						<td>85</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Max SP</td>\r\n						<td>80</td>\r\n						<td>35</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Canlılık</td>\r\n						<td>12</td>\r\n						<td>50</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Zeka</td>\r\n						<td>12</td>\r\n						<td>50</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Güç</td>\r\n						<td>12</td>\r\n						<td>50</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Çeviklik</td>\r\n						<td>12</td>\r\n						<td>50</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Saldiri Hızı</td>\r\n						<td>10</td>\r\n						<td>35</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Hareket Hızı</td>\r\n						<td>20</td>\r\n						<td>35</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Büyü Hızı</td>\r\n						<td>20</td>\r\n						<td>35</td>\r\n					</tr>\r\n					<tr>\r\n						<td>HP Üretimi</td>\r\n						<td>30</td>\r\n						<td>65</td>\r\n					</tr>\r\n					<tr>\r\n						<td>SP Üretimi</td>\r\n						<td>30</td>\r\n						<td>65</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Zehirleme Şansı</td>\r\n						<td>10</td>\r\n						<td>25</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Sersemletme Şansı</td>\r\n						<td>10</td>\r\n						<td>40</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Yavaşlatma Şansı</td>\r\n						<td>10</td>\r\n						<td>25</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Kritik Vuruş Şansı</td>\r\n						<td>15</td>\r\n						<td>55</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delici Vuruş Şansı</td>\r\n						<td>15</td>\r\n						<td>55</td>\r\n					</tr><tr>\r\n						<td>Yarı İnsanlara Karşı Güçlü</td>\r\n						<td>15</td>\r\n						<td>70</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<div style=\"clear:both;\"></div>\r\n		</div>\r\n	</div>', 'data/wiki/other.png', 0, '', '2019-03-16 13:58:53', 'efsun-oranlari', 1),
(107, 'GameSystem', '#duzenlenecektir', 'data/wiki/BossDedektoru.png', 3, '', '2019-03-16 14:27:36', '107-boss-dedektoru', 1),
(106, 'GameSystem', '#duzenlenecektir', 'data/wiki/BonusAktarimi.png', 2, NULL, '2019-03-16 14:27:36', '106-bonus-aktarimi', 1),
(105, 'GameSystem', '#duzenlenecektir', 'data/wiki/BKEnvanteri.png', 1, NULL, '2019-03-16 14:27:35', '105-bk-envanteri', 1),
(108, 'GameSystem', '#duzenlenecektir', 'data/wiki/CevrimdisiPazar.png', 4, NULL, '2019-03-16 14:27:37', '108-cevrimdisi-pazar', 1),
(109, 'GameSystem', '#duzenlenecektir', 'data/wiki/EfsunBotu.png', 5, NULL, '2019-03-16 14:27:37', '109-efsun-botu', 1),
(110, 'GameSystem', '#duzenlenecektir', 'data/wiki/GelismisOyunSecenekleri.png', 6, NULL, '2019-03-16 14:27:38', '110-gelismis-oyun-secenekleri', 1),
(111, 'GameSystem', '#duzenlenecektir', 'data/wiki/GrupKutsama.png', 7, NULL, '2019-03-16 14:27:39', '111-grup-kutsama', 1),
(112, 'GameSystem', '#duzenlenecektir', 'data/wiki/GucluBinek.png', 8, NULL, '2019-03-16 14:27:39', '112-guclu-binek', 1),
(113, 'GameSystem', '#duzenlenecektir', 'data/wiki/HizliBiyolog.png', 9, NULL, '2019-03-16 14:27:40', '113-hizli-biyolog', 1),
(114, 'GameSystem', '#duzenlenecektir', 'data/wiki/IsinlanmaTahtasi.png', 10, NULL, '2019-03-16 14:27:40', '114-isinlanma-tahtasi', 1),
(115, 'GameSystem', '#duzenlenecektir', 'data/wiki/KostumParlama.png', 11, NULL, '2019-03-16 14:27:41', '115-kostum-parlama', 1),
(116, 'GameSystem', '#duzenlenecektir', 'data/wiki/LogSistemi.png', 12, NULL, '2019-03-16 14:27:42', '116-log-sistemi', 1),
(117, 'GameSystem', '#duzenlenecektir', 'data/wiki/LoncaAjan.png', 13, NULL, '2019-03-16 14:27:43', '117-lonca-ajan', 1),
(118, 'GameSystem', '#duzenlenecektir', 'data/wiki/LoncaIstatistik.png', 14, NULL, '2019-03-16 14:27:44', '118-lonca-istatistik', 1),
(119, 'GameSystem', '#duzenlenecektir', 'data/wiki/MobInfoSistemi.png', 15, NULL, '2019-03-16 14:27:45', '119-mob-drop-info', 1),
(120, 'GameSystem', '#duzenlenecektir', 'data/wiki/OtomatikAv.png', 16, NULL, '2019-03-16 14:27:46', '120-otomatik-av', 1),
(121, 'GameSystem', '#duzenlenecektir', 'data/wiki/PazarDekorasyon.png', 17, NULL, '2019-03-16 14:27:47', '121-pazar-dekorasyon', 1),
(122, 'GameSystem', '#duzenlenecektir', 'data/wiki/SandikAynasi.png', 18, NULL, '2019-03-16 14:27:49', '122-sandik-aynasi', 1),
(123, 'GameSystem', '#duzenlenecektir', 'data/wiki/SistemSecenekleri.png', 19, NULL, '2019-03-16 14:27:51', '123-sistem-secenekleri', 1),
(124, 'GameSystem', '#duzenlenecektir', 'data/wiki/TicaretCami.png', 20, NULL, '2019-03-16 14:27:52', '124-ticaret-cami', 1),
(125, 'GameSystem', '#duzenlenecektir', 'data/wiki/UzakMarket.png', 21, NULL, '2019-03-16 14:27:53', '125-uzak-market', 1),
(126, 'GameSystem', '#duzenlenecektir', 'data/wiki/Yansitma.png', 22, NULL, '2019-03-16 14:27:54', '126-yansitma-sistemi', 1),
(127, 'GameSystem', '#duzenlenecektir', 'data/wiki/YardimciSaman.png', 24, NULL, '2019-03-16 14:27:55', '127-yardimci-saman', 1),
(128, 'GameSystem', '#duzenlenecektir', 'data/wiki/YeniDuygular.png', 25, NULL, '2019-03-16 14:27:56', '128-yeni-duygular', 1),
(129, 'GameSystem', '#duzenlenecektir', 'data/wiki/YoutuberSistemi.png', 23, NULL, '2019-03-16 14:27:57', '129-youtuber-sistemi', 1),
(130, 'GameNpc', '#duzenlenecektir', 'data/wiki/Satici1.png', 26, NULL, '2019-03-16 14:28:40', '130-satici-npc1', 1),
(131, 'GameNpc', '#duzenlenecektir', 'data/wiki/Satici2.png', 27, NULL, '2019-03-16 14:28:39', '131-satici-npc2', 1),
(132, 'GameNpc', '#duzenlenecektir', 'data/wiki/ZirhciSilahci.png', 28, NULL, '2019-03-16 14:28:39', '132-zirhci-silahci-npc', 1),
(133, 'ItemUpgrade', '#duzenlenecektir', 'data/wiki/BetaDonusum.png', 29, NULL, '2019-03-16 14:28:38', '133-beta-donusumleri', 1),
(134, 'GameSystem', '#duzenlenecektir', 'data/wiki/Baslangic.png', 0, NULL, '2019-03-16 14:28:28', '134-baslangic-esyalari', 1),
(997, 'Other', '<div class=\"Karakter_Kutu haberler\" style=\"height:auto;\">\r\n		<div class=\"Karakter_Kutu_Baslik\">\r\n			<h2>ETKİNLİK TAKVİMİ</h2>\r\n			<center><small>Oyun içerisinde olacak etkinlikler hakkında tablo.</small></center>\r\n		</div>\r\n		<div class=\"Karakter_Kutu_Icerik Sol-Alt\" style=\"height:auto;\">\r\n			<table id=\"large\" cellspacing=\"0\" class=\"tablesorter\">\r\n				<thead>\r\n					<tr>\r\n						<th></th>\r\n						<th>Etkinlik Adı</th>\r\n						<th>Etkinlik Günü</th>\r\n						<th>Başlama Saati</th>\r\n						<th>Bitiş Saati</th>\r\n					</tr>\r\n				</thead>\r\n				<tbody>\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/5/Okey-Koleksiyon-Karti.html\"><img src=\"data/items/79505.png\" alt=\"Okey Koleksiyon Kartı\" title=\"Okey Koleksiyon Kartı\"></a></th>\r\n						<td>Okey Koleksiyon Kartı</td>\r\n						<td>Pazartesi</td>\r\n						<td>12:00</td>\r\n						<td>22:00</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a><img src=\"data/items/70005.png\" alt=\"Tecrübe Kazanımı Etkinliği\" title=\"Tecrübe Kazanımı Etkinliği\"></a></th>\r\n						<td>+%50 Tecrübe Kazanımı Etkinliği</td>\r\n						<td>Pazartesi</td>\r\n						<td>22:00</td>\r\n						<td>23:59</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/1/Ayisigi-Define-Sandigi.html\"><img src=\"data/items/50011.png\" alt=\"Ayışığı Define Sandığı\" title=\"Ayışığı Define Sandığı\"></a></th>\r\n						<td>Ayışığı Define Sandığı</td>\r\n						<td>Salı</td>\r\n						<td>20:00</td>\r\n						<td>21:00</td>\r\n					</tr>						\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/5/Okey-Koleksiyon-Karti.html\"><img src=\"data/items/79505.png\" alt=\"Okey Koleksiyon Kartı\" title=\"Okey Koleksiyon Kartı\"></a></th>\r\n						<td>Okey Koleksiyon Kartı</td>\r\n						<td>Çarşamba</td>\r\n						<td>12:00</td>\r\n						<td>22:00</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a><img src=\"data/items/70005.png\" alt=\"Tecrübe Kazanımı Etkinliği\" title=\"Tecrübe Kazanımı Etkinliği\"></a></th>\r\n						<td>+%50 Tecrübe Kazanımı Etkinliği</td>\r\n						<td>Çarşamba</td>\r\n						<td>22:00</td>\r\n						<td>23:59</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/6/Futbol-Topu.html\"><img src=\"data/items/50096.png\" alt=\"Futbol Topu\" title=\"Futbol Topu\"></a></th>\r\n						<td>Futbol Topu</td>\r\n						<td>Perşembe</td>\r\n						<td>20:00</td>\r\n						<td>21:00</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/5/Okey-Koleksiyon-Karti.html\"><img src=\"data/items/79505.png\" alt=\"Okey Koleksiyon Kartı\" title=\"Okey Koleksiyon Kartı\"></a></th>\r\n						<td>Okey Koleksiyon Kartı</td>\r\n						<td>Cuma</td>\r\n						<td>12:00</td>\r\n						<td>22:00</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a><img src=\"data/items/70005.png\" alt=\"Tecrübe Kazanımı Etkinliği\" title=\"Tecrübe Kazanımı Etkinliği\"></a></th>\r\n						<td>+%50 Tecrübe Kazanımı Etkinliği</td>\r\n						<td>Cumartesi</td>\r\n						<td>14:00</td>\r\n						<td>17:00</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/7/Kuzey-Kutusu.html\"><img src=\"data/items/50128.png\" alt=\"Kuzey Kutusu\" title=\"Kuzey Kutusu\"></a></th>\r\n						<td>Kuzey Kutusu</td>\r\n						<td>Cumartesi</td>\r\n						<td>20:00</td>\r\n						<td>21:00</td>\r\n					</tr>\r\n					<tr>\r\n						<th class=\"text-center\"><a href=\"Item/4/Bulmaca-Kutusu.html\"><img src=\"data/items/50034.png\" alt=\"Bulmaca Kutusu\" title=\"Bulmaca Kutusu\"></a></th>\r\n						<td>Bulmaca Kutusu</td>\r\n						<td>Pazar</td>\r\n						<td>15:00</td>\r\n						<td>17:00</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			<div style=\"clear:both;\"></div>\r\n		</div>\r\n	</div>', 'data/wiki/other.png', 0, NULL, '2019-03-16 14:10:10', 'etkinlik-takvimi', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_categories`
--
ALTER TABLE `admin_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Tablo için indeksler `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `api_kasagame`
--
ALTER TABLE `api_kasagame`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `api_paytr`
--
ALTER TABLE `api_paytr`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `api_paywant`
--
ALTER TABLE `api_paywant`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Tablo için indeksler `api_teckcard`
--
ALTER TABLE `api_teckcard`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Tablo için indeksler `autopatcher`
--
ALTER TABLE `autopatcher`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ban_list`
--
ALTER TABLE `ban_list`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ep_log`
--
ALTER TABLE `ep_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ep_price`
--
ALTER TABLE `ep_price`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `event_crone`
--
ALTER TABLE `event_crone`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `event_list`
--
ALTER TABLE `event_list`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `extra_page`
--
ALTER TABLE `extra_page`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `findme_list`
--
ALTER TABLE `findme_list`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `index_basliklar`
--
ALTER TABLE `index_basliklar`
  ADD PRIMARY KEY (`kategori_id`) USING BTREE;

--
-- Tablo için indeksler `index_detay`
--
ALTER TABLE `index_detay`
  ADD PRIMARY KEY (`konu_id`) USING BTREE;

--
-- Tablo için indeksler `index_market`
--
ALTER TABLE `index_market`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ip_list`
--
ALTER TABLE `ip_list`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `itemci_price`
--
ALTER TABLE `itemci_price`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `items_log`
--
ALTER TABLE `items_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `kuponlar`
--
ALTER TABLE `kuponlar`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `log_virustotal`
--
ALTER TABLE `log_virustotal`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `old_password`
--
ALTER TABLE `old_password`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `patch`
--
ALTER TABLE `patch`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `payreks_log`
--
ALTER TABLE `payreks_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `player_log`
--
ALTER TABLE `player_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `sanalpay_api`
--
ALTER TABLE `sanalpay_api`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `shop_bonus`
--
ALTER TABLE `shop_bonus`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `shop_menu`
--
ALTER TABLE `shop_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `slot_gift_log`
--
ALTER TABLE `slot_gift_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `slot_log`
--
ALTER TABLE `slot_log`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ticket_count`
--
ALTER TABLE `ticket_count`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ticket_status`
--
ALTER TABLE `ticket_status`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `ticket_title`
--
ALTER TABLE `ticket_title`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `wheel_items`
--
ALTER TABLE `wheel_items`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `wiki`
--
ALTER TABLE `wiki`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_categories`
--
ALTER TABLE `admin_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Tablo için AUTO_INCREMENT değeri `api_kasagame`
--
ALTER TABLE `api_kasagame`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `api_paytr`
--
ALTER TABLE `api_paytr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `api_paywant`
--
ALTER TABLE `api_paywant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `api_teckcard`
--
ALTER TABLE `api_teckcard`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `autopatcher`
--
ALTER TABLE `autopatcher`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `ban_list`
--
ALTER TABLE `ban_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ep_log`
--
ALTER TABLE `ep_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ep_price`
--
ALTER TABLE `ep_price`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `event_crone`
--
ALTER TABLE `event_crone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `event_list`
--
ALTER TABLE `event_list`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `extra_page`
--
ALTER TABLE `extra_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `findme_list`
--
ALTER TABLE `findme_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `index_basliklar`
--
ALTER TABLE `index_basliklar`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `index_detay`
--
ALTER TABLE `index_detay`
  MODIFY `konu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `index_market`
--
ALTER TABLE `index_market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `ip_list`
--
ALTER TABLE `ip_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `itemci_price`
--
ALTER TABLE `itemci_price`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

--
-- Tablo için AUTO_INCREMENT değeri `items_log`
--
ALTER TABLE `items_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `language`
--
ALTER TABLE `language`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `login_log`
--
ALTER TABLE `login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `log_virustotal`
--
ALTER TABLE `log_virustotal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Tablo için AUTO_INCREMENT değeri `old_password`
--
ALTER TABLE `old_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `pack`
--
ALTER TABLE `pack`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `patch`
--
ALTER TABLE `patch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `payreks_log`
--
ALTER TABLE `payreks_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `player_log`
--
ALTER TABLE `player_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `sanalpay_api`
--
ALTER TABLE `sanalpay_api`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Tablo için AUTO_INCREMENT değeri `shop_bonus`
--
ALTER TABLE `shop_bonus`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `shop_menu`
--
ALTER TABLE `shop_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `slot_gift_log`
--
ALTER TABLE `slot_gift_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `slot_log`
--
ALTER TABLE `slot_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ticket_count`
--
ALTER TABLE `ticket_count`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `ticket_status`
--
ALTER TABLE `ticket_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `ticket_title`
--
ALTER TABLE `ticket_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `wheel_items`
--
ALTER TABLE `wheel_items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `wiki`
--
ALTER TABLE `wiki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `admin_categories`
--
ALTER TABLE `admin_categories`
  ADD CONSTRAINT `admin_categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `admin_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
