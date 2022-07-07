-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Nis 2022, 12:49:33
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dbcafe`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'can', '2c61ebff5a7f675451467527df66788d');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `marka`
--

CREATE TABLE `marka` (
  `marka_id` int(11) NOT NULL,
  `marka_ad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `marka`
--

INSERT INTO `marka` (`marka_id`, `marka_ad`) VALUES
(1, 'Coca Cola'),
(2, 'Pepsi'),
(3, 'RedBull'),
(4, 'Starbucks'),
(5, 'Sprite'),
(7, 'Hayat');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satici`
--

CREATE TABLE `satici` (
  `satici_id` int(11) NOT NULL,
  `satici_ad` varchar(50) NOT NULL,
  `satici_numara` bigint(11) NOT NULL,
  `satici_adres` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `satici`
--

INSERT INTO `satici` (`satici_id`, `satici_ad`, `satici_numara`, `satici_adres`) VALUES
(1, 'PepsiCo San. Tic. Ltd. Şti', 5431231212, 'Tekfen Tower Büyükdere Cad. No:209 A Blok D:3 34394 4. Levent / Şişli / İstanbul'),
(3, 'Starbucks Şirketi', 5554443322, ' Seattle, Washington'),
(5, 'Coca Cola', 5554443322, 'İstanbul');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

CREATE TABLE `stok` (
  `stok_id` int(11) NOT NULL,
  `satici_ad` int(11) NOT NULL,
  `stok_tarih` datetime NOT NULL,
  `stok_adet` int(11) NOT NULL,
  `urun_ad` int(11) NOT NULL,
  `urun_fiyat_alis` float NOT NULL,
  `urun_fiyat_satis` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `stok`
--

INSERT INTO `stok` (`stok_id`, `satici_ad`, `stok_tarih`, `stok_adet`, `urun_ad`, `urun_fiyat_alis`, `urun_fiyat_satis`) VALUES
(2, 1, '2022-04-05 15:00:00', 22, 8, 12.55, 13.89);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tur`
--

CREATE TABLE `tur` (
  `tur_id` int(11) NOT NULL,
  `tur_ad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `tur`
--

INSERT INTO `tur` (`tur_id`, `tur_ad`) VALUES
(2, 'Soğuk İçecek'),
(3, 'Enerji İçeceği'),
(5, 'Sıcak İçecek'),
(6, 'Kahve'),
(7, 'Çay');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `urun_id` int(11) NOT NULL,
  `urun_tur` int(11) NOT NULL,
  `urun_marka` int(11) NOT NULL,
  `urun_ad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`urun_id`, `urun_tur`, `urun_marka`, `urun_ad`) VALUES
(8, 2, 2, 'Kutu İçecek'),
(10, 5, 4, 'Çay');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`marka_id`);

--
-- Tablo için indeksler `satici`
--
ALTER TABLE `satici`
  ADD PRIMARY KEY (`satici_id`);

--
-- Tablo için indeksler `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `stok_tarih` (`stok_tarih`),
  ADD KEY `urun_ad` (`urun_ad`),
  ADD KEY `satici_ad` (`satici_ad`);

--
-- Tablo için indeksler `tur`
--
ALTER TABLE `tur`
  ADD PRIMARY KEY (`tur_id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urun_id`),
  ADD KEY `urun_tur` (`urun_tur`),
  ADD KEY `urun_marka` (`urun_marka`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `marka`
--
ALTER TABLE `marka`
  MODIFY `marka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `satici`
--
ALTER TABLE `satici`
  MODIFY `satici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `stok`
--
ALTER TABLE `stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `tur`
--
ALTER TABLE `tur`
  MODIFY `tur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`urun_ad`) REFERENCES `urun` (`urun_id`),
  ADD CONSTRAINT `stok_ibfk_3` FOREIGN KEY (`satici_ad`) REFERENCES `satici` (`satici_id`);

--
-- Tablo kısıtlamaları `urun`
--
ALTER TABLE `urun`
  ADD CONSTRAINT `urun_ibfk_1` FOREIGN KEY (`urun_tur`) REFERENCES `tur` (`tur_id`),
  ADD CONSTRAINT `urun_ibfk_2` FOREIGN KEY (`urun_marka`) REFERENCES `marka` (`marka_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
