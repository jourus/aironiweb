<?php 
//require_once 'PiazzoleService.php';


//echo json_decode(getLayoutFoto());



?>

<html>

<head>
<title>Pagina di esperimenti</title>
<script src="../js/jquery.js"></script>
<style type="text/css">

.myItem{
	border: 2px dashed red;
	background-color: yellow;
	position: relative;
}

</style>
</head>
<body>
<p style="border: 2px solid red;">
Ciao anche da qui
</p>
<div id="theDiv" style="width: 800px; height: 600px;border: 2px solid orange; "></div>
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

function refreshFoto() {
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

			$("#theDiv").append("<img class='myItem'  src='../immagini/fotolibere/" + FotoPronte[y] + "' style='top: " + layout.top +"; left: " + layout.left + "; width: " + layout.width + "; height: " + layout.height + "; display: none;'/>");
			y++;		
		});




		$(".myItem").fadeIn(2000)		
	});


}
refreshFoto();	

setInterval(function(){ 
	$(".myItem").fadeOut(1500, "swing", function(){
		
		refreshFoto();	
		});

	
	
 }, 6000);



	

</script>
</body>
</html>