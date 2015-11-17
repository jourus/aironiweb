<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Aironi Consolle</title>
<link href="stile.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">

	function MM_openBrWindow(theURL,winName,features) { //v2.0
	  window.open(theURL,winName,features);
	}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body leftmargin="2" topmargin="0" marginwidth="0" marginheight="0">
<div>
<div id="comandimanuali">
<table width=80% border="0"  bordercolor="#999999">
              <tr class="intestazioni"> 
                <td width=300px> <div align="right">Podio</div></td>
                <td width=100px> <div align="center">Classe</div></td>
                <td width=100px> <div align="center">Categoria</div></td>
                <td width=300px> <div align="left">Classifica</div></td>
              </tr>
              
<?php
	
	include 'config.php';
	include 'funzioni.php';
	
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT ISCRITTI.CATEGORIA, ISCRITTI.CLASSE FROM ISCRITTI GROUP BY ISCRITTI.CATEGORIA, ISCRITTI.CLASSE Order BY ISCRITTI.CLASSE , ISCRITTI.CATEGORIA ;";
	$result = $conn->query($sql);
	
	$ncategorie=$result->num_rows;
	

	$j=0;
	while($row = $result->fetch_assoc()) {          
	//for ($j=0; $j <= $ncategorie;$j++) {
		$j++;
		if ($j % 2 == 0) 
			$formatClasseRiga="righe";
		else 		 
			$formatClasseRiga="righealt";
	
		$classe = $row["CLASSE"];
		$categoria = $row["CATEGORIA"];
		  		
		  		
		if (right($classe,1) == "M") {
			$imgvideo = "PodioSimpleM.jpg"; 
		} 
			else {
		$imgvideo = "PodioSimpleF.jpg";
		}      
		 			
		 			
		 $Podio = "<div align=\"right\"><a href=\"#\" onClick=\"MM_openBrWindow('podio.asp?classe=" . $classe . "&categoria=" . $categoria . "','onda','menubar=no,width=800,height=600')\"><img src=\"immagini/". $imgvideo . "\" width=\"14\" height=\"14\" border=\"0\"></a></div>";
		 $Classifica = "<div align=\"right\"><a href=\"#\" onClick=\"MM_openBrWindow('classifica.asp?classe=" . $classe . "&categoria=" . $categoria . "','onda','menubar=no,width=800,height=600')\"><img src=\"immagini/". $imgvideo . "\" width=\"14\" height=\"14\" border=\"0\"></a></div>";
		 	
		 echo tableRow(" class=\"" . $formatClasseRiga . "\"", array($Podio, $classe, $categoria, $Classifica));
		
		 
		 echo "
		 <tr>
			<td class='interlinea'></td>
		 	<td class='interlinea-vuota'></td>
			<td class='interlinea-vuota'></td>
			<td class='interlinea-back'></td>
		 </tr>";
		 
		
		  
		 			
	}	
	$conn->close();
?>
    
            </table>
            
            
           
        </div>
		<div id="speciali">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#999999">
              <tr> 
                <td width="200" class="intestazioni">Speciali</td>
                <td>&nbsp;</td>
              </tr>
              <tr class="intestazioni"> 
                <td width="200"><div align="center"></div></td>
                <td><div align="center"></div></td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Piazzole</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('piazzoletot.asp','onda','menubar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>
              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Autogiro</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('contenitore.htm','onda','menubar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>
              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Benvenuti</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('benveuti.htm','onda','toolbar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>
              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td width="200" class="vocimenu">Autofoto</td>
                <td><div align="center"><a href="#" onClick="MM_openBrWindow('fotografie_auto.asp','onda','toolbar=yes,width=800,height=600')"><img src="immagini/computer.gif" width="14" height="14"></a></div></td>
              </tr>

              <tr> 
                <td width="200"><img src="immagini/linea.jpg" width="200" height="4"></td>
                <td>&nbsp;</td>
              </tr>

       

            </table></div>
</div>   
</body>
</html>
