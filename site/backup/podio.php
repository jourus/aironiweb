<?php
include 'config.php';
include 'funzioni.php';

if (isset ( $_GET ['classe'] )) {
	$classe = $_GET ['classe'];
	$nomeClasse = getClassi ( $classe );
} else
	$classe = $nomeClasse = "";

if (isset ( $_GET ['categoria'] )) {
	$categoria = $_GET ['categoria'];
	$nomeCategoria = getCategorie ( $categoria );
} else
	$categoria = $nomeCategoria = "";
	
	// Create connection
$conn = new mysqli ( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME );
// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}

$sql = "SELECT A.CATEGORIA, A.PUNTI, A.SPOT + A.SUPERSPOT as SPOT, A.SUPERSPOT as SUPER, concat(A.NOME, ' ' , A.cognome) as ISCRITTI , A.CLASSE, B.NomeFile FROM ISCRITTI A LEFT JOIN IMMAGINI B ON A.TESSERA = B.ID WHERE A.CLASSE= ? AND A.CATEGORIA = ? AND A.PUNTI is not null  ORDER BY A.PUNTI DESC, A.SPOT + A.SUPERSPOT DESC LIMIT 3;";
// echo $sql;

$stmt = $conn->prepare ( $sql );

$stmt->bind_param ( "ss", $classe, $categoria );

$stmt->execute ();
$result = $stmt->get_result ();

$numeroarcieri = $result->num_rows;

$anagrafica1 = "";
$punti1 = "";
$spot1 = "";
$super1 = "";
$anagrafica2 = "";
$punti2 = "";
$spot2 = "";
$super2 = "";
$anagrafica3 = "";
$punti3 = "";
$spot3 = "";
$super3 = "";
$foto1 = $FotoPodioStandard;
$foto2 = $FotoPodioStandard;
$foto3 = $FotoPodioStandard;

$j = 1;
while ( $row = $result->fetch_assoc () ) {
	
	if ($j == 1) {
		$anagrafica1 = $row ['ISCRITTI'];
		$punti1 = $row ['PUNTI'];
		$super1 = $row ['SUPER'];
		$spot1 = $row ['SPOT'];
		$foto1 = $row ['NomeFile'];
	}
	
	if ($j == 2) {
		$anagrafica2 = $row ['ISCRITTI'];
		$punti2 = $row ['PUNTI'];
		$super2 = $row ['SUPER'];
		$spot2 = $row ['SPOT'];
		$foto2 = $row ['NomeFile'];
	}
	
	if ($j == 3) {
		$anagrafica3 = $row ['ISCRITTI'];
		$punti3 = $row ['PUNTI'];
		$super3 = $row ['SUPER'];
		$spot3 = $row ['SPOT'];
		$foto3 = $row ['NomeFile'];
	}
	
	$j ++;
}
$conn->close ();

// Viene scelta l'immagine da usare come sfondo in base alla categoria d'arco
switch (strtoupper ( $categoria )) {
	case "AS" :
		$sfondo = "sfondo-sto.gif";
		break;
	case "LB" :
		$sfondo = "sfondo-lon.gif";
		break;
	case "RI" :
		$sfondo = "sfondo-ric.gif";
		break;
	case "CO" :
		$sfondo = "sfondo-comp.gif";
		break;
	case "SL" :
		$sfondo = "sfondo-comp.gif";
		break;
	case "SI" :
		$sfondo = "sfondo-comp.gif";
		break;
	
	case "FS" :
		$sfondo = "sfondo-comp.gif";
		break;
	
	case "AN" :
		$sfondo = "sfondo-ric.gif";
		break;
	
	default :
		$sfondo = "sfondo-sto.gif";
}

// arrayfinaleclassi=iniziostringa&arrayclassi&terminestringa
// arrayfinalecategorie=iniziostringa&arraycategorie&terminestringa

// response.write(arrayfinaleclassi&"<BR>"&arrayfinalecategorie)

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Podio</title>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<link href="stile" rel="styleshpatht" type="text/css">
<META http-equiv="Page-exit"
	CONTENT="RevealTrans(Duration=1,Transition=12)">
<link href="aironi.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>


<body style="background-image: url('immagini/<?php echo $sfondo ?>'); margin: 0px;">
	<div id="classe"
		style="position: absolute; left: 242px; top: 31px; width: 315px; height: 23px; z-index: 1;">
		<div align="left" class="categoria"><?php echo $nomeClasse?></div>
	</div>
	<div id="categoria"
		style="position: absolute; left: 242px; top: 71px; width: 315px; height: 40px; z-index: 2;"
		class="classe">
		<div align="left"><?php echo $nomeCategoria ?></div>
	</div>
	<div id="punti2" class="punti"><?php echo $punti2?></div>
	<div id="spot2" class="spot"><?php echo $spot2 . ' (Super: ' . $super2 . ')'?></div>
	<div id="foto2"
		style="position: absolute; left: 100px; top: 161px; width: 190px; height: 253px; z-index: 5">
		<img src="immagini/foto/<?php echo $foto2?>" width="190" height="253">
	</div>
	<div id="punti1" class="punti"><?php echo $punti1 ?></div>
	<div id="spot1" class="spot"><?php echo $spot1 . ' (Super: ' . $super1 . ')'?></div>
	<div id="punti3" class="punti"><?php echo $punti3 ?></div>
	<div id="spot3" class="spot"><?php echo $spot3 . ' (Super: ' . $super3 . ')'?></div>
	<div id="foto1"
		style="position: absolute; left: 310px; top: 105px; width: 190px; height: 253px; z-index: 5"
		class="anagrafica">
		<img src="immagini/foto/<?php echo $foto1?>" width="190" height="253">
	</div>
	<div id="foto3"
		style="position: absolute; left: 522px; top: 170px; width: 190px; height: 253px; z-index: 5">
		<img src="immagini/foto/<?php echo $foto3 ?>" width="190" height="253">
	</div>
	<div id="anagrafica1"
		style="position: absolute; width: 190px; height: 21px; z-index: 6; left: 100px; top: 418px; background-color: #DEEFFF; layer-background-color: #DEEFFF; border: 1px none #000000;"
		class="anagrafica">
		<div align="center"><?php echo $anagrafica2?></div>
	</div>
	<div id="anagrafica2"
		style="position: absolute; width: 190px; height: 21px; z-index: 6; left: 311px; top: 363px; background-color: #DEEFFF; layer-background-color: #DEEFFF; border: 1px none #000000;"
		class="anagrafica">
		<div align="center"><?php echo $anagrafica1?></div>
	</div>
	<div id="anagrafica3"
		style="position: absolute; width: 190px; height: 21px; z-index: 6; left: 522px; top: 432px; background-color: #DEEFFF; layer-background-color: #DEEFFF;"
		class="anagrafica">
		<div align="center"><?php echo $anagrafica3 ?></div>
	</div>
</body>
</html>

