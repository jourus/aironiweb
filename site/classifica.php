<?php  
include 'config.php';
include 'funzioni.php';


if (isset($_GET['classe'])) {
	$classe = $_GET['classe'];
}
else
	$classe = "";

if (isset($_GET['categoria'])) {
	$categoria = $_GET['categoria'];
}
else
	$categoria = "";


             // Create connection
             $conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
             // Check connection
             if ($conn->connect_error) {
             	die("Connection failed: " . $conn->connect_error);
             }
             
             $sql = "SELECT concat(NOME, ' ', COGNOME) AS ISCRITTI, PUNTI , SPOT + SUPERSPOT as SPOT, SUPERSPOT as SUPER  FROM ISCRITTI WHERE CLASSE= ? AND CATEGORIA = ? AND PUNTI IS NOT NULL ORDER BY PUNTI DESC, SPOT + SUPERSPOT DESC";
             
             $stmt = $conn->prepare($sql);
             
             $stmt->bind_param("ss", $classe, $categoria);
             
             $stmt->execute();
             $result=$stmt->get_result();
             
             $numeroarcieri= $result->num_rows;
             
             
             if ($numeroarcieri > $MaxRigheArcieriInClassifica) {
             	 
             	 
             	$limite1 = $MaxRigheArcieriInClassifica;
             	$limite2 = $numeroarcieri;
             }
             else
             {
             	$limite1 = $numeroarcieri;
             	$limite2 = -1;
             	 
             }
              
             
             $TuttiGliArcieri = array();
             $TuttiGliArcieri[]=$numeroarcieri;
             
             $j=0;
             while($row = $result->fetch_assoc()) {
             	//for ($j=0; $j <= $ncategorie;$j++) {
             		
      //       	echo "-------------------zz- $j  " .  $row['ISCRITTI']   . $row['PUNTI'] . "<br>";
            	$TuttiGliArcieri[$j] = new gridClassifica();
            	$TuttiGliArcieri[$j]->Iscritto = $row['ISCRITTI'];
            	$TuttiGliArcieri[$j]->Punti = $row['PUNTI'];
            	$TuttiGliArcieri[$j]->Spot = $row['SPOT'];
            	$TuttiGliArcieri[$j]->Super = $row['SUPER'];
      			$j++;
      			
             }
             $conn->close();
             
             
            
             
           
             ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>classifica</title>
<script language="JavaScript" type="text/JavaScript">

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

</script>

<META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=1,Transition=12)">
<!--  <link href="stile.css" rel="stylesheet" type="text/css"> -->
<link href="css/aironi.css" rel="stylesheet" type="text/css">
<link href="css/classifica.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

 
<body id="bodyClassifica">
<div class="divTitolo">
<p class="DescClasseCategoria">Classifica: <?php echo getClassi($classe) ?> - <?php echo getCategorie($categoria) ?>
</p>
</div>
<div id="ClassificaSinistra" class="Classifica" >


  
          <table class='theadClassifica'>
          		<thead>
	              <tr> 
	                <td class='headPOS'>POS</td>
	                <td class='headNome'>Nome</td>
	                <td class='headPunti'>Punti</td>
	                <td class='headSpot'>Spot</td>
	                <td class='headSuper'>Super</td>
	                
	              </tr>
	           	</thead>
             	
             	<tbody class="posclassifica">		 
				 <?php 
				
				 
				 for ($x=0;$x<$limite1;$x++){
				 	echo "<tr class='rigaClassifica'>";
				 	$pos = $x + 1;
				 	echo "<td class='fields fieldPOS'>$pos</td>";
				 	echo "<td class='fields fieldNome'>" . $TuttiGliArcieri[$x]->Iscritto . "</td>";
				 	echo "<td class='fields fieldPunti'>" . $TuttiGliArcieri[$x]->Punti . "</td>";
				 	echo "<td class='fields fieldSpot'>" . $TuttiGliArcieri[$x]->Spot . "</td>";
				 	echo "<td class='fields fieldSuper'>" . $TuttiGliArcieri[$x]->Super . "</td>";
				 	echo "</tr>";
				 	
				 }
				 
				 ?>
             	</tbody>
          </table>
          
          </div>
<div id="ClassificaDestra" class="Classifica">

          <table class='theadClassifica'>
		  
		  <?php
		  		
		  		if($limite2 != -1) // Gli arcieri sono più di 24 in questa categoria. Esiste una seconda metà della classifica 
		  		{
		  			
			  		echo 	"<thead>
	              <tr> 
	                <td class='headPOS'>POS</td>
	                <td class='headNome'>Nome</td>
	                <td class='headPunti'>Punti</td>
	                <td class='headSpot'>Spot</td>
	                <td class='headSuper'>Super</td>
	                
	              </tr>
	           	</thead>
					 ";
				}
		  		
	
				for ($x= $MaxRigheArcieriInClassifica;$x<$limite2;$x++){
				 	echo "<tr>";
				 	$pos = $x + 1;
				 	echo "<td class='fields fieldPOS'>$pos</td>";
				 	echo "<td class='fields fieldNome'>" . $TuttiGliArcieri[$x]->Iscritto . "</td>";
				 	echo "<td class='fields fieldPunti'>" . $TuttiGliArcieri[$x]->Punti . "</td>";
				 	echo "<td class='fields fieldSpot'>" . $TuttiGliArcieri[$x]->Spot . "</td>";
				 	echo "<td class='fields fieldSuper'>" . $TuttiGliArcieri[$x]->Super . "</td>";
				 	echo "</tr>";
				}
				
				?>
				
            </table> 
			

			
		  
</div>


<div class="tConsegnascore">
  <h2>
    Situazione Consegna Scores
  </h2>

	  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          
          
          <?php 

// Create connection
$conn = new mysqli( AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT count(PUNTI) as numcons FROM ISCRITTI WHERE Piazzuola=?";
$stmt = $conn->prepare($sql);

for($i = 1; $i <= $NumeroPiazzoleGara ; $i++) 
{
	//echo "riga $i <br>";
	$stmt->bind_param("i", $i);
	$stmt->execute();
	$result=$stmt->get_result();
	
	if($row = $result->fetch_assoc()) {
	
		$scorescons = $row['numcons'];
		
		
		if ($scorescons==0) 
			$piazzscoreconsyesno="piazzscoreconsno";
		else
			$piazzscoreconsyesno="piazzscoreconsyes";
		
				   
			
		echo "<td class='consegnascores $piazzscoreconsyesno'>$i</td>";
		
		if ($i == $NumeroPiazzoleGara / 2)
		{
			echo "</tr><tr>";
		}
				
		
		}
		//echo "Eseguita verifica su piazzola $i --> " . $row['numcons'] ." <br>";
	
	
	}


	$conn->close();
?>
          
          
          
          
        </tr>
      </table>
	 

    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="consegnascores piazzscoreconsyes">Piazzola che ha  CONSEGNATO</td>
        <td class="consegnascores piazzscoreconsno">Piazzola che NON ha CONSEGNATO</td>
      </tr>
    </table>
  </div>
</body>

</html>


		
