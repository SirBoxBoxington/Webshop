-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Jun 2018 um 14:08
-- Server-Version: 10.1.28-MariaDB
-- PHP-Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `shop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `ProduktID` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(35) NOT NULL,
  `Description` varchar(150) NOT NULL,
  `Kategory` varchar(20) NOT NULL,
  `Preis` decimal(10,0) NOT NULL,
  `Image-Link` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte_rechnungen`
--

CREATE TABLE `produkte_rechnungen` (
  `fk_produktID` bigint(20) UNSIGNED NOT NULL,
  `fk_rechnungID` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnungen`
--

CREATE TABLE `rechnungen` (
  `RechnungsID` bigint(20) UNSIGNED NOT NULL,
  `KaeuferUsername` varchar(30) NOT NULL,
  `Preis` decimal(10,0) NOT NULL,
  `Ware` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `Username` varchar(30) NOT NULL,
  `PW` varchar(100) NOT NULL,
  `Anrede` varchar(30) DEFAULT NULL,
  `Vorname` varchar(30) NOT NULL,
  `Nachname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `PLZ` int(10) NOT NULL,
  `Ort` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Adresse` varchar(30) NOT NULL,
  `IsAdmin` tinyint(1) DEFAULT '0',
  `IsLdap` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`ProduktID`),
  ADD UNIQUE KEY `ProduktID` (`ProduktID`);

--
-- Indizes für die Tabelle `produkte_rechnungen`
--
ALTER TABLE `produkte_rechnungen`
  ADD KEY `fk_produktID` (`fk_produktID`),
  ADD KEY `fk_rechnungID` (`fk_rechnungID`);

--
-- Indizes für die Tabelle `rechnungen`
--
ALTER TABLE `rechnungen`
  ADD PRIMARY KEY (`RechnungsID`),
  ADD UNIQUE KEY `RechnungsID` (`RechnungsID`),
  ADD KEY `KaeuferUsername` (`KaeuferUsername`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `ProduktID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `rechnungen`
--
ALTER TABLE `rechnungen`
  MODIFY `RechnungsID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `produkte_rechnungen`
--
ALTER TABLE `produkte_rechnungen`
  ADD CONSTRAINT `produkte_rechnungen_ibfk_1` FOREIGN KEY (`fk_produktID`) REFERENCES `produkte` (`ProduktID`),
  ADD CONSTRAINT `produkte_rechnungen_ibfk_2` FOREIGN KEY (`fk_rechnungID`) REFERENCES `rechnungen` (`RechnungsID`);

--
-- Constraints der Tabelle `rechnungen`
--
ALTER TABLE `rechnungen`
  ADD CONSTRAINT `rechnungen_ibfk_1` FOREIGN KEY (`KaeuferUsername`) REFERENCES `user` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
