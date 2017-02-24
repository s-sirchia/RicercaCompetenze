-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Lug 03, 2015 alle 11:00
-- Versione del server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `team7_gps_2015`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cluster`
--

CREATE TABLE IF NOT EXISTS `cluster` (
`idcluster` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dump dei dati per la tabella `cluster`
--

INSERT INTO `cluster` (`idcluster`, `nome`) VALUES
(1, 'Android'),
(2, 'Server'),
(3, 'Sito'),
(4, 'Gestione_Dati'),
(5, 'General_Purpose '),
(6, 'Parallelo '),
(7, 'Interfaccia_Grafica '),
(8, 'Object_Oriented '),
(10, 'Concorrente'),
(11, 'Scraping'),
(12, 'Script'),
(13, 'Scientifico'),
(14, 'Multimediale'),
(15, 'Embedded'),
(16, 'Gestione_Dati'),
(17, 'Data_Mining'),
(18, 'Linguistica_Computazionale'),
(19, 'Intelligenza_Artificiale'),
(20, 'Web-service'),
(21, 'Rappresentazione_Conoscenza'),
(22, 'Computazione_Numerica'),
(23, 'Real-Time_Computing'),
(24, 'Client-server'),
(25, 'Stesura_Testi');

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_anagrafici`
--

CREATE TABLE IF NOT EXISTS `dati_anagrafici` (
`idDati_Anagrafici` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `citta` varchar(45) DEFAULT NULL,
  `via` varchar(45) DEFAULT NULL,
  `cap` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dump dei dati per la tabella `dati_anagrafici`
--

INSERT INTO `dati_anagrafici` (`idDati_Anagrafici`, `nome`, `cognome`, `data_nascita`, `citta`, `via`, `cap`, `telefono`, `email`) VALUES
(0, 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, 'admin'),
(25, 'renzino', 'renzino', '2015-07-12', 'napoli', 'napoletano', '2939', '8382938', 'renzino'),
(26, 'aaa', 'aa', '2015-07-10', 'aa', 'aa', '222', '33', 'ww'),
(27, 'vin', 'ven', '1987-04-23', 'salerno', 'fasullo', '32389', '89892384092', 'vincenzo@fmie.it'),
(28, 'gigi', 'gino', '2002-02-13', 'salerno', 'sifke', '92939', '4982948', 'vc.@ea.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `linguaggio`
--

CREATE TABLE IF NOT EXISTS `linguaggio` (
`idLinguaggio` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dump dei dati per la tabella `linguaggio`
--

INSERT INTO `linguaggio` (`idLinguaggio`, `nome`) VALUES
(16, 'c++'),
(14, 'CSS'),
(12, 'HTML'),
(11, 'Java'),
(15, 'JavaScript'),
(13, 'XML');

-- --------------------------------------------------------

--
-- Struttura della tabella `login`
--

CREATE TABLE IF NOT EXISTS `login` (
`idLogin` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dump dei dati per la tabella `login`
--

INSERT INTO `login` (`idLogin`, `username`, `password`) VALUES
(0, 'admin', 'admin'),
(20, 'renzi', 'pass'),
(21, 'ross', 'ross'),
(22, 'vincenzo', 'venosi'),
(23, 'luigi', 'luigi');

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto`
--

CREATE TABLE IF NOT EXISTS `progetto` (
`idProgetto` int(11) NOT NULL,
  `projectManager` int(11) NOT NULL,
  `stato` int(11) NOT NULL,
  `nome` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `descrizione` varchar(450) CHARACTER SET utf8 DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `num_membri` int(11) DEFAULT NULL,
  `costo` float DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dump dei dati per la tabella `progetto`
--

INSERT INTO `progetto` (`idProgetto`, `projectManager`, `stato`, `nome`, `descrizione`, `data_inizio`, `data_fine`, `num_membri`, `costo`) VALUES
(51, 3, 1, 'Progetto Android', 'Si vuole creare un  applicazione mobile che giri su smartphone android che gestisca l archivio interno del dispositivo ', '2015-07-26', '2016-01-08', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto_has_cluster`
--

CREATE TABLE IF NOT EXISTS `progetto_has_cluster` (
  `progetto_idProgetto` int(11) NOT NULL,
  `cluster_idcluster` int(11) NOT NULL,
  `valore` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `progetto_has_cluster`
--

INSERT INTO `progetto_has_cluster` (`progetto_idProgetto`, `cluster_idcluster`, `valore`) VALUES
(51, 1, 5),
(51, 2, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `progetto_has_tag`
--

CREATE TABLE IF NOT EXISTS `progetto_has_tag` (
`id_progetto_has_tag` mediumint(9) NOT NULL,
  `id_progetto` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Dump dei dati per la tabella `progetto_has_tag`
--

INSERT INTO `progetto_has_tag` (`id_progetto_has_tag`, `id_progetto`, `id_tag`) VALUES
(111, 51, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `programmatore`
--

CREATE TABLE IF NOT EXISTS `programmatore` (
`idProgrammatore` int(11) NOT NULL,
  `datiAnagrafici` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `costo_ora` float DEFAULT '0',
  `esperienza` float DEFAULT '0',
  `linkedin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dump dei dati per la tabella `programmatore`
--

INSERT INTO `programmatore` (`idProgrammatore`, `datiAnagrafici`, `login`, `costo_ora`, `esperienza`, `linkedin`) VALUES
(64, 27, 22, 2, 0, 'https://it.linkedin.com/pub/vincenzo-venosi/83/962/59b'),
(65, 28, 23, 2, 0, 'https://it.linkedin.com/pub/luigi-lomasto/83/6b2/731');

-- --------------------------------------------------------

--
-- Struttura della tabella `programmatore_as_invito`
--

CREATE TABLE IF NOT EXISTS `programmatore_as_invito` (
  `idProgrammatore` int(11) NOT NULL DEFAULT '0',
  `idProgetto` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `programmatore_has_cluster`
--

CREATE TABLE IF NOT EXISTS `programmatore_has_cluster` (
  `programmatore_idProgrammatore` int(11) NOT NULL,
  `cluster_idcluster` int(11) NOT NULL,
  `valore` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `programmatore_has_cluster`
--

INSERT INTO `programmatore_has_cluster` (`programmatore_idProgrammatore`, `cluster_idcluster`, `valore`) VALUES
(64, 1, 2),
(64, 3, 3),
(64, 4, 1),
(64, 5, 3),
(64, 6, 2),
(64, 7, 2),
(64, 8, 2),
(64, 10, 1),
(65, 1, 2),
(65, 3, 3),
(65, 4, 1),
(65, 5, 3),
(65, 6, 2),
(65, 7, 2),
(65, 8, 2),
(65, 10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `programmatore_has_linguaggio`
--

CREATE TABLE IF NOT EXISTS `programmatore_has_linguaggio` (
  `Linguaggio_idLinguaggio` int(11) NOT NULL,
  `Programmatore_idProgrammatore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `programmatore_has_linguaggio`
--

INSERT INTO `programmatore_has_linguaggio` (`Linguaggio_idLinguaggio`, `Programmatore_idProgrammatore`) VALUES
(11, 64),
(15, 64),
(13, 64),
(12, 64),
(14, 64),
(16, 64),
(15, 65),
(13, 65),
(14, 65),
(11, 65),
(16, 65),
(12, 65);

-- --------------------------------------------------------

--
-- Struttura della tabella `programmatore_iscritto_progetto`
--

CREATE TABLE IF NOT EXISTS `programmatore_iscritto_progetto` (
  `Programmatore_idProgrammatore` int(11) NOT NULL,
  `Progetto_idProgetto` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `onWorking` tinyint(1) NOT NULL DEFAULT '0',
  `recv_feedback` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `programmatore_iscritto_progetto`
--

INSERT INTO `programmatore_iscritto_progetto` (`Programmatore_idProgrammatore`, `Progetto_idProgetto`, `data`, `onWorking`, `recv_feedback`) VALUES
(64, 51, '2015-07-02', 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `project_manager`
--

CREATE TABLE IF NOT EXISTS `project_manager` (
`idProject_Manager` int(11) NOT NULL,
  `datiAnagrafici` int(11) NOT NULL,
  `login` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `project_manager`
--

INSERT INTO `project_manager` (`idProject_Manager`, `datiAnagrafici`, `login`) VALUES
(0, 0, 0),
(3, 25, 20);

-- --------------------------------------------------------

--
-- Struttura della tabella `stato_progetto`
--

CREATE TABLE IF NOT EXISTS `stato_progetto` (
`idstato_progetto` int(11) NOT NULL,
  `stato` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dump dei dati per la tabella `stato_progetto`
--

INSERT INTO `stato_progetto` (`idstato_progetto`, `stato`) VALUES
(1, 'registrazioni_open'),
(2, 'registrazioni_closed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cluster`
--
ALTER TABLE `cluster`
 ADD PRIMARY KEY (`idcluster`);

--
-- Indexes for table `dati_anagrafici`
--
ALTER TABLE `dati_anagrafici`
 ADD PRIMARY KEY (`idDati_Anagrafici`);

--
-- Indexes for table `linguaggio`
--
ALTER TABLE `linguaggio`
 ADD PRIMARY KEY (`idLinguaggio`), ADD UNIQUE KEY `nome_UNIQUE` (`nome`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`idLogin`), ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `progetto`
--
ALTER TABLE `progetto`
 ADD PRIMARY KEY (`idProgetto`), ADD KEY `fk_Progetto_Project_Manager1_idx` (`projectManager`);

--
-- Indexes for table `progetto_has_cluster`
--
ALTER TABLE `progetto_has_cluster`
 ADD PRIMARY KEY (`progetto_idProgetto`,`cluster_idcluster`), ADD KEY `fk_progetto_has_cluster_progetto1_idx` (`progetto_idProgetto`);

--
-- Indexes for table `progetto_has_tag`
--
ALTER TABLE `progetto_has_tag`
 ADD PRIMARY KEY (`id_progetto_has_tag`), ADD KEY `id_progetto` (`id_progetto`), ADD KEY `id_tag` (`id_tag`);

--
-- Indexes for table `programmatore`
--
ALTER TABLE `programmatore`
 ADD PRIMARY KEY (`idProgrammatore`,`datiAnagrafici`,`login`), ADD KEY `fk_Programmatore_Dati_Anagrafici1_idx` (`datiAnagrafici`), ADD KEY `fk_Programmatore_Login1_idx` (`login`);

--
-- Indexes for table `programmatore_as_invito`
--
ALTER TABLE `programmatore_as_invito`
 ADD PRIMARY KEY (`idProgrammatore`,`idProgetto`), ADD KEY `idProgetto` (`idProgetto`);

--
-- Indexes for table `programmatore_has_cluster`
--
ALTER TABLE `programmatore_has_cluster`
 ADD PRIMARY KEY (`programmatore_idProgrammatore`,`cluster_idcluster`), ADD KEY `fk_programmatore_has_cluster_programmatore1_idx` (`programmatore_idProgrammatore`);

--
-- Indexes for table `programmatore_has_linguaggio`
--
ALTER TABLE `programmatore_has_linguaggio`
 ADD KEY `fk_Linguaggio_has_Programmatore_Programmatore1_idx` (`Programmatore_idProgrammatore`), ADD KEY `fk_Linguaggio_has_Programmatore_Linguaggio_idx` (`Linguaggio_idLinguaggio`);

--
-- Indexes for table `programmatore_iscritto_progetto`
--
ALTER TABLE `programmatore_iscritto_progetto`
 ADD KEY `fk_Programmatore_has_Progetto_Progetto1_idx` (`Progetto_idProgetto`), ADD KEY `fk_Programmatore_has_Progetto_Programmatore1_idx` (`Programmatore_idProgrammatore`);

--
-- Indexes for table `project_manager`
--
ALTER TABLE `project_manager`
 ADD PRIMARY KEY (`idProject_Manager`,`datiAnagrafici`,`login`), ADD KEY `fk_Project_Manager_Dati_Anagrafici1_idx` (`datiAnagrafici`), ADD KEY `fk_Project_Manager_Login1_idx` (`login`);

--
-- Indexes for table `stato_progetto`
--
ALTER TABLE `stato_progetto`
 ADD PRIMARY KEY (`idstato_progetto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cluster`
--
ALTER TABLE `cluster`
MODIFY `idcluster` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `dati_anagrafici`
--
ALTER TABLE `dati_anagrafici`
MODIFY `idDati_Anagrafici` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `linguaggio`
--
ALTER TABLE `linguaggio`
MODIFY `idLinguaggio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `progetto`
--
ALTER TABLE `progetto`
MODIFY `idProgetto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `progetto_has_tag`
--
ALTER TABLE `progetto_has_tag`
MODIFY `id_progetto_has_tag` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `programmatore`
--
ALTER TABLE `programmatore`
MODIFY `idProgrammatore` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `project_manager`
--
ALTER TABLE `project_manager`
MODIFY `idProject_Manager` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stato_progetto`
--
ALTER TABLE `stato_progetto`
MODIFY `idstato_progetto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `progetto`
--
ALTER TABLE `progetto`
ADD CONSTRAINT `fk_Progetto_Project_Manager1` FOREIGN KEY (`projectManager`) REFERENCES `project_manager` (`idProject_Manager`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `progetto_has_cluster`
--
ALTER TABLE `progetto_has_cluster`
ADD CONSTRAINT `fk_progetto_has_cluster_progetto1` FOREIGN KEY (`progetto_idProgetto`) REFERENCES `progetto` (`idProgetto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `progetto_has_tag`
--
ALTER TABLE `progetto_has_tag`
ADD CONSTRAINT `progetto_has_tag_ibfk_1` FOREIGN KEY (`id_progetto`) REFERENCES `progetto` (`idProgetto`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `progetto_has_tag_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `cluster` (`idcluster`);

--
-- Limiti per la tabella `programmatore`
--
ALTER TABLE `programmatore`
ADD CONSTRAINT `fk_Programmatore_Dati_Anagrafici1` FOREIGN KEY (`datiAnagrafici`) REFERENCES `dati_anagrafici` (`idDati_Anagrafici`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Programmatore_Login1` FOREIGN KEY (`login`) REFERENCES `login` (`idLogin`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `programmatore_as_invito`
--
ALTER TABLE `programmatore_as_invito`
ADD CONSTRAINT `programmatore_as_invito_ibfk_1` FOREIGN KEY (`idProgrammatore`) REFERENCES `programmatore` (`idProgrammatore`),
ADD CONSTRAINT `programmatore_as_invito_ibfk_2` FOREIGN KEY (`idProgetto`) REFERENCES `progetto` (`idProgetto`);

--
-- Limiti per la tabella `programmatore_has_cluster`
--
ALTER TABLE `programmatore_has_cluster`
ADD CONSTRAINT `fk_programmatore_has_cluster_programmatore1` FOREIGN KEY (`programmatore_idProgrammatore`) REFERENCES `programmatore` (`idProgrammatore`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `programmatore_has_linguaggio`
--
ALTER TABLE `programmatore_has_linguaggio`
ADD CONSTRAINT `fk_Linguaggio_has_Programmatore_Linguaggio` FOREIGN KEY (`Linguaggio_idLinguaggio`) REFERENCES `linguaggio` (`idLinguaggio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Linguaggio_has_Programmatore_Programmatore1` FOREIGN KEY (`Programmatore_idProgrammatore`) REFERENCES `programmatore` (`idProgrammatore`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `programmatore_iscritto_progetto`
--
ALTER TABLE `programmatore_iscritto_progetto`
ADD CONSTRAINT `fk_Programmatore_has_Progetto_Progetto1` FOREIGN KEY (`Progetto_idProgetto`) REFERENCES `progetto` (`idProgetto`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_Programmatore_has_Progetto_Programmatore1` FOREIGN KEY (`Programmatore_idProgrammatore`) REFERENCES `programmatore` (`idProgrammatore`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
