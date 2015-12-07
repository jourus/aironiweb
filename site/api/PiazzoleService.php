<?php

include 'query.php';
include_once 'config.php';


// recupero dei parametri
// min --> La prima piazzola da estrarre
// max --> L'ultima piazzola da estrarre

function getPiazzole($piazzolaDa, $piazzolaA) { 
		
	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");
	
	// preparazione dello statement SQL
	$stmt = $conn->prepare(AIRO_SQL_GET_PIAZZOLE);
	
	$stmt->bind_param("ii", $piazzolaDa, $piazzolaA);
		
	$stmt->execute();
	
	$result=$stmt->get_result();
	
	// serializzazione dei dati in un array
	$rows = array();
	while($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	$conn->close();
	
	// invio output a client
	return $rows;
	// flush();

}




function getCategorie($idCategoria) { 
		
	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");
	
	// preparazione dello statement SQL
	// se il parametro è null, viene scelto uno statement SQL senza criteri di filtro.
	if (is_null($idCategoria)) {
		$stmt = $conn->prepare(AIRO_SQL_GET_CATEGORIE_ALL);
	}
	else {
		$stmt = $conn->prepare(AIRO_SQL_GET_CATEGORIE_BY_ID);
		$stmt->bind_param("s", $idCategoria);
	}
	
		
	$stmt->execute();
	
	$result=$stmt->get_result();
	
	// serializzazione dei dati in un array
	$rows = array();
	while($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	$conn->close();
	
	// invio output a client
	return $rows;
	// flush();

}



function getClassi($idClasse) {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");
	
	// preparazione dello statement SQL
	// se il parametro è null, viene scelto uno statement SQL senza criteri di filtro.
	if (is_null($idClasse)) {
		$stmt = $conn->prepare(AIRO_SQL_GET_CLASSI_ALL);
	}
	else {
		$stmt = $conn->prepare(AIRO_SQL_GET_CLASSI_BY_ID);
		$stmt->bind_param("s", $idClasse);
	}


	$stmt->execute();

	$result=$stmt->get_result();

	// serializzazione dei dati in un array
	$rows = array();
	while($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	$conn->close();

	// invio output a client
	return $rows;
	// flush();

}


function getPodio($idClasse, $idCategoria) {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");
	
	$stmt = $conn->prepare(AIRO_SQL_GET_PODIO);
	$stmt->bind_param("ss", $idClasse, $idCategoria);


	$stmt->execute();

	$result=$stmt->get_result();

	// serializzazione dei dati in un array
	$rows = array();
	while($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	$conn->close();

	// invio output a client
	return $rows;
	// flush();

}



function getClassifica($idClasse, $idCategoria) {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");

	$stmt = $conn->prepare(AIRO_SQL_GET_CLASSIFICA);
	$stmt->bind_param("ss", $idClasse, $idCategoria);


	$stmt->execute();

	$result=$stmt->get_result();

	// serializzazione dei dati in un array
	$rows = array();
	while($row = $result->fetch_assoc()) {
		$rows[] = $row;
	}
	$conn->close();

	// invio output a client
	return $rows;
	// flush();

}

function getInformazioniGara() {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");
	
	// preparazione dello statement SQL
	$stmt = $conn->prepare(AIRO_SQL_GET_INFORMAZIONI);

	$stmt->execute();

	$result=$stmt->get_result();
	
	$conn->close();
	
	if($row = $result->fetch_assoc()) {
		return $row;
	}
	else
		return null;

}

function getScoreConsegnato($piazzola) {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Importante! Errori con gli apostrofi!
	$conn->set_charset("utf8");

	// preparazione dello statement SQL
	$stmt = $conn->prepare(AIRO_SQL_GET_SCORE_CONSEGNATI);
	
	$stmt->bind_param("i", $piazzola);
		
	$stmt->execute();
	
	$result=$stmt->get_result();

	$conn->close();
	
	if($row = $result->fetch_assoc()) {
		return $row;
	}
	else 
		return null;



}

?>
