-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Nov 11. 20:29
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `raktar`
--
Drop DATABASE IF EXISTS raktar;
CREATE DATABASE raktar;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `aru`
--

CREATE TABLE `aru` (
  `ID` int(20) NOT NULL,
  `név` char(20) COLLATE utf8_hungarian_ci NOT NULL,
  `tulajdonos` char(20) COLLATE utf8_hungarian_ci NOT NULL,
  `súly` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `aru`
--

INSERT INTO `aru` (`ID`, `név`, `tulajdonos`, `súly`) VALUES
(1, 'rekettye', 'Fütty Imre', 15),
(2, 'kobalt', 'Pop Simon', 25),
(3, 'fából vaskarika', 'Para Zita', 30),
(4, 'szinesfím', 'gazsi', 100),
(5, 'T-34', 'Rabocse-kresztyjansz', 34),
(6, 'T-55', 'Vietkong', 55),
(7, 'példa', 'példa', 0),
(8, 'Panzerkampfwagen I', 'Rheinmetall', 4),
(9, 'panzerkampfwagen 2', 'Henschel', 10),
(10, 'Panzerkampfwagen III', 'Krupp', 15),
(11, 'asd', 'wasd', 2),
(12, 'Panzerkampfwagen IV', 'Friedrich Krupp AG', 22),
(13, 'Panzerkampfwagen V P', 'MAN SE', 44),
(14, 'Panzerkampfwagen VI', 'Wegmann & Co', 56),
(16, 'Panzerkampfwagen VII', 'Krupp', 63),
(17, 'Panzerkampfwagen 8', 'Ferdinand Porsche', 188),
(18, 'Panzer IX', 'Signal', 0),
(19, 'Panzer X', 'Signal', 0),
(20, 'vonatkerékpumpa', 'Nyomo Réka', 1),
(21, 'Merida dualtrust', 'Robin', 1),
(22, 'asd', 'asdasddas', 222),
(23, 'Antiochiai-kézigráná', 'Lanselot Degenere Ca', 1),
(24, 'Korona vakcina', 'Bac Ilus', 2),
(25, 'üveg', 'üveges', 10),
(26, 'répa', 'répás', 5),
(27, 'retek', 'retkes', 3),
(28, 'vonatkerékgumi', 'máv', 10),
(29, 'vonatkerékgumibelső', 'máv', 2),
(30, 'villamoskerékgumi', 'sztk', 10),
(31, 'villamoskerékgumibel', 'sztk', 3),
(200, 'föld', 'wasd', 999),
(201, 'nem ismert', 'nem ismert', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `dolgozó`
--

CREATE TABLE `dolgozó` (
  `Kártyaszám` int(20) NOT NULL,
  `név` char(30) COLLATE utf8_hungarian_ci NOT NULL,
  `beosztás` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `irányítószám` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `dolgozó`
--

INSERT INTO `dolgozó` (`Kártyaszám`, `név`, `beosztás`, `irányítószám`) VALUES
(1, 'Ferenc József', 'csicska', 1231),
(2, 'Rákosi Mátyás', 'csicska', 3200),
(3, 'Sanyi', 'targoncaszerelő', 4231),
(4, 'Vilmos', 'fűtő', 9231),
(5, 'Róland', 'villanyszerelő', 2231),
(6, 'Fütty Imre', 'műszakvezető', 1251),
(7, 'Vég Béla', 'targoncaszakértő', 1931),
(8, 'Be Tomi', 'rakodó', 1),
(9, 'Kanalas Ádám', 'biciklitolvaj', 2),
(10, 'Nyomo Réka', 'takarító', 1731),
(11, 'Szalmon Ella', 'takarító', 6731),
(12, 'Eszte Lenke', 'gondnok', 6771),
(13, 'nem ismert', 'nem ismert', 4444),
(14, 'Pop Simon', 'villamoskerékpumpáló', 9756),
(15, 'asd', 'villamoskerékpumpáló', 0),
(16, 'Dil Emma', 'rekettyés', 2323),
(17, 'Feles Elek', 'rekettyés', 7777),
(18, 'Git Áron', 'villamoskerékpumpáló', 454),
(19, 'Hü Jenő', 'rakodó', 765),
(20, 'Zsíros B. Ödön', 'rakodó', 654),
(21, 'Palprotein', 'Sith nagyúr', 2341),
(22, 'Jango Fitt', 'fejvadász', 778),
(23, 'Qui Gone Gym', 'Jedi mester', 492),
(24, 'nem ismert', 'nem ismert', 223),
(25, 'Wincs Eszter', 'rakodó', 34),
(26, 'Pofá Zoltán', 'villamoskerékpumpáló', 9753),
(27, 'Minden Áron', 'rakodó', 3443),
(28, 'Hot Elek', 'rakodó', 3443),
(29, 'Ria Dóra', 'nem ismert', 0),
(30, 'nem ismert', 'nem ismert', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mozgat`
--

CREATE TABLE `mozgat` (
  `ID` int(20) NOT NULL,
  `alvázszám` int(20) NOT NULL,
  `mikor` year(4) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `mozgat`
--

INSERT INTO `mozgat` (`ID`, `alvázszám`, `mikor`) VALUES
(4, 4, 1910),
(20, 312121, 1939),
(10, 12, 1956),
(11, 12, 1957),
(16, 21, 1958),
(6, 7, 1969),
(3, 10, 1980),
(8, 7, 1994),
(4, 4, 1999),
(4, 4, 2011),
(2, 6, 2020);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `targonca`
--

CREATE TABLE `targonca` (
  `alvázszám` int(20) NOT NULL,
  `üzemanyag` char(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `targonca`
--

INSERT INTO `targonca` (`alvázszám`, `üzemanyag`) VALUES
(1, 'asddsa'),
(2, 'h2o'),
(3, 'nem ismert'),
(4, 'benzin'),
(5, 'gázolaj'),
(6, 'hidrogén'),
(7, 'dízel'),
(8, 'dízel'),
(9, 'kerozin'),
(10, 'példa'),
(11, 'benzin'),
(12, 'hibrid'),
(14, 'gázüzemű'),
(15, 'nem ismert'),
(16, 'nem ismert'),
(17, 'benzin'),
(18, 'dízel'),
(19, 'nem ismert'),
(20, 'benzin'),
(21, 'benzin'),
(22, 'atomenergia'),
(23, 'benzin'),
(24, 'benzin'),
(25, 'benzin'),
(26, 'benzin'),
(27, 'benzin'),
(28, 'benzin'),
(29, 'benzin'),
(30, 'benzin'),
(31, 'benzin'),
(32, 'benzin'),
(99898, 'benzin'),
(312121, 'benzin'),
(312321, 'vízgőz'),
(412121, 'elektromos'),
(512121, 'kerozin'),
(666161, 'biodízel'),
(712121, 'hidrogén'),
(812121, 'gázolaj'),
(912121, 'gázüzemű'),
(972121, 'benzin'),
(982121, 'vízgőz'),
(989111, 'patás jószággal-vont'),
(989121, 'dízel'),
(989161, 'napenergia');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vezet`
--

CREATE TABLE `vezet` (
  `alvázszám` int(20) NOT NULL,
  `Kártyaszám` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `vezet`
--

INSERT INTO `vezet` (`alvázszám`, `Kártyaszám`) VALUES
(1, 2),
(2, 1),
(3, 10),
(4, 12),
(5, 20),
(6, 4),
(7, 5),
(8, 13),
(14, 14),
(15, 4),
(22, 16),
(312121, 2),
(312321, 10),
(412121, 15),
(512121, 12),
(666161, 22),
(712121, 8),
(812121, 5),
(812121, 13),
(912121, 14);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `aru`
--
ALTER TABLE `aru`
  ADD PRIMARY KEY (`ID`);

--
-- A tábla indexei `dolgozó`
--
ALTER TABLE `dolgozó`
  ADD PRIMARY KEY (`Kártyaszám`);

--
-- A tábla indexei `mozgat`
--
ALTER TABLE `mozgat`
  ADD PRIMARY KEY (`mikor`),
  ADD KEY `ID` (`ID`);

--
-- A tábla indexei `targonca`
--
ALTER TABLE `targonca`
  ADD PRIMARY KEY (`alvázszám`);

--
-- A tábla indexei `vezet`
--
ALTER TABLE `vezet`
  ADD KEY `alvázszám` (`alvázszám`),
  ADD KEY `kártyaszám` (`Kártyaszám`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `mozgat`
--
ALTER TABLE `mozgat`
  ADD CONSTRAINT `mozgat_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `aru` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `vezet`
--
ALTER TABLE `vezet`
  ADD CONSTRAINT `vezet_ibfk_1` FOREIGN KEY (`alvázszám`) REFERENCES `targonca` (`alvázszám`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vezet_ibfk_2` FOREIGN KEY (`Kártyaszám`) REFERENCES `dolgozó` (`Kártyaszám`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
