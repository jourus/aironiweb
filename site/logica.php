<?php
include 'config.php';


// Create connection
$conn = new mysqli(AIRO_CONN_SERVERNAME, AIRO_CONN_USERNAME, AIRO_CONN_PASSWORD, AIRO_CONN_DBNAME);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ISCRITTI.CATEGORIA, ISCRITTI.CLASSE, Count(ISCRITTI.CATEGORIA) AS ConteggioDiCATEGORIA, Sum(ISCRITTI.PUNTI) AS SommaDiPUNTI FROM ISCRITTI GROUP BY ISCRITTI.CATEGORIA, ISCRITTI.CLASSE HAVING (((Sum(ISCRITTI.PUNTI)) Is Not Null)) ORDER BY Count(ISCRITTI.CATEGORIA) DESC";
$result = $conn->query($sql);


$arrayclassi="";
$arraycategorie="";

$terminestringa="'fine'";

while($row = $result->fetch_assoc()) {
	$categoria = $row['CATEGORIA'];
	$classe = $row['CLASSE'];
	$arrayclassi .= "'" . $classe . "',";
	$arraycategorie .= "'" . $categoria . "',";
	
}
		
$arrayfinaleclassi = $arrayclassi . $terminestringa;
$arrayfinalecategorie = $arraycategorie . $terminestringa;

// $conn->close();



$sql="SELECT DISTINCT COMP FROM ISCRITTI WHERE PUNTI IS NOT NULL";
$result = $conn->query($sql);


//$comps = $result->num_rows;

$arraycompagnie="";
$terminestringacomp="'finecomp'";
	
		
while($row = $result->fetch_assoc()) {
	$comp=$row['COMP'];
	$arraycompagnie .= "'" . $comp . "',";

	//echo "<script>alert($arraycompagnie);</script>";
	
}

$conn->close();

$arraycompagnie .= $terminestringacomp;


//echo "<script>alert(\"$arraycompagnie\"   righe: ' );</script>";


//echo $arrayfinaleclassi . "<br>" . $arrayfinalecategorie . "<br>" . $arraycompagnie . "<br>";

//response.write(arrayfinaleclassi&"<BR>"&arrayfinalecategorie&"<br>"&arraycompagnie)
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Logica</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script>
//script Aury



var arrclassi= [<?php echo $arrayfinaleclassi?>] ;
var arrcategorie= [<?php echo $arrayfinalecategorie?>] ;
var arrCompagnie= [<?php echo $arraycompagnie?>] ;
var indice = 0 ;
var indicecomp = 0 ;
var tiposchermata = 0 ;
var secondiciclo = 7000 ;
var TutteCompagnie = 0;
var TutteClassi = 0 ;
// 0 podio 123 , 1 classifica completa , 2 foto varie, 3 classifica compagnie



function cambiapodio(){

	classe=arrclassi[indice];
	categoria=arrcategorie[indice];
	compagnia=arrCompagnie[indicecomp];

	if ((TutteClassi==1) && (TutteCompagnie==1))
	//reload della pagina per ricostruire gli array con in nuovi cat classi e compagnie che hanno punti
	{
		self.location.replace('logica.php');
	}

	else{


		if (classe=="fine")
		//azzero il counter classicat
		{
			indice=0;
			TutteClassi=1;
		}

		if (compagnia=="finecomp")
		//azzero il counter delle compagnie
		{
			indicecomp=0;
			TutteCompagnie=1;
		}

		vartiposchermata = tiposchermata
		//alert (vartiposchermata)
		if (vartiposchermata == 0)
		{//schermata del podio classico

			//contollare il tipo di categoria pere decidere il podio
				
			urlpodio='podio.php?classe='+classe+'&categoria='+categoria;

			//alert(urlpodio);
			parent.contpodio.location.replace(urlpodio);
			tiposchermata = tiposchermata+1
		}
		else
		{
			if (vartiposchermata == 1) {//schermata classifica

				urlpodio='classifica.php?classe='+classe+'&categoria='+categoria;


				parent.contpodio.location.replace(urlpodio);
				tiposchermata = tiposchermata+1;
				indice=indice+1;
			}
			else
			{
					
					
				if (vartiposchermata == 2) {//schermata foto
					urlpodio='fotografie.php';
					//alert(urlpodio);

					parent.contpodio.location.replace(urlpodio);
					tiposchermata = tiposchermata+1;
					//commentare la riga sotto per avere la class per compagnie
					//tiposchermata = 0;
					//
					tiposchermata = tiposchermata + 1;
				}
				else
				{//schermata classifica per comp
						


					urlpodio='classifica_compagnia.php?Compagnia='+compagnia;
					//alert(urlpodio);

					parent.contpodio.location.replace(urlpodio);
					indicecomp=indicecomp+1;
					tiposchermata = 0;



				}
					
					
					
			}


		}
			




	}

}





function ciclocontinuo()
{

	var tempo = cambiapodio();

	window.setTimeout('ciclocontinuo()',secondiciclo);

	//alert('ciao');
}


</script>

<!-- <body onload="window.setTimeout('getSecs()',1)"> -->
<body onload="ciclocontinuo();">
</body>
</html>
