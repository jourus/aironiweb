<?php

define("AIRO_SQL_GET_PIAZZOLE", "select COGNOME as 'Cognome', NOME as 'Nome', COMP as 'Compagnia', PIAZZUOLA as Piazzola, POS as Posizione from ISCRITTI where PIAZZUOLA between ? and ? order by PIAZZUOLA asc, POS asc");
define("AIRO_SQL_GET_CLASSI_BY_ID", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE where id = ?;");
define("AIRO_SQL_GET_CLASSI_ALL", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE;");
define("AIRO_SQL_GET_CATEGORIE_BY_ID", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA where id = ?;");
define("AIRO_SQL_GET_CATEGORIE_ALL", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA;");
// define("AIRO_SQL_GET_PODIO", "select concat(Nome, ' ', Cognome) arciere, PUNTI as punti, SPOT as spot, SUPERSPOT as superspot from iscritti  where CLASSE = ? and CATEGORIA = ?  order by PUNTI desc, SPOT desc, SUPERSPOT desc limit 3;");
define("AIRO_SQL_GET_PODIO", "select concat(Nome, ' ', Cognome) arciere, PUNTI as punti, SPOT as spot, SUPERSPOT as superspot, b.NomeFile as foto from iscritti a left join IMMAGINI b on b.ID = a.TESSERA where CLASSE = ? and CATEGORIA = ?  order by PUNTI desc, SPOT desc, SUPERSPOT desc limit 3;");