<?php 
include 'config.php';
include 'funzioni.php';

if (isset($_GET['Compagnia'])) {
	$Compagnia = $_GET['Compagnia'];
}
else
	$Compagnia = "";



// Create connection
$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$ssql="SELECT concat(ISCRITTI.NOME, ' ', ISCRITTI.COGNOME) AS ISCRITTI, PUNTI , (SUPERSPOT + SPOT) as 'SPOT' ,CLASSE , CATEGORIA FROM ISCRITTI WHERE  COMP= ? AND PUNTI IS NOT NULL ORDER BY COGNOME,CLASSE,categoria,PUNTI DESC";

// preparazione dello statement SQL
$stmt = $conn->prepare($ssql);

$stmt->bind_param("s", $Compagnia);

$stmt->execute();

$result=$stmt->get_result();

$numeroarcieri = $result->num_rows;

if ($numeroarcieri > 25) {
	$limite1 = 25;
	$limite2 = $numeroarcieri;
}
else  {
	$limite1 = $numeroarcieri;
	$limite2 = -1;
}
$TuttiGliArcieri = array ();
$TuttiGliArcieri [] = $numeroarcieri;

$j = 0;
while ( $row = $result->fetch_assoc () ) {
	// for ($j=0; $j <= $ncategorie;$j++) {
	
	// echo "-------------------zz- $j " . $row['ISCRITTI'] . $row['PUNTI'] . "<br>";
	$TuttiGliArcieri [$j] = new gridClassifica ();
	$TuttiGliArcieri [$j]->Iscritto = $row ['ISCRITTI'];
	$TuttiGliArcieri [$j]->Punti = $row ['PUNTI'];
	$TuttiGliArcieri [$j]->Spot = $row ['SPOT'];
	$TuttiGliArcieri [$j]->Classe = $row ['CLASSE'];
	$TuttiGliArcieri [$j]->Categoria = $row ['CATEGORIA'];
	
	$j ++;
}
$conn->close ();
             
             
	

			
		
		
		
	
?>
		


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>classifica</title>
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

<META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=1,Transition=12)">
<link href="css/aironi.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

 
<body background="sfondo_class.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

 <div align="center" class="classe"> 
            <?php  echo $Compagnia; ?>
          </div>




<div class="Classifica">
           
              
               <?php 
				
               
               
               $tblHeader = "<table width='100%' border='0'><thead class='theadClassifica'>
              <tr class='posclassifica'> 
		        <td width='50' class='headPOS'>Classe Categoria</td>
                <td class='headNome'>Nome</td>
	                <td class='headPunti'>Punti</td>
	                <td class='headSpot'>Spot</td>              </tr></thead><tbody>";
               $tblFooter = "</tbody></table>";
               
               
               echo $tblHeader;
				  
				 for ($x=0;$x<$limite1;$x++){
				 	echo "<tr class='tabellapodio'>";
				 	$pos = $x + 1;
				 	echo "<td class='fldNome'>" . $TuttiGliArcieri[$x]->Classe . " " . $TuttiGliArcieri[$x]->Categoria . "</td>";
				 	echo "<td class='fldNome'>" . $TuttiGliArcieri[$x]->Iscritto . "</td>";
				 	echo "<td class='fldPunti'>" . $TuttiGliArcieri[$x]->Punti . "</td>";
				 	echo "<td class='fldSpot'>" . $TuttiGliArcieri[$x]->Spot . "</td>";
				 	echo "</tr>";
				 	
				 }
				echo $tblFooter;
			 
			
			echo "</div><div class='classificaPerCompagnia'>";
			    
			               
    
               
               
               if ($limite2 > 0) {
               
			               echo $tblHeader;
							  
							 for ($x=26;$x<$limite2;$x++){
							 	echo "<tr class='tabellapodio'>";
							 	$pos = $x + 1;
							 	echo "<td class='fldNome'>" . $TuttiGliArcieri[$x]->Classe . " " . $TuttiGliArcieri[$x]->Categoria . "</td>";
							 	echo "<td class='fldNome'>" . $TuttiGliArcieri[$x]->Iscritto . "</td>";
							 	echo "<td class='fldPunti'>" . $TuttiGliArcieri[$x]->Punti . "</td>";
							 	echo "<td class='fldSpot'>" . $TuttiGliArcieri[$x]->Spot . "</td>";
							 	echo "</tr>";
							 	
							 }
							echo $tblFooter;
			               }
				 ?>

</div>
<div style="clear: both;"></div>


</body>
</html>
