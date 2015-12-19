<?php
include 'PiazzoleService.php';
/*
 * API Demo
 *
 * This script provides a RESTful API interface for a web application
 *
 * Input:
 *
 * $_GET['format'] = [ json | html | xml ]
 * $_GET['method'] = []
 *
 * Output: A formatted HTTP response
 *
 * Author: Mark Roland
 *
 * History:
 * 11/13/2012 - Created
 *
 */

// --- Step 1: Initialize variables and functions

/**
 * Deliver HTTP Response
 * 
 * @param string $format
 *        	The desired HTTP response content type: [json, html, xml]
 * @param string $api_response
 *        	The desired HTTP response data
 * @return void
 *
 */
function deliver_response($format, $api_response) {
	
	// Define HTTP responses
	$http_response_code = array (
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			403 => 'Forbidden',
			404 => 'Not Found' 
	);
	
	// Set HTTP Response
	header ( 'HTTP/1.1 ' . $api_response ['status'] . ' ' . $http_response_code [$api_response ['status']] );
	
	// Process different content types
	if (strcasecmp ( $format, 'json' ) == 0) {
		
		// Set HTTP Response Content Type
		header ( 'Content-Type: application/json; charset=utf-8' );
		
		// Format data into a JSON response
		$json_response = json_encode ( $api_response );
		
		// Deliver formatted data
		echo $json_response;
	} elseif (strcasecmp ( $format, 'xml' ) == 0) {
		
		// Set HTTP Response Content Type
		header ( 'Content-Type: application/xml; charset=utf-8' );
		
		// Format data into an XML response (This is only good at handling string data, not arrays)
		$xml_response = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<response>' . "\n" . "\t" . '<code>' . $api_response ['code'] . '</code>' . "\n" . "\t" . '<data>' . $api_response ['data'] . '</data>' . "\n" . '</response>';
		
		// Deliver formatted data
		echo $xml_response;
	} else {
		
		// Set HTTP Response Content Type (This is only good at handling string data, not arrays)
		header ( 'Content-Type: text/html; charset=utf-8' );
		
		// Deliver formatted data
		echo $api_response ['data'];
	}
	
	// End script process
	exit ();
}

// Define whether an HTTPS connection is required
$HTTPS_required = FALSE;

// Define whether user authentication is required
$authentication_required = FALSE;

// Define API response codes and their related HTTP response
$api_response_code = array (
		0 => array (
				'HTTP Response' => 400,
				'Message' => 'Unknown Error' 
		),
		1 => array (
				'HTTP Response' => 200,
				'Message' => 'Success' 
		),
		2 => array (
				'HTTP Response' => 403,
				'Message' => 'HTTPS Required' 
		),
		3 => array (
				'HTTP Response' => 401,
				'Message' => 'Authentication Required' 
		),
		4 => array (
				'HTTP Response' => 401,
				'Message' => 'Authentication Failed' 
		),
		5 => array (
				'HTTP Response' => 404,
				'Message' => 'Invalid Request' 
		),
		6 => array (
				'HTTP Response' => 400,
				'Message' => 'Invalid Response Format' 
		) 
);

// Set default HTTP response of 'ok'
$response ['code'] = 0;
$response ['status'] = 404;
$response ['data'] = NULL;

// --- Step 2: Authorization

// Optionally require connections to be made via HTTPS
if ($HTTPS_required && $_SERVER ['HTTPS'] != 'on') {
	$response ['code'] = 2;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = $api_response_code [$response ['code']] ['Message'];
	
	// Return Response to browser. This will exit the script.
	deliver_response ( $_GET ['format'], $response );
}

// Optionally require user authentication
if ($authentication_required) {
	
	if (empty ( $_POST ['username'] ) || empty ( $_POST ['password'] )) {
		$response ['code'] = 3;
		$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
		$response ['data'] = $api_response_code [$response ['code']] ['Message'];
		
		// Return Response to browser
		deliver_response ( $_GET ['format'], $response );
	}	

	// Return an error response if user fails authentication. This is a very simplistic example
	// that should be modified for security in a production environment
	elseif ($_POST ['username'] != 'foo' && $_POST ['password'] != 'bar') {
		$response ['code'] = 4;
		$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
		$response ['data'] = $api_response_code [$response ['code']] ['Message'];
		
		// Return Response to browser
		deliver_response ( $_GET ['format'], $response );
	}
}

