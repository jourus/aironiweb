<?php

define("AIRO_SQL_GET_PIAZZOLE", "select COGNOME as 'Cognome', NOME as 'Nome', COMP as 'Compagnia', PIAZZUOLA as Piazzola, POS as Posizione from ISCRITTI where PIAZZUOLA between ? and ? order by PIAZZUOLA asc, POS asc");
define("AIRO_SQL_GET_CLASSI_BY_ID", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE where id = ?;");
define("AIRO_SQL_GET_CLASSI_ALL", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE;");
define("AIRO_SQL_GET_CATEGORIE_BY_ID", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA where id = ?;");
define("AIRO_SQL_GET_CATEGORIE_ALL", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA;");
// define("AIRO_SQL_GET_PODIO", "select concat(Nome, ' ', Cognome) arciere, PUNTI as punti, SPOT as spot, SUPERSPOT as superspot from iscritti  where CLASSE = ? and CATEGORIA = ?  order by PUNTI desc, SPOT desc, SUPERSPOT desc limit 3;");
define("AIRO_SQL_GET_PODIO", "select concat(Nome, ' ', Cognome) arciere, PUNTI as punti, SPOT + SUPERSPOT as spot, SUPERSPOT as superspot, b.NomeFile as foto from iscritti a left join IMMAGINI b on b.ID = a.TESSERA where CLASSE = ? and CATEGORIA = ?  ORDER BY PUNTI DESC, SPOT + SUPERSPOT DESC, SUPERSPOT DESC limit 3;");
define("AIRO_SQL_GET_INFORMAZIONI", "SELECT tipo, localita, provincia, compagnia, data, piazzole FROM INFORMAZIONI LIMIT 1;");
define("AIRO_SQL_GET_CLASSIFICA", "SELECT concat(NOME, ' ', COGNOME) AS arciere, PUNTI as punti, SPOT + SUPERSPOT as spot, SUPERSPOT as superspot  FROM ISCRITTI WHERE CLASSE= ? AND CATEGORIA = ? AND PUNTI IS NOT NULL ORDER BY PUNTI DESC, SPOT + SUPERSPOT DESC, SUPERSPOT DESC");
define("AIRO_SQL_GET_SCORE_CONSEGNATI", "SELECT count(PUNTI) as numcons FROM ISCRITTI WHERE Piazzuola=?");
// define("AIRO_SQL_GET_CLASSIFICA_COMPAGNIA", "SELECT concat(NOME, ' ', COGNOME) AS arciere, PUNTI as punti, SPOT + SUPERSPOT as spot, SUPERSPOT as superspot, b.descrizione as classe, c.descrizione as categoria  FROM ISCRITTI a inner join CLASSE b on a.CLASSE = b.id inner join CATEGORIA c on a.CATEGORIA = c.id WHERE COMP = ? AND PUNTI IS NOT NULL ORDER BY COGNOME,CLASSE,categoria,PUNTI DESC");

define("AIRO_SQL_GET_CLASSIFICA_COMPAGNIA", "SELECT concat(NOME, ' ', COGNOME) AS arciere, PUNTI as punti, SPOT + SUPERSPOT as spot, SUPERSPOT as superspot, b.descrizione as classe, c.descrizione as categoria  FROM ISCRITTI a inner join CLASSE b on a.CLASSE = b.id inner join CATEGORIA c on a.CATEGORIA = c.id WHERE COMP = ? AND PUNTI IS NOT NULL ORDER BY b.descrizione, c.descrizione, PUNTI DESC, SPOT + SUPERSPOT DESC, SUPERSPOT DESC");

define("AIRO_SQL_GET_LAYOUT_FOTO", "select configurazione from LAYOUT_AUTOFOTO where `attivo` != 0");
