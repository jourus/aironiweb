<?php

include 'funzioni.php';


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airophp";
$righe = 0;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT TESSERA, COMP, PIAZZUOLA FROM iscritti";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Tessera: " . $row["TESSERA"]. " - Compagnia: " . $row["COMP"]. " " . $row["PIAZZUOLA"]. "<br>";
        $righe++;
        }
} else {
    echo "0 results";
}
$conn->close();

echo "sono state trovate " . $righe . "righe.";





echo "<table>";

echo tableRow("", array("Valore1", "Valore2"));


echo "</table>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ISCRITTI.NOME + ' ' + ISCRITTI.COGNOME AS ISCRITTI, PUNTI , SPOT + SUPERSPOT as SPOT, SUPERSPOT as SUPER  FROM ISCRITTI WHERE CLASSE= ? AND CATEGORIA = ? AND PUNTI IS NOT NULL ORDER BY PUNTI DESC, SPOT + SUPERSPOT DESC";

		$stmt = $conn->prepare($sql);
		
		$stmt->bind_param("ss", $classe, $categoria);
		$classe="CAM";
		$categoria="SI";
		$stmt->execute();
		$result=$stmt->get_result();
		
		$ncat=$result->num_rows;
		echo "la seconda stringa è --> $ncat";




?>