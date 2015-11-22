<?php
define("AIRO_SQL_GET_PIAZZOLE", "select COGNOME as 'Cognome', NOME as 'Nome', COMP as 'Compagnia', PIAZZUOLA as Piazzola, POS as Posizione from ISCRITTI where PIAZZUOLA between ? and ? order by PIAZZUOLA asc, POS asc");
