-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 May 2024, 19:00:59
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `btbs404`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `btbs404`
--

CREATE TABLE `btbs404` (
  `ogrno` int(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `gizli` varchar(30) NOT NULL,
  `ogradi` varchar(20) NOT NULL,
  `ogrsoyadi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `btbs404`
--

INSERT INTO `btbs404` (`ogrno`, `password`, `gizli`, `ogradi`, `ogrsoyadi`) VALUES
(22002313, 'abidik123', 'sanane', 'Abdulkadir', 'KARKIN'),
(22002300, 'abidik123', 'sananeocc', 'BİLEN', 'BİLMEN'),
(22002100, 'abidik123', 'sanane', 'Duran', 'Uygur'),
(12345678, 'abidik123', 'sanane', 'Serdar', 'COŞAR'),
(87654321, 'ABİDİK123', 'köpek', 'Hüseyin', 'KARKIN'),
(20002313, 'abidik123', 'sanane', 'Derya', 'KARKIN'),
(19002313, 'abidik123', 'sanane', 'Yusuf', 'Kaçar'),
(220123456, 'abidik123', 'sananee', 'Abdulkadir', 'Durmaz'),
(24002313, 'abidik123', 'sanane', 'Bilal', 'Güven'),
(2147483647, 'ABİDİK123', 'SANANE', 'wqdqwdwdq', 'eww'),
(2147483647, 'ABİDİK123', 'soru', 'Kadir', 'KARKIN');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `derece`
--

CREATE TABLE `derece` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) NOT NULL,
  `soyisim` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `yorum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `derece`
--

INSERT INTO `derece` (`id`, `isim`, `soyisim`, `rating`, `yorum`) VALUES
(17, 'Abdulkadir', 'KARKIN', 1, 'iyi'),
(18, 'Abdulkadir', 'KARKIN', 5, 'nasılsın'),
(19, 'Abdulkadir', 'KARKIN', 1, 'WQDFWQDWQDDWQ'),
(20, 'BİLEN', 'BİLMEN', 1, 'sedfdsfdsdfsds'),
(21, 'BİLEN', 'BİLMEN', 5, 'fgdgfgddfg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `gondogrno` varchar(50) NOT NULL,
  `gondogradi` varchar(50) NOT NULL,
  `gondogrsoyadi` varchar(50) NOT NULL,
  `aliciogrno` varchar(50) NOT NULL,
  `mesaj` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`gondogrno`, `gondogradi`, `gondogrsoyadi`, `aliciogrno`, `mesaj`) VALUES
('22002313', 'Abdulkadir', 'KARKIN', '22002313', 'qwdqw'),
('19002313', 'Yusuf', 'Kaçar', '22002100', 'merhaba'),
('22002313', 'Abdulkadir', 'KARKIN', '22002100', 'qwdwq'),
('22002313', 'Abdulkadir', 'KARKIN', '22002100', 'qwdqwdwq'),
('2147483647', 'wqdqwdwdq', 'eww', '22002300', 'merhaba');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yurtkars`
--

CREATE TABLE `yurtkars` (
  `yurtadi` varchar(30) NOT NULL,
  `wifi` varchar(30) NOT NULL,
  `klima` varchar(10) NOT NULL,
  `banyo` varchar(10) NOT NULL,
  `yatak` varchar(10) NOT NULL,
  `balkon` varchar(10) NOT NULL,
  `televizyon` varchar(10) NOT NULL,
  `dolap` varchar(10) NOT NULL,
  `telefon` varchar(10) NOT NULL,
  `resim_url` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yurtkars`
--

INSERT INTO `yurtkars` (`yurtadi`, `wifi`, `klima`, `banyo`, `yatak`, `balkon`, `televizyon`, `dolap`, `telefon`, `resim_url`) VALUES
('Alfam Vista', 'var', 'yok', 'var', 'var', 'yok', 'var', 'var', 'var', 'alfam.JPG'),
('Uğursal', 'var', 'yok', 'var', 'var', 'yok', 'var', 'var', 'yok', 'ugursal.JPG'),
('Longson', 'yok', 'yok', 'var', 'var', 'yok', 'yok', 'var', 'yok', 'longson.JPG'),
('Inn Dorm', 'var', 'yok', 'var', 'var', 'yok', 'yok', 'var', 'yok', 'inndorm.JPG'),
('Ramen', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'ramen.JPG'),
('Prime Living', 'var', 'var', 'yok', 'var', 'yok', 'yok', 'var', 'yok', 'primeliving.JPG'),
('Golden Plus', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'goldenplus.JPG'),
('Astra Plus', 'var', 'var', 'var', 'var', 'var', 'yok', 'var', 'var', 'astraplus.JPG'),
('Popart', 'var', 'var', 'yok', 'var', 'yok', 'var', 'var', 'yok', 'popart.JPG'),
('Novel Centrepoint', 'yok', 'var', 'var', 'var', 'var', 'yok', 'var', 'var', 'Novel Centrepoint.JPG'),
('Nural Dorm', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'yok', 'Nural Dorm.JPG'),
('Grand Aras', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'var', 'Grandaras.JPG');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yurtkayit`
--

CREATE TABLE `yurtkayit` (
  `yurtadi` varchar(50) NOT NULL,
  `odano` varchar(50) NOT NULL,
  `ogrno` varchar(50) NOT NULL,
  `ogradi` varchar(50) NOT NULL,
  `ogrsoyadi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yurtkayit`
--

INSERT INTO `yurtkayit` (`yurtadi`, `odano`, `ogrno`, `ogradi`, `ogrsoyadi`) VALUES
('Alfam Vista', '18', '22002313', 'Abdulkadir', 'KARKIN'),
('Uğursal', '16', '22002313', 'Abdulkadir', 'KARKIN'),
('Uğursal', '25', '22002313', 'Abdulkadir', 'KARKIN'),
('Alfam Vista', '11', '22002300', 'BİLEN', 'BİLMEN'),
('Uğursal', '1', '22002300', 'BİLEN', 'BİLMEN'),
('Uğursal', '16', '22002300', 'BİLEN', 'BİLMEN'),
('Alfam Vista', '18', '22002300', 'BİLEN', 'BİLMEN'),
('Alfam Vista', '29', '22002100', 'Duran', 'Uygur'),
('Alfam Vista', '18', '19002313', 'Yusuf', 'Kaçar'),
('Alfam Vista', '23', '22002100', 'Duran', 'Uygur'),
('Longson', '14', '2147483647', 'wqdqwdwdq', 'eww');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yurtlar`
--

CREATE TABLE `yurtlar` (
  `yurtadi` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kontenjan` int(5) NOT NULL DEFAULT 30,
  `odatipi` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `odalani` varchar(40) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `fiyat` int(10) NOT NULL,
  `fiyat2023` int(10) NOT NULL,
  `fiyat2022` int(10) NOT NULL,
  `fiyat2021` int(10) NOT NULL,
  `fiyat2020` int(10) NOT NULL,
  `internet` varchar(15) NOT NULL,
  `mutfak` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kafeterya` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kampus` varchar(15) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yurtlar`
--

INSERT INTO `yurtlar` (`yurtadi`, `kontenjan`, `odatipi`, `odalani`, `fiyat`, `fiyat2023`, `fiyat2022`, `fiyat2021`, `fiyat2020`, `internet`, `mutfak`, `kafeterya`, `kampus`) VALUES
('Alfam Vista', 31, 'Tek kişilik', '31', 8280, 5100, 4000, 1900, 5800, '10 mbps', 'katta', 'var', 'Kuzey'),
('Uğursal', 24, 'Tek kişilik', '24', 7600, 3500, 2400, 6300, 5200, '10 mbps', 'katta', 'yok', 'Kuzey'),
('Longson', 25, 'Tek kişilik', '10', 6000, 1000, 1232, 1242, 1265, '10 mbps', 'katta', 'var', 'Kuzey'),
('Inn Dorm', 30, 'Tek kişilik', '30', 7700, 3600, 2500, 5400, 5300, '8 mbps', 'koridor', 'yok', 'Kuzey'),
('Inn Dorm', 30, 'İki kişilik', '24', 3700, 9600, 3500, 3400, 3300, '8 mbps', 'koridor', 'var', 'Kuzey'),
('Ramen', 24, 'Tek kişilik', '24', 7200, 1100, 2000, 6900, 6800, 'sınırsız', 'odada', 'yok', 'Kuzey'),
('Prime Living', 35, 'Tek kişilik', '35', 7650, 2550, 1450, 7350, 7250, 'sınırsız', 'katta', 'var', 'Kuzey'),
('Golden Plus', 36, '1+1 Suit Oda Çift', '36', 2400, 8000, 7000, 6000, 4000, 'sınırsız', 'katta', 'yok', 'Kuzey'),
('Astra Plus', 17, 'Tek kişilik', '17', 2200, 2100, 2000, 1900, 1800, 'sınırsız', 'katta', 'var', 'Güney'),
('Astra Plus', 17, 'İki kişilik', '17', 5000, 6000, 7000, 2000, 6000, 'sınırsız', 'katta', 'yok', 'Güney'),
('Popart', 32, 'İki kişilik', '32', 7650, 2550, 1450, 350, 7250, 'sınırsız', 'katta', 'var', 'Güney'),
('Novel Centrepoint', 36, 'Tek kişilik', '36', 6905, 2805, 6705, 6605, 6505, 'sınırsız', 'odada', 'yok', 'Güney'),
('Novel Centrepoint', 36, 'Suit Oda Çift', '36', 2905, 6805, 6705, 6605, 6505, 'sınırsız', 'odada', 'var', 'Güney'),
('Nural Dorm', 24, 'İki kişilik', '24', 5800, 5700, 2600, 5500, 5400, 'sınırsız', 'odada', 'yok', 'Güney'),
('Grand Aras', 36, 'Tek kişilik', '36', 3700, 3600, 2500, 3400, 3300, 'sınırsız', 'katta', 'var', 'Güney');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yurtsahip`
--

CREATE TABLE `yurtsahip` (
  `kimlikno` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `shpadi` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `shpsoyadi` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `yurtsahip`
--

INSERT INTO `yurtsahip` (`kimlikno`, `password`, `shpadi`, `shpsoyadi`) VALUES
('13739901340', 'abidik123', 'Abdulkadir', 'Karkın'),
('13739901341', 'abidik123', 'BİLEN', 'BİLMEN'),
('', '', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `derece`
--
ALTER TABLE `derece`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `derece`
--
ALTER TABLE `derece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
