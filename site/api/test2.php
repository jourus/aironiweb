<?php header('Content-type: text/html; charset=utf-8');
?>

<html>
<head>
<title>Pagina di esperimenti 2</title>
<script src="../js/jquery.js"></script>
</head>
<body>
<?php 
class ExifData {
	public $FileName;
	public $Name;
	private $exifData;
	
	public $DataScatto;
	public $DataModifica;
	public $Dimensioni;
	public $DescDimensioni;
	public $Apertura;
	public function __construct($filename) 
	{
			if (file_exists($filename)) {
				
				$this->FileName = $filename;
				$this->exifData = exif_read_data($filename, 0, true);
				
				if (array_key_exists('FILE',$this->exifData)) {
					
					// $Nome
					if (array_key_exists('FileName',$this->exifData['FILE']))
					{
						$this->Name = $this->exifData['FILE']['FileName'];
						
					}
					
					// $Dimensioni
					if (array_key_exists('FileSize',$this->exifData['FILE'])) 
						{
							$this->Dimensioni = $this->exifData['FILE']['FileSize'];
							$this->DescDimensioni = $this->SizeName($this->Dimensioni);
					}	
					
					// $DataModifica
					if (array_key_exists('FileDateTime',$this->exifData['FILE']))
					{
						//$lastMod = date_format($lastMod,"D/mm/Y");
						date_default_timezone_set('Europe/Rome');
						
						$lastMod = date("Y:m:d H:i:s", $this->exifData['FILE']['FileDateTime']);
						
						$this->DataModifica = $lastMod;
					}
				}
				
				if (array_key_exists('EXIF',$this->exifData)) {
						
					// $DataScatto
					if (array_key_exists('DateTimeOriginal',$this->exifData['EXIF']))
					{$this->DataScatto = $this->exifData['EXIF']['DateTimeOriginal'];}
						
					// $Apertura
					if (array_key_exists('ApertureValue',$this->exifData['EXIF']))
					{$this->Apertura = $this->exifData['EXIF']['ApertureValue'];}
				}
				
			}
	}
	private function SizeName($dimensioni){

		$sizeRange = floor(log($dimensioni,10) / 3);
	//	$message = "<br/>Il SizeRange è $sizeRange. Il file invece è di $size bytes.<br/>";
		$possibleDesc = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		
		if ($sizeRange < 0) {$sizeRange = 0;}
		if ($sizeRange > 4) {$sizeRange = 4;}
		$descSize = round($dimensioni / pow(10, $sizeRange), 2) . " " . $possibleDesc[$sizeRange];
		return $descSize;
	}
	
}



include_once 'PiazzoleService.php';
include_once 'config.php';

echo "Ci siamo<br/>";
$percorso = AIRO_FS_FOLDER_FOTO_PODIO . "04GROA_23.jpg";




$exdata = new ExifData($percorso);
echo "ciao $exdata->name<br/>";






if (file_exists($percorso)) {
	echo "<br/>Il file $percorso esiste";
	$size = filesize($percorso);
	$lastMod = filemtime($percorso);
	$type = exif_read_data($percorso);
	
	
	$sizeRange = floor(log($size,10) / 3);
	$message = "<br/>Il SizeRange è $sizeRange. Il file invece è di $size bytes.<br/>";
	
	echo $message;
	switch ($sizeRange) {
		// Byte
		case 0:
			$valore = $size;
			$descSize = "$valore Bytes";
			break;
		// KByte
		case 1:
			$valore = round($size / 1000, 2);
			$descSize = "$valore KB";
			break;
		// MByte
		case 2:
			$valore = round($size / 1000000, 2);
			$descSize = "$valore MB"; 
			break;
	
		// GByte
		default:
			$valore = round($size / 1000000000, 2);
			$descSize = "$valore GB"; 
		break;
	} ($sizeRange);
	
	echo "<br/>Le dimensioni 'varnished' del file sono $descSize.";
	
	//$lastMod = date_format($lastMod,"D/mm/Y");
	date_default_timezone_set('Europe/Rome');
	
	$lastMod = date("d-m-Y H:i:s", $lastMod);
	
	
	echo "<br/>L'ultima modifica al file è stata il $lastMod.<br/><br/><br/>";

	$exif = exif_read_data($percorso, 0, true);
	foreach ($exif as $key => $section) {
		echo "Inizio sezione $key:<br/>";
		foreach ($section as $name => $val) {
			echo " -> $name: $val<br />\n";
		}
	}
	
	
	
	
	echo "<br/><br/><br/>";
	
	$customSection = 'UndefinedTag:0xA432';
	$source = $exif['EXIF']["$customSection"];
	foreach ($source as $customKey =>$customValue) {
		echo " - $customKey: $customValue<br />\n";
	}
	
	
	$valore1 = $exif['EXIF']['DateTimeOriginal'];
	echo "Data: $valore1";
	
	for ($x = 0; $x < count($type); $x++)
	{
		$valore = $type[$x];
		echo "<br/>Dati EXIF: $valore - $x.";
	}
	
}
else {
	echo "<br/>Il file $percorso non esiste";
}
		// http://airolandia/airo/immagini/foto/04GROA_23.jpg

?>

</body>
</html>