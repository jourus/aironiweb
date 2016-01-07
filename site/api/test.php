<html>
<head>
<title>Pagina di esperimenti</title>
<script src="../js/jquery.js"></script>
<style type="text/css">
* {
	margin: 0px;
	border: 0px;
	padding: 0px;
}

.myItem {
	border: 2px dashed red;
	background-color: yellow;
	position: relative;
}

#imgDefault {
	/*background-image= url('../immagini/Logo 04AIRO.png');
	*/
	width: 400px;
	height: 400px;
	position: 30px 30px;
	visibility: visible;
	background-color: white;
	/* calc((100% - 400px) / 2) calc((100% - 400px) / 2); */
}
</style>
</head>
<body>

<p>
<?php 
include_once 'PiazzoleService.php';


getCompagniaArciere(23);

$ciccio =  getAllowedExt();
$pluto = "jpg";

//echo $ciccio[0] . "<br/>";


if (in_array ( $pluto, $ciccio )){
	echo "Ho trovato PLUTO<br/><br/><br/>";	
}
	else {
		echo "Nulla da segnalare<br/><br/><br/>";
	}




$pieces = getClassificaCompagnia('04ARCH');
getPodio('CAM', 'SI');


$ext =  getAllowedExt();

echo  join(";", $ext);
$ciccio = getElencoFotoDaAssociare();
echo "Ci sono " . count($ciccio) ." file";
echo "GIANFRANCO";



//echo json_encode($pieces);



// return getGenericData(AIRO_SQL_GET_CLASSIFICA_COMPAGNIA, "s", array($compagnia));


echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";

$variabile1 = [];
$variabile1 []= "s";

$parm = array("04ARCH");

 array_unshift($variabile1, "prova");

if(is_array($variabile1)){
	echo "è un array<br/>";
}
else
{
	echo "boh!<br/>";
}

echo join("<br>", $variabile1);

echo "<br/>--------------------<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
	

?>

</p>

	<p style="border: 2px solid red;">Ciao anche da qui</p>
	<div id="theDiv"
		style="width: 800px; height: 600px; border: 2px solid orange;">
		<img class='myItem' id="imgDefault" src='../immagini/Logo 04AIRO.png'></img>
	</div>
	<script type="text/javascript">



function getElencoFoto() {

	var myUrl = '../api/?method=elencofoto&format=json';
	var esito=[];
	$.ajax({
			dataType: 'json',
			url: myUrl, 
			async: false, 
			success: function(data) {
					esito = data.data;				
				}
	});
	return esito;
	
}



// Accoda in session l'elenco delle foto (random) da far girare.
function preloadFoto() {

	var myUrl = '../api/?method=elencofoto&format=json';
	
	$.ajax({
			dataType: 'json',
			url: myUrl, 
			async: true, 
			success: function(data) {
					
					var elencoFoto = [];
					
					

					if(sessionStorage.ElencoFoto)
					{	
						elencoFoto = JSON.parse(sessionStorage.ElencoFoto);
					}

					// if (elencoFoto.lenght < 10) {}
					var esito = elencoFoto.concat(data.data);
					sessionStorage.ElencoFoto = JSON.stringify(esito);
									
				}
	});
}


