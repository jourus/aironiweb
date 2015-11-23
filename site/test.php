<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Aironi Consolle</title>
<link href="stile.css" rel="stylesheet" type="text/css">
<link href="stilePiazzole.css" rel="stylesheet" type="text/css">
<script src="js/jQuery.js"></script>
<script type="text/javascript">

function setPiazzola(piazzola, tabella) {
	// Servizio Web che eroga il dato
	// var url=  'http://localhost/airo/piazzoleservice.php?min=' + piazzola + '&max=' + piazzola;
	var myUrl=  'http://localhost/airo/api/?method=piazzole&format=json&min=' + piazzola + '&max=' + piazzola;
	var elemento = '#' + tabella;

	// Eliminazione righe pregresse
	$(elemento + ' thead').hide(2000);
	$(elemento + ' tbody').hide(2000, function() { 

		$(elemento  + ' tbody tr').remove(); 


		
		jQuery.ajax({
		    type: "GET",
		    url: myUrl,
		    dataType: "json",
		    success:  function (data, status, jqXHR) {
	            // do something
		    	$.each(data.data, function(key, val) {
					$(elemento).append('<tr><td>' + val.Posizione + '</td><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
					 
					});
		
					$('#titolo' + tabella).text('Piazzola ' + piazzola);
								
					$(elemento + ' thead').show(3000);
					$(elemento + ' tbody').show(3000);	
					
	        },
	    
	        error: function (jqXHR, status) {
	            // error handler
				alert("non va! :-/ ");
	       	}
		});
		
	});



		
	/*	$.getJSON(url, function(data) {
			$.each(data, function(key, val) {
				$(elemento).append('<tr><td>' + val.Posizione + '</td><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				 
				});

		$('#titolo' + tabella).text('Piazzola ' + piazzola);
					
		$(elemento + ' thead').show(3000);
		$(elemento + ' tbody').show(3000);	
		});
	});
		*/

	
	
}


</script> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body leftmargin="2" topmargin="0" marginwidth="0" marginheight="0" >
<?php 

for ($snipet = 1; $snipet <= 6; $snipet++) {

	echo "<div id='divTable$snipet' class='divPiazzole'> <table id='tabpiazzola$snipet' class='tblPiazzole'>
	<thead><tr><td colspan=3><label id='titolotabpiazzola$snipet'>Piazzola $snipet</label></td></tr></thead>
	<tbody></tbody></table></div>";

}
?>
  <input type="button" value="Ciao" onclick="setPiazzola(1, 'tabpiazzola1');" />

  
</body>
</html>
