<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Piazzole</title>
<META http-equiv="Page-exit"
	CONTENT="RevealTrans(Duration=1,Transition=10)">
<!-- <link href="stile.css" rel="stylesheet" type="text/css"> -->

<link href="stilePiazzole.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
	<h1 id="titoloPiazzole">Piazzole</h1>
	<div id="bigContainer">
<?php
require 'config.php';

for($snipet = 1; $snipet <= 6; $snipet ++) {
	
	echo "<div id='divtabpiazzola$snipet' class='divPiazzole'> <table id='tabpiazzola$snipet' class='tblPiazzole'>
		<thead><tr><td><h2 id='titolotabpiazzola$snipet'>Piazzola $snipet</h2></td></tr></thead>
		<tbody></tbody></table></div>";
	

}

?>
</div>

	<script type="text/javascript">
	sessionStorage.ContatorePiazzola = 0;
	refreshPiazzole();
	
	setInterval(function(){ 
		refreshPiazzole()
	//	var Valore = "Il nuovo valore è: " + String(sessionStorage.ContatorePiazzola);
	//	$("#myTimer").text(Valore);
	 }, <?php echo AIRO_DURATA_CICLO_PIAZZOLE ?>);

function refreshPiazzole() {
	if (sessionStorage.ContatorePiazzola)
		sessionStorage.ContatorePiazzola = Number(sessionStorage.ContatorePiazzola) + 1;
	else
		sessionStorage.ContatorePiazzola = 1;

	if (sessionStorage.ContatorePiazzola >4)
		sessionStorage.ContatorePiazzola = 1;

	var offset = (sessionStorage.ContatorePiazzola - 1) * 6;
	for (x=1; x<=6; x++)
	{
		setPiazzola(x + offset, 'tabpiazzola' + String(x), 'divtabpiazzola' + String(x));
	}

	
}


function toTitleCase(str)
{
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function setPiazzola(piazzola, tabella, div) {
	// Servizio Web che eroga il dato
	// var url=  'http://localhost/airo/piazzoleservice.php?min=' + piazzola + '&max=' + piazzola;
	var url=  'api/?method=piazzole&format=json&min=' + piazzola + '&max=' + piazzola;
	var elemento = '#' + tabella;

	// Eliminazione righe pregresse
	//$(elemento + ' thead').hide(2000);
	$('#' + div).fadeOut(1500, function() { 

		$(elemento  + ' tbody tr').remove(); 
		
		$.getJSON(url, function(data) {
			$.each(data.data, function(key, val) {
				// $(elemento).append('<tr><td>' + val.Posizione + '</td><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				$(elemento).append('<tr><td>' + toTitleCase(val.Nome) + ' ' + toTitleCase(val.Cognome) + '</td></tr>');
				 
				});

		$('#titolo' + tabella).text('Piazzola ' + piazzola);
					
		
		$('#' + div).fadeIn(2000);	
		});
	});

}  

function testWS() {
/*
	jQuery.ajax({
	    type: "GET",
	    url: "http://localhost/airo/piazzoleservice.php?min=1&max=1",
	    dataType: "json",
	    success:  function (data, status, jqXHR) {
            // do something
           $.each(data, function(key, val) {
				$('#tblCiao tbody').append('<tr><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				 
				})
        },
    
        error: function (jqXHR, status) {
            // error handler
			alert("non va! :-/ ");
       	}
	});
	*/
	var url=  "http://localhost/airo/piazzoleservice.php?min=1&max=1";
	$('#tblCiao tbody').hide(3000, function() {
	$.getJSON(url, function(data) {
			$.each(data, function(key, val) {
				$('#tblCiao tbody').append('<tr><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				 
				})

		});});
	$('#tblCiao tbody').show(3000);

}


</script>


</body>
</html>
