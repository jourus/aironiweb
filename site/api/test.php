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


	// http://localhost/airo/api/?method=elencofoto&format=json
	// http://localhost/airo/api/?method=layoutfoto&format=json
	var urlOpzioni=  '../api/?method=layoutfoto&format=json';
	
	var conta = 1;
	$.getJSON(urlOpzioni, function(data) {
		
		var opzioni = data.data.layout.length;
		var scelto = Math.floor((Math.random() * opzioni));

		var Posizioni = data.data.layout[scelto].foto;

		var ElencoFoto = getElencoFoto();
		if (ElencoFoto.length == 0) {
			return ;
			}
		
		while (ElencoFoto.length < Posizioni.length){

				ElencoFoto.concat(getElencoFoto());
			}
		
		
		$.each(Posizioni, function(key, layout) {

			// Qui bisogna avere le immagini
//			console.log(layout.top);

			$("#theDiv").append("<div class='myItem' style='top: " + layout.top +"; left: " + layout.left + "; width: " + layout.width + "; height: " + layout.height + "; visibility: hidden;'></div>");
;
		});
		$(".myItem").hide();
		$(".myItem").css('visibility', 'visible');
		
		$(".myItem").fadeIn(3000)		
	});



	



	

</script>
</body>
</html>