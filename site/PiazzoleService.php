<?php

include 'query.php';
include 'config.php';


// recupero dei parametri
// min --> La prima piazzola da estrarre
// max --> L'ultima piazzola da estrarre

if (isset($_GET['min'])) {
	$piazzolaDa = $_GET['min'];
}
else
	$piazzolaDa = 0;

if (isset($_GET['max'])) {
	$piazzolaA = $_GET['max'];
}
else
	$piazzolaA = 99;
	
// Create connection
$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

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
print json_encode($rows);
flush();


?>
