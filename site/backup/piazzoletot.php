<?php
include 'config.php';

if (isset ( $_GET ["Pagcorrente"] )) {
	$Pagcorrente = $_GET ["Pagcorrente"];
} else {
	$Pagcorrente = 1;
}

// gestione cambio pagina
if ($Pagcorrente < $MaxPagineClassifica) {
	$Pagsuccessiva = $Pagcorrente + 1;
} else {
	$Pagsuccessiva = 1;
}

// $_SESSION["Pagcorrente"]=$Pagsuccessiva;

// Definizione della piazzola per ciascun box
$Prima = ($Pagcorrente * 6) - 5;
$Seconda = ($Pagcorrente * 6) - 4;
$Terza = ($Pagcorrente * 6) - 3;
$Quarta = ($Pagcorrente * 6) - 2;
$Quinta = ($Pagcorrente * 6) - 1;
$Sesta = ($Pagcorrente * 6);
function printpiazzola($piaz) {
	if ($piaz > 28)
		return;
	
	$tblHead = "<table width='100%' border='0'><tr class='POSclassifica'><td class='posclassifica2'><div align='center'>Piazzola $piaz </div></td></tr>";
	$tblFooter = "</table>";
	
	// Create connection
	$conn = new mysqli ( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME );
	// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
	
	$sql = "SELECT ISCRITTI.COGNOME,  ISCRITTI.NOME FROM ISCRITTI Where PIAZZUOLA = ? AND POS = ?";
	
	// preparazione dello statement SQL
	$stmt = $conn->prepare ( $sql );
	
	$stmt->bind_param ( "ii", $piaz, $pos );
	
	echo $tblHead;
	
	for($pos = 1; $pos <= 6; $pos ++) {
		
		$stmt->execute ();
		
		$result = $stmt->get_result ();
		
		if ($row = $result->fetch_assoc ()) {
			$nome = $row ['NOME'] . ' ' . $row ['COGNOME'];
		} else {
			$nome = '&nbsp;';
		}
		
		echo "<tr><td nowrap class='nomeinpiazzola'><div align='center' class='nomeinpiazzola'> $nome </div></td></tr>";
	}
	echo $tblFooter;
	$conn->close ();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Piazzole</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->

function cambio(){

self.location.replace('piazzoletot.php?Pagcorrente=<?php echo $Pagsuccessiva ?>');

}


function ciclocontinuo()
{

 window.setTimeout('cambio()',5000);
  //alert('test')
}
</script>
<META http-equiv="Page-exit"
	CONTENT="RevealTrans(Duration=1,Transition=10)">
<link href="stile.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<body background="immagini/sfondo_classifica.png" leftmargin="0"
	topmargin="0" marginwidth="0" marginheight="0" onload="ciclocontinuo()">

	<div class="categoria" align="center">Piazzole</div>
	<div class="piazzolapregara"><?php printpiazzola($Prima); ?></div>
	<div class="piazzolapregara"><?php printpiazzola($Seconda); ?></div>
	<div style='clear: both;'></div>
	<div class="piazzolapregara"><?php printpiazzola($Terza); ?></div>
	<div class="piazzolapregara"><?php printpiazzola($Quarta); ?></div>
	<div style='clear: both;'></div>
	<div class="piazzolapregara"><?php printpiazzola($Quinta); ?></div>
	<div class="piazzolapregara"><?php printpiazzola($Sesta); ?></div>
	<div style='clear: both;'></div>


</body>
</html>
