<?php header('Content-type: text/html; charset=utf-8');

/*
if( ( !empty( $_FILES["my_file"] ) ) && ( $_FILES['my_file']['error'] == 0 ) ) {
 
    if( preg_match( '/^(image\/)(gif|(x-)?png|p?jpeg)$/i', $_FILES['my_file']['type'] ) && ($_FILES["my_file"]["size"] < 2097152) ){
 
        $path = '/immagini/fotononassociate/' . basename( $_FILES['my_file']['name'] );
 		echo "<br/><br/>Il file da scrivere è $path<br/><br/>";
        if( move_uploaded_file($_FILES['my_file']['tmp_name'], $path) ){
            print_r( $_FILES['my_file'] ); // File salvato correttamente 
        }else{
            print "Impossibile salvare il file: " . $_FILES['my_file']['error'];
        }       
    }else{
        echo "errore nel tipo (" . $_FILES['my_file']['type'] . ") o nelle dimensioni (" . $_FILES["my_file"]["size"] . ")";
    }
 
}else{
    print_r( $_FILES['my_file'] );
}

*/



$upload_folder = 'foto';
if (!empty($_FILES)) {
	foreach ($_FILES['my_file'] as $myFile=>$ciao) {
		echo "Il nome del file $ciao è $myFile<br/>";
		// foreach ($ciao as $elenco=>$blocco){
		//	echo "->     L'array nidificato 'ciao' ha $blocco in $elenco<br/>";
		//}
	}
}
return 
/*
	$temp_file = $_FILES['my_file']['tmp_name'];
	$target_path = dirname( __FILE__ ) .  '/' . $upload_folder . '/';
	$target_file =  $target_path . $_FILES['my_file']['name'];
	echo "<br/><br/>Il file da scrivere è $temp_file<br/>";
	echo "Il file \$target_path è $target_path<br/>";
	echo "Il file \$target_file è $target_file<br/><br/>";

	if( file_exists( $target_path ) ) {
		move_uploaded_file($temp_file, $target_file);
		echo "Copia Riuscita!<br/><br/>";
	} else {
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		echo "Errore!!<br/><br/>";
	}
}
*/
?>