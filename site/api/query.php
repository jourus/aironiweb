<?php

define("AIRO_SQL_GET_PIAZZOLE", "select COGNOME as 'Cognome', NOME as 'Nome', COMP as 'Compagnia', PIAZZUOLA as Piazzola, POS as Posizione from ISCRITTI where PIAZZUOLA between ? and ? order by PIAZZUOLA asc, POS asc");
define("AIRO_SQL_GET_CLASSI_BY_ID", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE where id = ?;");
define("AIRO_SQL_GET_CLASSI_ALL", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE;");
define("AIRO_SQL_GET_CATEGORIE_BY_ID", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA where id = ?;");
define("AIRO_SQL_GET_CATEGORIE_ALL", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA;");

