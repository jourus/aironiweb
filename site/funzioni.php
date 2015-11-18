<?php
//restituisce i primi $len caratteri di $str
function left($str,$len){
	return substr($str, 0, $len);
}


//restituisce gli ultimi $len caratteri di $str
function right($str,$len){
	$len=$len*-1;
	return substr($str, $len);
}



// sostituisce gli apici singoli con coppie di apici singoli
function apiciaposto($valore)
{
	return str_replace("'", "''", $valore);
	 
	//	$bodytag = str_replace("%body%", "black", "<body text='%body%'>");

}


function tableRow($properties, $fields) {

	$row = "<tr" . $properties . ">";
	$tdOpen = "<td>";
	$tdClose = "</td>";
	foreach ($fields as $field) {
		$row .= $tdOpen . $field . $tdClose;
			
	}
	$row .= "</tr>";
	return $row;

}

class gridClassifica
{
	public $Iscritto;
	public $Classe;
	public $Categoria;
	public $Punti;
	public $Spot;
	public $Super;


}


?>
