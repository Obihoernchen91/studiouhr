-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 03. Nov 2015 um 11:16
-- Server-Version: 5.6.24
-- PHP-Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `studiouhr`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE IF NOT EXISTS `nutzer` (
  `nutzerID` int(11) NOT NULL,
  `login` varchar(200) CHARACTER SET utf8 NOT NULL,
  `passwort` varchar(128) NOT NULL,
  `rollenID` int(11) NOT NULL,
  `vorname` varchar(200) CHARACTER SET utf8 NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`nutzerID`, `login`, `passwort`, `rollenID`, `vorname`, `name`) VALUES
(1, 'Richard', '70515a9295032572b66a2028850a0b4ed4f55fa9bb495f31ddd18fd2bfdf31cc87aae50d090c540db2b1fcdf40dcdc06062eb40885c2489eb8bb0a983272004f', 1, 'Richard', 'Möhner'),
(3, 'Testnutzer', '6bfcc4026b5f162799a6dc8305c09db9c1674ac616bd5c7422a45fbb6d0816ac163047c47a1f426f4f4c6b5b5042c671eabc4fdc7310fd5b183eef59dc274604', 2, 'Test', 'Nutzer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer_sendung`
--

CREATE TABLE IF NOT EXISTS `nutzer_sendung` (
  `nutzerID` int(11) NOT NULL,
  `sendungID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `nutzer_sendung`
--

INSERT INTO `nutzer_sendung` (`nutzerID`, `sendungID`) VALUES
(1, 9),
(1, 10),
(1, 11),
(3, 10),
(3, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `positionen`
--

CREATE TABLE IF NOT EXISTS `positionen` (
  `sendungID` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `inhalt` varchar(200) CHARACTER SET utf8 NOT NULL,
  `typID` int(11) NOT NULL,
  `dauer` varchar(8) CHARACTER SET utf8 NOT NULL DEFAULT '00:00:00',
  `dauer_ges` varchar(8) CHARACTER SET utf8 NOT NULL DEFAULT '00:00:00',
  `echtzeit` varchar(8) CHARACTER SET utf8 NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `positionen`
--

INSERT INTO `positionen` (`sendungID`, `position`, `inhalt`, `typID`, `dauer`, `dauer_ges`, `echtzeit`) VALUES
(8, 1, 'Start', 2, '00:01:00', '00:00:00', '00:00:00'),
(8, 2, 'Mitte', 2, '00:01:30', '00:00:00', '00:00:00'),
(8, 3, 'Doppelt', 1, '00:00:00', '00:00:00', '00:00:00'),
(8, 4, 'Löwe', 2, '00:00:00', '00:00:00', '00:00:00'),
(8, 5, 'Mitte', 1, '00:00:00', '00:00:00', '00:00:00'),
(8, 6, 'Mitte', 2, '00:00:00', '00:00:00', '00:00:00'),
(8, 7, 'Mitte', 1, '00:00:00', '00:00:00', '00:00:00'),
(8, 8, 'Ende', 2, '00:00:00', '00:00:00', '00:00:00'),
(9, 1, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 2, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 3, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 4, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 5, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 6, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 7, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 8, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 9, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 10, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 11, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 12, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 13, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 14, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 15, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 16, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 17, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 18, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 19, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(9, 20, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 1, 'Einleitung', 1, '00:02:00', '00:00:00', '00:00:00'),
(10, 2, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 3, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 4, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 5, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 6, 'Mitte', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 7, 'Mitte', 1, '00:01:00', '00:00:00', '00:00:00'),
(10, 8, 'Mitte', 1, '00:01:00', '00:00:00', '00:00:00'),
(10, 9, 'Mitte', 1, '00:01:00', '00:00:00', '00:00:00'),
(10, 10, 'Mitte', 1, '00:01:00', '00:00:00', '00:00:00'),
(10, 11, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 12, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 13, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 14, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 15, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 16, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 17, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 18, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 19, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 20, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 21, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 22, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 23, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 24, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(10, 25, 'Schluss', 1, '00:05:00', '00:00:00', '00:00:00'),
(11, 1, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 2, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 3, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 4, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 5, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 6, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 7, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 8, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 9, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 10, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 11, '', 1, '00:00:00', '00:00:00', '00:00:00'),
(11, 12, '', 1, '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rollen`
--

CREATE TABLE IF NOT EXISTS `rollen` (
  `rolleID` int(11) NOT NULL,
  `rolle` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `rollen`
--

INSERT INTO `rollen` (`rolleID`, `rolle`) VALUES
(1, 'Administrator'),
(2, 'Beobachter');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sendungen`
--

CREATE TABLE IF NOT EXISTS `sendungen` (
  `sendungID` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `zeitstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `positionen` int(11) NOT NULL,
  `datum` date NOT NULL DEFAULT '2000-01-01',
  `dauer` varchar(8) CHARACTER SET utf8 NOT NULL DEFAULT '00:00:00',
  `verantwortlicher` int(11) NOT NULL COMMENT 'Nutzer ID wird genutzt',
  `salt` varchar(200) NOT NULL,
  `aktiv` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `sendungen`
--

INSERT INTO `sendungen` (`sendungID`, `name`, `zeitstempel`, `positionen`, `datum`, `dauer`, `verantwortlicher`, `salt`, `aktiv`) VALUES
(8, 'Tierdoku', '2015-10-19 13:48:36', 8, '2015-11-26', '00:30:00', 1, '', 0),
(9, 'Shaun of the Dead', '2015-10-22 07:16:27', 20, '2015-12-20', '00:45:00', 1, 'hddeeh9 nt ue7hD e aSotafuSDhf a nao', 0),
(10, 'Kriegsfilm', '2015-10-22 07:59:58', 25, '2015-11-10', '01:45:00', 1, 'lsi4g3riegelrifsmiKfmK', 0),
(11, 'Tierdoku', '2015-10-22 08:32:29', 12, '2015-11-23', '01:30:00', 1, 'rir1idkuTekdeT8uoo', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `typen`
--

CREATE TABLE IF NOT EXISTS `typen` (
  `typID` int(11) NOT NULL,
  `typ` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `typen`
--

INSERT INTO `typen` (`typID`, `typ`) VALUES
(1, 'MAZ'),
(2, 'Studio');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  ADD PRIMARY KEY (`nutzerID`), ADD KEY `rollenID` (`rollenID`);

--
-- Indizes für die Tabelle `nutzer_sendung`
--
ALTER TABLE `nutzer_sendung`
  ADD PRIMARY KEY (`sendungID`,`nutzerID`), ADD KEY `nutzerID` (`nutzerID`), ADD KEY `sendungID` (`sendungID`);

--
-- Indizes für die Tabelle `positionen`
--
ALTER TABLE `positionen`
  ADD UNIQUE KEY `sendungID_2` (`sendungID`,`position`), ADD KEY `sendungID` (`sendungID`), ADD KEY `typID` (`typID`);

--
-- Indizes für die Tabelle `rollen`
--
ALTER TABLE `rollen`
  ADD PRIMARY KEY (`rolleID`);

--
-- Indizes für die Tabelle `sendungen`
--
ALTER TABLE `sendungen`
  ADD PRIMARY KEY (`sendungID`), ADD KEY `verantwortlicher` (`verantwortlicher`);

--
-- Indizes für die Tabelle `typen`
--
ALTER TABLE `typen`
  ADD PRIMARY KEY (`typID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `nutzer`
--
ALTER TABLE `nutzer`
  MODIFY `nutzerID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `rollen`
--
ALTER TABLE `rollen`
  MODIFY `rolleID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `sendungen`
--
ALTER TABLE `sendungen`
  MODIFY `sendungID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT für Tabelle `typen`
--
ALTER TABLE `typen`
  MODIFY `typID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `nutzer`
--
ALTER TABLE `nutzer`
ADD CONSTRAINT `nutzer_ibfk_1` FOREIGN KEY (`rollenID`) REFERENCES `rollen` (`rolleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `nutzer_sendung`
--
ALTER TABLE `nutzer_sendung`
ADD CONSTRAINT `nutzer_sendung_ibfk_1` FOREIGN KEY (`nutzerID`) REFERENCES `nutzer` (`nutzerID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nutzer_sendung_ibfk_2` FOREIGN KEY (`sendungID`) REFERENCES `sendungen` (`sendungID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `positionen`
--
ALTER TABLE `positionen`
ADD CONSTRAINT `positionen_ibfk_1` FOREIGN KEY (`sendungID`) REFERENCES `sendungen` (`sendungID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `positionen_ibfk_2` FOREIGN KEY (`typID`) REFERENCES `typen` (`typID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `sendungen`
--
ALTER TABLE `sendungen`
ADD CONSTRAINT `sendungen_ibfk_1` FOREIGN KEY (`verantwortlicher`) REFERENCES `nutzer` (`nutzerID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
