<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Aironi Consolle</title>
<link href="stile.css" rel="stylesheet" type="text/css">
<link href="stilePiazzole.css" rel="stylesheet" type="text/css">
<script src="js/jQuery.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body leftmargin="2" topmargin="0" marginwidth="0" marginheight="0">

	<script type="text/javascript">
// alert(decodeClasse('CAM'));
function decodeClasses(idClasse) {
	// Questa funzione decodifica l'id classe e restituisce la relativa descrizione
	var url=  'api/?method=classi&format=json&cla=' + idClasse;
	$.getJSON(url, function(data) {
		$.each(data.data, function(key, val) {alert(val.DescrizioneClasse);});
	});
	

}  

//Questa funzione chiama l'api che decodifica l'id di una classe e restituisce la relativa descrizione
function decodeClasse(idClasse) {
	var esito="";
	try {
		var url=  'api/?method=classi&format=json&cla=' + idClasse;

		var data = loadJSON(url);
		if (data.data.length > 0){
			return data.data[0].DescrizioneClasse;
		}
		else
			return null;
		
		
	}
	catch (exception) {
		
		// return "ciao";
	}

	return 'zio ' + esito;
}  



//Load JSON text from server hosted file and return JSON parsed object
function loadJSON(filePath) {
  // Load json file;
  var json = loadTextFileAjaxSync(filePath, "application/json");
  // Parse json
  return JSON.parse(json);
}   

// Load text with Ajax synchronously: takes path to file and optional MIME type
function loadTextFileAjaxSync(filePath, mimeType)
{
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.open("GET",filePath,false);
  if (mimeType != null) {
    if (xmlhttp.overrideMimeType) {
      xmlhttp.overrideMimeType(mimeType);
    }
  }
  xmlhttp.send();
  if (xmlhttp.status==200)
  {
    return xmlhttp.responseText;
  }
  else {
    // TODO Throw exception
    return null;
  }
}


</script>

<?php

// var myUrl= 'http://localhost/airo/api/?method=piazzole&format=json&min=' + piazzola + '&max=' + piazzola;
ini_set ( 'user_agent', "PHP" ); // github requires this
$api = 'http://localhost';
$url = $api . '/airo/api/?method=piazzole&format=json&min=5&max=5';
// make the request
$response = file_get_contents ( $url );
// check we got something back before decoding
if (false !== $response) {
	$gists = json_decode ( $response, true );
} // otherwise something went wrong

echo "Ci sono " . count ( $gists ["data"] ) . " elementi. <br>";
/*
 * foreach ($gists["data"] as &$Arcieri) {
 * // echo "ciao $value<br>"; //$value . "<br>";
 * //echo is_array($value);
 * echo "------------------------------------------------<br>";
 * foreach ($Arcieri as $key=>$Value) {
 * echo "il valore di $key è $Value<br>";
 * }
 * //echo $gists;
 * //json_decode($json)
 * }
 * echo min($gists);
 */
// echo sizeof($gists[1]);
?>
	<table id="ciccio"
		style="border: 1px; border-style: dashed; border-color: red; visibility: hidden;">
		<tbody>
			<tr>
				<td id='gff'>1</td>
				<td>1</td>
				<td>1</td>
				<td>1</td>
			</tr>
			<tr class="pari">
				<td>2</td>
				<td>2</td>
				<td>2</td>
				<td>2</td>
			</tr>
			<tr>
				<td>3</td>
				<td>3</td>
				<td>3</td>
				<td>3</td>
			</tr>
			<tr class="pari">
				<td>4</td>
				<td>4</td>
				<td>4</td>
				<td>4</td>
			</tr>
			<tr>
				<td>5</td>
				<td>5</td>
				<td>5</td>
				<td>5</td>
			</tr>
		</tbody>
	</table>

	<script type="text/javascript">
$('#ciccio').css('background-color', 'red');
$('#ciccio').hide();
$('#ciccio').css('visibility', 'visible');
$('#ciccio').fadeIn(1000, function(){

	$('#ciccio tr.pari').css('background-color', 'orange');

	$('#ciccio').fadeOut(500, function(){
		$('#ciccio').fadeIn(500, function(){
			$('#ciccio tr.pari').remove();
			
		});	
		
	});
		
});



arrCompagnie="";

var terminatore = "'finecomp'";

var url = 'api/?method=compagnie&format=json';
$.getJSON(url, function(data) {

	$.each(data.data, function(key, val) {
		arrCompagnie += "'" + val.Compagnia + "',";
	});
	
	arrCompagnie += terminatore;
	console.log(arrCompagnie);

});



// var setConsegna = function(piazzola) {
// 	var url = 'api/?method=score&format=json&piazzola=' + piazzola;
// 	$.getJSON(url, function(data) {
// 		var myCss = '';
// 		if (data.data.numcons) {
// 			myCss = 'aa';
// 		} else {
// 			myCss = 'b';
// 		}

// 		$('#fldCons' + piazzola).addClass(myCss);
// 	});
// }

// consegnato.setConsegna();
// document.write('ciao -->' + consegnato.valore);


</script>
</body>
</html>
