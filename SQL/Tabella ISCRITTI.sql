use airophp;

CREATE TABLE `iscritti` (
  `TESSERA` int(11) NOT NULL,
  `ISCRITTI` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `CLASSE` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `CATEGORIA` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `CAPOSQUADRA` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `CON` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `COMP` varchar(6) COLLATE latin1_general_ci DEFAULT NULL,
  `PIAZZUOLA` int(11) DEFAULT NULL,
  `PUNTI` int(11) DEFAULT NULL,
  `SPOT` int(11) DEFAULT NULL,
  `SUPERSPOT` int(11) DEFAULT NULL,
  `PRESENTE` bit(1) DEFAULT NULL,
  `spunta` bit(1) DEFAULT NULL,
  `n°` int(11) DEFAULT NULL,
  `Cognome` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Nome` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `POS` int(11) DEFAULT NULL,
  `PAGATO` bit(1) DEFAULT NULL,
  `PAGATO1` bit(1) DEFAULT NULL,
  UNIQUE KEY `idx_iscritti_TESSERA` (`TESSERA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

