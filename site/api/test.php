<?php 
include 'PiazzoleService.php';
include_once 'query.php';
include_once 'config.php';

include 'Library.php';





echo "ciao";
 // getInformazioniGara();
// Create connection
$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// preparazione dello statement SQL
$stmt = $conn->prepare(AIRO_SQL_GET_INFORMAZIONI);

$stmt->execute();

$result=$stmt->get_result();

// serializzazione dei dati in un array
$rows = array();
while($row = $result->fetch_assoc()) {
	$rows[] = $row;
}
$conn->close();

//$z = $rows[0];


$f = getInformazioniGara();
$z = $f[0];
echo "<br> 2--> " . $z['provincia'] .  "<br> 2--> " . $z['tipo'] . "<br> 2--> " . utf8_decode( $z['localita']) . "<br> 2--> " . $z['data'] ." trovato!!";

echo json_encode($z);
echo json_last_error_msg();
echo "<br>";
echo unicode_decode("Arcieri dell\u2019Airone");
echo unicode_decode("Qui non ho bisogno di nulla.");

// flush();

?>


<script  type="text/javascript">
function formatDate(giorno) {
	try {
		var oggi = new Date(giorno);
		
		var G = oggi.getDate();
		var M = (oggi.getMonth());
		var A = (oggi.getYear() + 1900);
		
		var mese = Array("gennaio", "febbraio", "marzo", "aprile", "maggio", "giugno", "luglio", "agosto", "settembre", "ottobre", "novembre", "Dicembre")
		
		return(G + " " + mese[M] + " " + A);
	}
	catch (errore)
	{
		return "";
	}
}

document.write(formatDate(new Date()));

document.write("<br>");
document.write("10<br>");

try {
	if ("ciccio".getMonth()==NaN) {
		document.write("Questo è Nan<br>");
	} else {
		document.write("Questo NON è Nan<br>");
	}
}
catch (error){
	document.write("Si è rotto!<br>");
}

document.write("20<br>");

document.write("<br>------------------------------------------------------<br>");
document.write("1. Ciao " + formatDate('osti!') + " ;<br>");
document.write("2. 'Sera " + formatDate('2016-7-12') + ";<br>");
document.write("<br>------------------------------------------------------<br>");
document.write("20<br>");



</script>


<?php 
echo ("<br>------------------------------------------------------<br>");
echo json_encode( getScoreConsegnato(1));

?>