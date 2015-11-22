<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<title>Piazzole</title>
<META http-equiv="Page-exit" CONTENT="RevealTrans(Duration=1,Transition=10)">
<link href="stile.css" rel="stylesheet" type="text/css">
<link href="stilePiazzole.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body background="immagini/sfondo_classifica.png" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<input id='CaricaPiazzola1inTabella1' value='Carica Piazzola 1 in tabella 1' type="button" onclick="setPiazzola(1, 'tabpiazzola1');"/>
<input id='CaricaPiazzola2inTabella1' value='Carica Piazzola 2 in tabella 1' type="button" onclick="setPiazzola(2, 'tabpiazzola1');"/>

<?php 


for ($snipet = 1; $snipet < 6; $snipet++) {

	echo "<div id='divTable$snipet' class='divPiazzole'> <table id='tabpiazzola$snipet' class='tblPiazzole'>
		<thead><tr><td colspan=2><p id='titolotabpiazzola$snipet'>Piazzola $snipet</p></td></tr></thead>
		<tbody></tbody></table></div>";

}
?>


<div id="divTablex" class="divPiazzole">

<table id="tabpiazzolax" class="tblPiazzole">
	<thead>
		<tr>
			<td colspan=2><p id="titolotabpiazzolax">Piazzola 1</p></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td>
		</tr>
	</tbody>

</table>

</div>





<table id="tblCiao" width=400>
	<thead>
	<tr><td colspan=2> Ciaone! </td></tr>
	</thead>
	<tbody>
		<tr>
			<td>Ciao</td><td>Ciao</td>
		</tr>
	</tbody>
</table>
<input id='btnRefresh' value='Ciao' type="button"/>
<a href="http://jquery.com/">jQuery</a>
<script src="js/jquery.js"></script>
<script type="text/javascript">

// $('#btnRefresh').click(function() {alert('ciao');});
// $('#btnRefresh').click(function() {managetable();});


$('#btnRefresh').click(function() {testWS();});

//window.onload = managetable();

function setPiazzola(piazzola, tabella) {
	
	var url=  'http://localhost/airo/piazzoleservice.php?min=' + piazzola + '&max=' + piazzola;
	var elemento = '#' + tabella;

	// Eliminazione righe pregresse
	$(elemento + ' thead').hide(2000);
	$(elemento + ' tbody').hide(2000, function() { 

		$(elemento  + ' tbody tr').remove(); 
		
		$.getJSON(url, function(data) {
			$.each(data, function(key, val) {
				$(elemento).append('<tr><td>' + val.Cognome + '</td><td>' + val.Nome + '</td></tr>');
				 
				});

		$('#titolo' + tabella).value='Ciao CIao';
					
		$(elemento + ' thead').show(3000);
		$(elemento + ' tbody').show(3000);	
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

function managetable() {	 
	var myBody = '#tblCiao tbody';
	
	 $(myBody).append('<tr><td>Ciao2</td><td>Ciao2</td></tr>');
 	 $(myBody).hide(3000, function(){
	 	$('#tblCiao tbody tr').remove();
	 }); 
	 //$('#tblCiao tbody tr').remove();
	
	 $(myBody).show(3000, function() {
//		 $('#tblCiao').append('<tbody></tbody>');
		 $('#tblCiao tbody').append('<tr><td>Ciao3</td><td>Ciao2</td></tr>');
		 $('#tblCiao tbody').append('<tr><td>Ciao4</td><td>Ciao2</td></tr>');
		 $('#tblCiao tbody').append('<tr><td>Ciao5</td><td>Ciao2</td></tr>');
	 });
	// $('#tblCiao tbody').remove();
	 //$('#tblCiao tr').hide(3000);
	 
}

</script>


</body>
</html>
