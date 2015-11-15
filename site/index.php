<?php
$servername = "localhost";
$username = "airo";
$password = "airo";
$dbname = "airophp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT tessera, comp, piazzuola FROM iscritti";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Tessera: " . $row["TESSERA"]. " - Compagnia: " . $row["COMP"]. " " . $row["PIAZZUOLA"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>