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

?>
