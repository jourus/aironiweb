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
             $conn = new mysqli($servername, $username, $password, $dbname);
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
<link href="stile.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

 
<body background="sfondo_class.gif" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0">
        <tr class="posclassifica"> 
          <td></td>
          <td class="classe">- 
            <?php echo $classe?><br>
           </td>
          <td class="classe"> -
           	<?php echo $categoria ?> <br>
          </td>
          <td width="100">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="440" valign="top"> <table width="100%" border="0">
        <tr>
          <td width="48%" valign="top"><table width="100%" border="0">
              <tr class="posclassifica"> 
                <td width="60"> <div align="center" class="posclassifica">POS</div></td>
                <td> <div align="center">-Nome-</div></td>
                <td>&nbsp;</td>
                <td width="70"> <div align="right">Punti</div></td>
                <td width="70"> <div align="right">Spot</div></td>
                <!-- 2011.03.27 GFF Aggiunta colonna super--> 
                <td width="70" > <div align="right">Super</div></td>
                
                <td>&nbsp;</td>
              </tr>
             
             			 
				 <?php 
				
				  
				 for ($x=0;$x<$limite1;$x++){
				 	echo "<tr>";
				 	$pos = $x + 1;
				 	echo "<td>$pos</td>";
				 	echo "<td>" . $TuttiGliArcieri[$x]->Iscritto . "</td>";
				 	echo "<td>&nbsp;</td>";
				 	echo "<td>" . $TuttiGliArcieri[$x]->Punti . "</td>";
				 	echo "<td>" . $TuttiGliArcieri[$x]->Spot . "</td>";
				 	echo "<td>" . $TuttiGliArcieri[$x]->Super . "</td>";
				 	echo "<td>&nbsp;</td>";
				 	echo "</tr>";
				 	
				 }
				 
				 ?>
             
          </table></td>
          <td valign="top">
		  <table width="100%" border="0">
		  
		  <?php
		  		
		  		if($limite2 != -1) // Gli arcieri sono più di 24 in questa categoria. Esiste una seconda metà della classifica 
		  		{
		  			
			  		echo 	"<tr class=\"posclassifica2\"> 
			  		      	<td width=50> <div align=\"right\">&nbsp;</div></td>
			                <td width=60> <div align=\"center\" class=\"posclassifica2\">POS</div></td>
			                <td> <div align=\"center\">Nome</div></td>
			                <td>&nbsp;</td>
			                <td width=70> <div align=\"right\">Punti</div></td>
			                <td width=70> <div align=\"right\">Spot</div></td>
			                 <td width=70> <div align=\"right\">Super</div></td>
			                <td>&nbsp;</td>
				              </tr>
					 ";
				}
		  		
	
				for ($x= $MaxRigheArcieriInClassifica + 1;$x<$limite2;$x++){
					echo "<tr>";
					
					$pos = $x ;
					
					echo "<td>$pos</td>";
					echo "<td>" . $TuttiGliArcieri[$x]->Iscritto . "</td>";
					echo "<td>&nbsp;</td>";
					echo "<td>" . $TuttiGliArcieri[$x]->Punti . "</td>";
					echo "<td>" . $TuttiGliArcieri[$x]->Spot . "</td>";
					echo "<td>" . $TuttiGliArcieri[$x]->Super . "</td>";
					echo "<td>&nbsp;</td>";
					echo "</tr>";
				
				}
				
				?>
				
            </table> 
			

			
		  </td>
        </tr>
    </table></td>
  </tr>
</table>



<table width="100%" border="0">
  <tr class="posclassifica2">
    <td class="PloticusTitle">Situazione Consegna Scores </td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio">
	<!--tabella Piazzole-->
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          
          
          <?php 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
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
		
				   
			
		echo "<td class=\"$piazzscoreconsyesno\">$i</td>";
		
		if ($i == $NumeroPiazzoleGara / 2)
		{
			echo "</tr><tr class=\"tabellapodio\">";
		}
				
		
		}
		//echo "Eseguita verifica su piazzola $i --> " . $row['numcons'] ." <br>";
	
	
	}


	$conn->close();
?>
          
          
          
          
        </tr>
      </table>
	  </td>
  </tr>
 
  <tr class="tabellapodio">
    <td class="vocimenu">Legenda</td>
  </tr>
  <tr class="tabellapodio">
    <td class="tabellapodio"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" class="piazzscoreconsyes">Piazzola che ha  CONSEGNATO</td>
        <td class="piazzscoreconsno">Piazzola che NON ha CONSEGNATO</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>


		