function refreshFoto() {
	// http://localhost/airo/api/?method=elencofoto&format=json
	// http://localhost/airo/api/?method=layoutfoto&format=json
	var urlOpzioni=  '../api/?method=layoutfoto&format=json';
	
	var conta = 1;
	$.getJSON(urlOpzioni, function(data) {
		/// Inizio --> Scelta del layout. 
		// il servizio restituisce tutti i layout disponibili. Qui ne viene scelto solo uno da presentare
		// Le "Posizioni" sono le coordinate delle foto da collocare in pagina
		
		// n. Layout disponibili
		var opzioni = data.data.layout.length;
		
		// selezione casuale del layout 
		var scelto = Math.floor((Math.random() * opzioni));

		// Viene creato l'elenco delle posizioni da collocare
		var Posizioni = data.data.layout[scelto].foto;

		/// Fine --> Scelta del lauyout

		
		
		/// Inizio --> Scelta delle foto da esporre.
		//  Vengono recuperate le foto disponibili dalla sessione (c'è una funzione che ne carica in continuo). 
		
		var ElencoFoto= [];
		
		if(sessionStorage.ElencoFoto)
		{	
			ElencoFoto = JSON.parse(sessionStorage.ElencoFoto);
		}

		// Se le foto disponibili non bastano per riempire i layout, la funzione termna: ne verranno accodate altre più tardi.
		if (ElencoFoto.length < Posizioni.length) {
				console.log('Non ci sono abbastanza foto nel buffer');
				return;
		}
		
		var FotoPronte = [];
		// vengono prelevate le foto necessarie
		for (x=0; x < Posizioni.length; x++) {
			FotoPronte.push(ElencoFoto.shift());	
		}
		// il buffer viene aggiornato
		sessionStorage.ElencoFoto = JSON.stringify(ElencoFoto);

		// Eliminazione vecchie foto
		$(".myItem").remove();
		
		/// aggiunta delle nuove foto (invisibili)
		$.each(Posizioni, function(key, layout) {

			// Qui bisogna avere le immagini
//			console.log(layout.top);

			$("#theDiv").append("<img  id='image" + key + "' class='myItem'  src='" + FotoPronte[key] + "' style='display: none;'/>");

			var info = JSON.parse(JSON.stringify(layout));
			$('#image' + key ).css(info);
						
			
		});

		/// ingresso con fading.
		$(".myItem").fadeIn(2000)		
	});


}
// refreshFoto();	

var accoda = setInterval(function(){ 
	$(".myItem").fadeOut(1500, "swing", function(){
		
		refreshFoto();	
		});

	$(".myItem").fadeIn(2000);
	
 }, 6000);


var preload = setInterval(function(){ 
	
	var elencoFoto = [];
	

	if(sessionStorage.ElencoFoto)
	{	
		elencoFoto = JSON.parse(sessionStorage.ElencoFoto);
	}

	if (elencoFoto.length < 10) {
		preloadFoto();
	}
	
	
	
 }, 1000);


function refreshFotoOLD() {
	// http://localhost/airo/api/?method=elencofoto&format=json
	// http://localhost/airo/api/?method=layoutfoto&format=json
	var urlOpzioni=  '../api/?method=layoutfoto&format=json';
	
	var conta = 1;
	$.getJSON(urlOpzioni, function(data) {
		
		var opzioni = data.data.layout.length;
		var scelto = Math.floor((Math.random() * opzioni));

		var Posizioni = data.data.layout[scelto].foto;

		var ElencoFoto= [];
		
		if(sessionStorage.ElencoFoto)
		{	
			ElencoFoto = JSON.parse(sessionStorage.ElencoFoto);
		}
		//var ElencoFoto = getElencoFoto();
		//if (ElencoFoto.length == 0) {
		//	return ;
		//	}
		while (ElencoFoto.length < Posizioni.length) {

				var bufferFoto = getElencoFoto();

				if (bufferFoto.length == 0)
					return;
				
				ElencoFoto = ElencoFoto.concat(bufferFoto);
				
				console.log(ElencoFoto.length);
			}
		var FotoPronte = [];

		for (x=0; x < Posizioni.length; x++) {
			FotoPronte.push(ElencoFoto.shift());	
		}
		$(".myItem").remove();
		sessionStorage.ElencoFoto = JSON.stringify(ElencoFoto);
		var y= 0;
		$.each(Posizioni, function(key, layout) {

			// Qui bisogna avere le immagini
//			console.log(layout.top);

			$("#theDiv").append("<img  id='image" + y + "' class='myItem'  src='../immagini/fotolibere/" + FotoPronte[y] + "' style='display: none;'/>");
			//var json = '{ "display": "none" }';
			//var cssObject = JSON.parse(json);
			
			var info = JSON.parse(JSON.stringify(layout));
			 $('#image' + y ).css(info);
			//$("#theDiv").append("<img class='myItem'  src='../immagini/fotolibere/" + FotoPronte[y] + "' style='top: " + layout.top +"; left: " + layout.left + "; width: " + layout.width + "; height: " + layout.height + "; display: none;'/>");
			y++;
			
			
			
			//$("#theDiv").append("<img  id='imageGFF'  class='myItem'  src='../immagini/fotolibere/" + FotoPronte[0] + "'/>");
			
			
			
			
		});




				
	});


}

	

</script>
</body>
</html>