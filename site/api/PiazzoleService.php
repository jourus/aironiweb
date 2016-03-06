<?php
include 'query.php';
include_once 'config.php';

// recupero dei parametri
// min --> La prima piazzola da estrarre
// max --> L'ultima piazzola da estrarre

function getPiazzole($piazzolaDa, $piazzolaA) {
	return getGenericData(AIRO_SQL_GET_PIAZZOLE, "ii", array($piazzolaDa, $piazzolaA));
}

function getArcieriDaAbbinare() {
	return getGenericData(AIRO_SQL_GET_ARCIERI_DA_ABBINARE);
}
function getArcieriAbbinati($tessera) {
	if (is_null ( $tessera )) {
		return getGenericData(AIRO_SQL_GET_ARCIERI_ABBINATI );
	} else {
		return getGenericData(AIRO_SQL_GET_ARCIERI_ABBINATI_BY_ID,"s",array($tessera) );
	}
}

function getClassificaCompagnia($compagnia) {
	return getGenericData(AIRO_SQL_GET_CLASSIFICA_COMPAGNIA, "s", array($compagnia));

}

function getClassiCategorie() {
	return getGenericData(AIRO_SQL_GET_CLASSI_CATEGORIE, "", null);
}

function getCompagnie() {
	return getGenericData(AIRO_SQL_GET_COMPAGNIE, "", null);
}

function getCategorie($idCategoria) {
	if (is_null ( $idCategoria )) {
		return getGenericData(AIRO_SQL_GET_CATEGORIE_ALL );
	} else {
		return getGenericData(AIRO_SQL_GET_CATEGORIE_BY_ID,"s",array($idCategoria) );
	}
	
}

function getClassi($idClasse) {
	if (is_null ( $idClasse )) {
		return getGenericData(AIRO_SQL_GET_CLASSI_ALL );
	} else {
		return getGenericData(AIRO_SQL_GET_CLASSI_BY_ID,"s",array($idClasse) );
	}

}
	
function getPodio($idClasse, $idCategoria) {
	return getGenericData(AIRO_SQL_GET_PODIO, "ss", array($idClasse, $idCategoria));

}

function getClassifica($idClasse, $idCategoria) {
	return getGenericData(AIRO_SQL_GET_CLASSIFICA, "ss", array($idClasse, $idCategoria));

}

function getInformazioniGara() {
	return getGenericData(AIRO_SQL_GET_INFORMAZIONI, "", array(null), true);
	
}

function getScoreConsegnato($piazzola) {
	return getGenericData(AIRO_SQL_GET_SCORE_CONSEGNATI, "i", array($piazzola), true);
}


// Restituisce l'arrey con le estensioni accettate per le immagini
function getAllowedExt() {
	
	return explode(",", AIRO_PICTURE_ALLOWED_EXT);
	
}

// Restituisce tutte le foto di gara non necessariamente legate ad un arciere
// presenti nella loro specifica cartella
function getElencoFotoLibere() {
	
	$files_array = scanDirectories ( AIRO_FOLDER_AUTOFOTO, getAllowedExt());
	shuffle ( $files_array );
	return $files_array;
}


// Restituisce tutte le foto da associare agli arcieri in gara.	
function getElencoFotoDaAssociare($hideFolder=true) {
	if ($hideFolder == null) {
		$hideFolder=false;
	}
	
	return scanDirectories ( AIRO_FOLDER_FOTO_DA_ASSOCIARE, getAllowedExt(), $hideFolder);
	
}

// Restituisce tutte le foto aventi un determinato set di estensioni all'interno di una cartella.
// Attenzione! Non supporta regular expression
// $rootDir -> Il percorso da analizzare
// $allowext -> Array di estensioni
// $allData -> Array di file restituiti
function scanDirectories($rootDir, $allowext, $hideFolder) {
	$dirContent = scandir ( $rootDir );
//	$allData = array();
	
	foreach ( $dirContent as $key => $content ) {
		$path = $rootDir . $content;
		$ext = strtolower ( substr ( $content, strrpos ( $content, '.' ) + 1 ) );

		if (in_array ( $ext, $allowext )) {
			if (is_file ( $path ) && is_readable ( $path )) {
				// $allData[] = $content;
				if ($hideFolder) {$folder = "";} else {$folder = $rootDir;}
				$allData [] = $folder . $content;
			} elseif (is_dir ( $path ) && is_readable ( $path )) {
				// recursive callback to open new directory
				$allData = scanDirectories ( $path, $allData );
			}
		}
	}
	return $allData;
}