// --- Step 3: Process Request

// Getting parameters...
if (isset ( $_GET ['method'] ))
	$apiMethod = $_GET ['method'];
else
	$apiMethod = "";
	
	// Default format is json
if (isset ( $_GET ['format'] ))
	$apiFormat = $_GET ['format'];
else
	$apiFormat = "json";
	
	// Method A: Say Hello to the API
if (strcasecmp ( $apiMethod, 'hello' ) == 0) {
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = 'Hello World';
}

// Method b: piazzole
if (strcasecmp ( $apiMethod, 'piazzole' ) == 0) {
	
	if (isset ( $_GET ['min'] )) {
		$piazzolaDa = $_GET ['min'];
	} else
		$piazzolaDa = 0;
	
	if (isset ( $_GET ['max'] )) {
		$piazzolaA = $_GET ['max'];
	} else {
		$piazzolaA = 99;
	}
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getPiazzole ( $piazzolaDa, $piazzolaA );
}

// Method c: categorie
if (strcasecmp ( $apiMethod, 'categorie' ) == 0) {
	
	if (isset ( $_GET ['cat'] )) {
		$idCategoria = $_GET ['cat'];
	} else {
		$idCategoria = null;
	}
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getCategorie ( $idCategoria );
}

// Method d: classi
if (strcasecmp ( $apiMethod, 'classi' ) == 0) {
	
	if (isset ( $_GET ['cla'] )) {
		$idClasse = $_GET ['cla'];
	} else {
		$idClasse = null;
	}
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getClassi ( $idClasse );
}

// Method e: un podio per classe / categoria
if (strcasecmp ( $apiMethod, 'podio' ) == 0) {
	
	if (isset ( $_GET ['cla'] )) {
		$idClasse = $_GET ['cla'];
	} else {
		$idClasse = null;
	}
	
	if (isset ( $_GET ['cat'] )) {
		$idCategoria = $_GET ['cat'];
	} else {
		$idCategoria = null;
	}
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getPodio ( $idClasse, $idCategoria );
}

// Method f: Informazioni sulla gara (Tipo, data, località ecc.)
if (strcasecmp ( $apiMethod, 'infogara' ) == 0) {
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getInformazioniGara ();
}

// Method g: classifica per classe / categoria
if (strcasecmp ( $apiMethod, 'classifica' ) == 0) {
	
	if (isset ( $_GET ['cla'] )) {
		$idClasse = $_GET ['cla'];
	} else {
		$idClasse = null;
	}
	
	if (isset ( $_GET ['cat'] )) {
		$idCategoria = $_GET ['cat'];
	} else {
		$idCategoria = null;
	}
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getClassifica ( $idClasse, $idCategoria );
}

// Method h: Verifica Score Consegnati
if (strcasecmp ( $apiMethod, 'score' ) == 0) {
	
	if (isset ( $_GET ['piazzola'] )) {
		$piazzola = $_GET ['piazzola'];
		if (! is_numeric ( $piazzola ))
			$piazzola = 0;
	} else
		$piazzola = 0;
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getScoreConsegnato ( $piazzola );
}

// Method i: classifica per compagnia
if (strcasecmp ( $apiMethod, 'classificacomp' ) == 0) {
	
	if (isset ( $_GET ['compagnia'] )) {
		$compagnia = $_GET ['compagnia'];
	} else {
		$compagnia = null;
	}
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getClassificaCompagnia ( $compagnia );
}

// Method h: Layout Foto
if (strcasecmp ( $apiMethod, 'layoutfoto' ) == 0) {
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getLayoutFoto ();
}

// Method i: Elenco Foto per Autofoto
if (strcasecmp ( $apiMethod, 'elencofoto' ) == 0) {
	
	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getElencoFotoLibere ();
}

// Method j: Elenco combinazioni di classi e categorie
if (strcasecmp ( $apiMethod, 'classicat' ) == 0) {

	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getClassiCategorie ();
}


// Method k: Elenco combinazioni di classi e categorie
if (strcasecmp ( $apiMethod, 'compagnie' ) == 0) {

	$response ['code'] = 1;
	$response ['status'] = $api_response_code [$response ['code']] ['HTTP Response'];
	$response ['data'] = getCompagnie();
}





// --- Step 4: Deliver Response

// Return Response to browser
deliver_response ( $apiFormat, $response );

?>
			