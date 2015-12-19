<?php
include 'query.php';
include_once 'config.php';

// recupero dei parametri
// min --> La prima piazzola da estrarre
// max --> L'ultima piazzola da estrarre

function getPiazzole($piazzolaDa, $piazzolaA) {
	return getGenericData(AIRO_SQL_GET_PIAZZOLE, "ii", array($piazzolaDa, $piazzolaA));
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




// Restituisce tutte le foto di gara non necessariamente legate ad un arciere
// presenti nella loro specifica cartella
function getElencoFotoLibere() {
	// return $arrfiles = scandir(AIRO_FOLDER_AUTOFOTO);
	$rootDir = AIRO_FOLDER_AUTOFOTO;
	$allowext = array (
			"jpg",
			"png",
			"jpeg",
			"gif" 
	);
	$files_array = scanDirectories ( $rootDir, $allowext );
	shuffle ( $files_array );
	return $files_array;
}

// Restituisce tutte le foto aventi un determinato set di estensioni all'interno di una cartella.
// Attenzione! Non supporta regular expression
// $rootDir -> Il percorso da analizzare
// $allowext -> Array di estensioni
// $allData -> Array di file restituiti
function scanDirectories($rootDir, $allowext, $allData = array()) {
	$dirContent = scandir ( $rootDir );
	foreach ( $dirContent as $key => $content ) {
		$path = $rootDir . $content;
		$ext = strtolower ( substr ( $content, strrpos ( $content, '.' ) + 1 ) );
		
		if (in_array ( $ext, $allowext )) {
			if (is_file ( $path ) && is_readable ( $path )) {
				// $allData[] = $content;
				$allData [] = AIRO_FOLDER_AUTOFOTO_FULL . $content;
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
			print_r($parametri,false);
		}
;
	}
	
	$stmt->execute();
	
//	$stmt->execute ();
	
	$result = $stmt->get_result ();
	
	
	
	
	if ($singleLine) {
		
		if ($row = $result->fetch_assoc ()) {
			return $row;
		} else
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





?>