function getLayoutFoto() {
	$myfile = fopen ( "json/layout_autofoto.json", "r" ) or die ( "Unable to open file!" );
	$rows = json_decode ( fread ( $myfile, filesize ( "json/layout_autofoto.json" ) ) );
	fclose ( $myfile );
	
	return $rows;
	
}

function getGenericData($sqlString, $tipi="", $parametri=[], $singleLine = false) {
	
	// Create connection
	$conn = new mysqli ( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME );
	// Check connection
	if ($conn->connect_error) {
		error_log("connessione al database fallita: ".$conn->connect_error);
		die ( "Connection failed: " . $conn->connect_error );
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset ( "utf8" );

	
	// preparazione dello statement SQL
	
		$stmt = $conn->prepare ( $sqlString );
		
		// è necessario usare la reflection per poter gestire un numero dinamico di parametri
		$ref    = new ReflectionClass('mysqli_stmt');
		
			
		$args = [];
		$args []= &$tipi;
	for($copy=0; $copy < count($parametri); $copy++){
		$args [] =  &$parametri[$copy];	
	}
	
	if (strlen($tipi) > 0) {

		// parametri e relativi tipi vengono messi nel medesimo array
		array_unshift($parametri, $tipi);
		
		$method = $ref->getMethod("bind_param");
		$method->invokeArgs($stmt,$args);
		
		if (DEBUG) {
			error_log("getGenericData - Parametri: " . implode("; ", $parametri));
		}

	}
	
	$stmt->execute();
	
//	$stmt->execute ();
	
	$result = $stmt->get_result ();
	
	

	
	if ($singleLine) {
		
		if ($row = $result->fetch_assoc ()) {
			if (DEBUG) {
				error_log("getGenericData - La riga è: " . join("-", $row));
				error_log("getGenericData - La riga min: " . min($row) . " e max: "  . max($row));
					
			}
			return $row;
		} else
			if (DEBUG) {error_log("getGenericData - Nessun dato trovato.");}
			return null;
	} else {
		
		// serializzazione dei dati in un array
		$rows = array ();
		while ( $row = $result->fetch_assoc () ) {
			$rows [] = $row;
		}
		$conn->close ();
		
		// invio output a client
		return $rows;
	}
}


function executeSqlCommand($sqlString, $tipi="", $parametri=[]) {

	// Create connection
	$conn = new mysqli ( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME );
	// Check connection
	if ($conn->connect_error) {
		error_log("executeSqlCommand - connessione al database fallita: ".$conn->connect_error);
		die ( "Connection failed: " . $conn->connect_error );
	}
	
	if (DEBUG) {
		error_log("executeSqlCommand - \$sqlString --> $sqlString");
		error_log("executeSqlCommand - \$tipi --> $tipi");
		error_log("executeSqlCommand - \$parametri --> '" . implode("';'", $parametri) . "'");
	
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset ( "utf8" );


	// preparazione dello statement SQL

	$stmt = $conn->prepare ( $sqlString );

	// è necessario usare la reflection per poter gestire un numero dinamico di parametri
	$ref    = new ReflectionClass('mysqli_stmt');


	$args = [];
	$args []= &$tipi;
	for($copy=0; $copy < count($parametri); $copy++){
		$args [] =  &$parametri[$copy];
		if (DEBUG) {
			error_log("executeSqlCommand - parametri da accodare: " &$parametri[$copy]);
				
		}
	}

	if (strlen($tipi) > 0) {

		// parametri e relativi tipi vengono messi nel medesimo array
		array_unshift($parametri, $tipi);

		$method = $ref->getMethod("bind_param");
		$method->invokeArgs($stmt,$args);

		if (DEBUG) {
			error_log(implode(";", $parametri));
		}
		;
	}

	$esito = $stmt->execute();
	
	$stmt->close();
	
	
	return $esito;
	
	
}


function setAbbinamentoArciereFoto($tessera, $file, $origine) {
	return executeSqlCommand(AIRO_SQL_INSERT_ABBINAMENTO_FOTO, "iss", array($tessera, $file, $origine));
	
}
function removeAbbinamentoArciereFoto($tessera) {
	return executeSqlCommand(AIRO_SQL_DELETE_ABBINAMENTO_FOTO, "i", array($tessera));

}
function getCompagniaArciere($tessera) {
	return getGenericData(AIRO_SQL_GET_COMPAGNIA_ARCIERE, "i", array($tessera), true);

}


function getAbbinamentoFoto($tessera) {
	return getGenericData(AIRO_SQL_GET_ABBINAMENTO_FOTO, "i", array($tessera), true);

}


function disabbinaArciereFoto($nTessera) {
	if (DEBUG) {
		error_log("disabbinaArciereFoto - \$nTessera --> $nTessera");
	}
	
	$Abbinamento = getAbbinamentoFoto($nTessera);
	
	error_log("Abbinamento: Foto -> " . $Abbinamento['NomeFile'] . ", file originale " . $Abbinamento['Originale'] . ".");
	
	$muoviA = AIRO_FS_FOLDER_FOTO_DA_ASSOCIARE . $Abbinamento['Originale'];
	$muoviDa = AIRO_FS_FOLDER_FOTO_PODIO . $Abbinamento['NomeFile'];
	
	if (file_exists($muoviA)) {
		return array(error=> 10, message => "Il file '$muoviA' esiste già. Rimuovere prima di provare a ripristinare.");
	}
	if (!file_exists($muoviDa)) {
		return array(error=> 20, message => "Il file '$muoviDa' è già stato rimosso. ripristinare il file o intervenire a mano.");
	}		
	
	try {
		rename($muoviDa, $muoviA);
	}
	catch (Exception $e) {
		$errMsg = "Impossibile muovere il file da '$muoviDa' a '$muoviA': " . $e.getMessage();
		error_log("disabbinaArciereFoto: " . $errMsg);
		return array(error=> 30, message => $errMsg);
	}
	if (removeAbbinamentoArciereFoto($nTessera)) {
		return array(error=> 0, message => "");
	} else {
		$errMsg = "Errore rimuovendo l'abbinamento sulla tessera $nTessera. I file sono stati ripristinati, ma sul db l'abbinamento esiste ancora";
		error_log("disabbinaArciereFoto: " . $errMsg);
		return array(error=> 30, message => $errMsg);
	}
	
}



/**
 * La funzione abbinaArciereFoto si occupa di gestire l'abbinamento di una foto al relativo arciere
 * nTessera -> tessera da abbinare
 * nomeFoto -> nome del file della foto che andrà abbinata a nTessera
 * restituisce -> error: esito. message: descrizione dell'eventuale errore
 * 	error = 0 -> Abbinamento terminato con successo;
 * 	error != 0 -> - Errore
 * */
function abbinaArciereFoto ($nTessera, $nomeFoto) {
	
	if (DEBUG) {
		error_log("abbinaArciereFoto - \$nTessera --> $nTessera");
		error_log("abbinaArciereFoto - \$nomeFoto --> $nomeFoto");
	
	}
	

	
	$ext = strtolower ( substr ( $nomeFoto, strrpos ( $nomeFoto, '.' ) + 1 ) );
	$compagnia = min(getCompagniaArciere($nTessera));
	$newName = $compagnia . "_" . $nTessera . "." . $ext;
	$destinazione = AIRO_FS_FOLDER_FOTO_PODIO . $newName;
	$oldName = AIRO_FS_FOLDER_FOTO_DA_ASSOCIARE . $nomeFoto;
	
	if (!file_exists($oldName)) {
		return array ("error" => 10, "messagge" => "Il file $oldName non esiste.");
	}
	
	if (file_exists($destinazione)) {
		return array ("error" => 20, "messagge" => "Il file $destinazione esiste già.");
	}
	
	
	if (DEBUG) {
		error_log("Foto: $nomeFoto");
		error_log("Estensione: $ext");
		error_log("NewName: $newName");
		error_log("OldName: $oldName");
		
	}
	//		return "ciao";
	try {
		if (!setAbbinamentoArciereFoto($nTessera, $newName, $nomeFoto))
		{
			if(DEBUG) {
				error_log("abbinaArciereFoto - Abbinamento FALLITO!! (DB) tessera: '$nTessera', nuovo nome: '$newName', nome originale: '$nomeFoto'.");
			}
			return array ("error" => 30, "messagge" => "Impossible abbinare la tessera $nTessera alla foto $nomeFoto");
		}
		else {
			if(DEBUG) {
		
				error_log("abbinaArciereFoto - Abbinamento completato (DB) tessera: '$nTessera', nuovo nome: '$newName', nome originale: '$nomeFoto'.");
			}
		}
		// db insert
	}
		catch (Exception $c) {
		return $c;
	}
	
	
	try {
		rename($oldName, $destinazione);
		return array ("error" => 0, "messagge" => "");
	}
	catch (Exception $c) {
		if (removeAbbinamentoArciereFoto($nTessera)) {
		// return "status: ko, messagge: impossible to rename $oldName in $nomeFoto";
			return array ("error" => 40, "messagge" => "Impossible rinominare $oldName in $destinazione! Operazione annullata.");
		} else {
			return array ("error" => 50, "messagge" => "Impossible rinominare $oldName in $destinazione! Operazione incompleta. Attenzione, su DB l'abbinamento è completo! ");
			
		}
	}

	
}

?>