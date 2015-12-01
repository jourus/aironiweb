<?php
require_once 'config.php';


define("AIRO_SQL_GET_CLASSI_BY_ID", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE where id = ?;");
define("AIRO_SQL_GET_CLASSI_ALL", "select id as 'IdClasse', descrizione as 'DescrizioneClasse' from CLASSE;");
define("AIRO_SQL_GET_CATEGORIE_BY_ID", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA where id = ?;");
define("AIRO_SQL_GET_CATEGORIE_ALL", "select id as 'IdCategoria', descrizione as 'DescrizioneCategoria' from CATEGORIA;");




function getCategorie($idCategoria) {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

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
	
	$esito = "";
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$esito= $row['DescrizioneCategoria'];
	}
	$conn->close();
	
	return $esito;
	
	
}



function getClassi($idClasse) {

	// Create connection
	$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

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
	
	$esito = "";
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$esito= $row['DescrizioneClasse'];
	}
	$conn->close();
	
	return $esito;

}

//restituisce i primi $len caratteri di $str
function left($str,$len){
	return substr($str, 0, $len);
}


//restituisce gli ultimi $len caratteri di $str
function right($str,$len){
	$len=$len*-1;
	return substr($str, $len);
}



// sostituisce gli apici singoli con coppie di apici singoli
function apiciaposto($valore)
{
	return str_replace("'", "''", $valore);
	 
	//	$bodytag = str_replace("%body%", "black", "<body text='%body%'>");

}


function tableRow($properties, $fields) {

	$row = "<tr" . $properties . ">";
	$tdOpen = "<td>";
	$tdClose = "</td>";
	foreach ($fields as $field) {
		$row .= $tdOpen . $field . $tdClose;
			
	}
	$row .= "</tr>";
	return $row;

}




class gridClassifica
{
	public $Iscritto;
	public $Classe;
	public $Categoria;
	public $Punti;
	public $Spot;
	public $Super;


}





?>
