<?php header('Content-type: text/html; charset=utf-8');
?>

<html>
<head>
<title>Pagina di esperimenti 2</title>
<script src="../js/jquery.js"></script>
</head>
<body>
<?php 

include_once 'PiazzoleService.php';
include_once 'config.php';

$percorso = AIRO_FS_FOLDER_FOTO_PODIO . "04GROA_23.jpg";

$g = new ExifData($percorso);


echo "Oggetto speciale ExifData<br/>";
// echo "FileName: $g->FileName<br/>";
echo "Nome: $g->Nome<br/>";

echo "Produttore: $g->Produttore<br/>";
echo "Modello: $g->Modello<br/>";
echo "Dimensioni: $g->Dimensioni<br/>";
echo "Desc Dimensioni: $g->DescDimensioni<br/>";
echo "Data Scatto: $g->DataScatto<br/>";
echo "Data Modifica: $g->DataModifica<br/>";
echo "Focale: $g->Focale<br/>";
echo "BilanciamentoBianco: $g->BilanciamentoBianco<br/>";

// $f = exif_read_data($percorso, 0, true);
$json = $g->serialize();
echo "<br/><br/><br/>$json";

 
 
 
?>

</body>
</html>