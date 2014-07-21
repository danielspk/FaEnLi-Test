<?php
		
if (isset($_POST['btnRegistrar'])) {
	
	header('Content-Type: text/html; charset=utf-8');
	
	// se obtiene un token
	require 'includes/get-token.inc.php';
	
	// se decodifica el token obtenido
	$token = json_decode($jsonToken);

	// se registran los comprobantes solicitados
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $conf['urlAPI'] . 'api/comprobantes/registrar');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, 
		'token=' . $token->token . '&user=' . $conf['apiUser'] . '&pass=' . $conf['apiPass'] . 
		'&comprobantes=' . str_replace("\n", '', $_POST['txtComprobantes'])
	);
	$jsonRespuesta = curl_exec($curl);
	curl_close($curl);

	// se decodifica y vuelve a codificar con formato para su mejor 
	// visualización dentro del ejemplo
	echo '<pre>';
	echo json_encode(json_decode($jsonRespuesta), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	echo '</pre>';

	exit();
	
}

?>
<!DOCTYPE HTML>
<html lang="es-AR">
<head>
	<meta charset="UTF-8">
	<title>API: Registrar Comprobantes</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
</head>
<body class="bg">
	
	<h2 class="titulo">Ejemplo de como registrar comprobantes:</h2>
	
	<form action="api-comprobantes-registrar.php" method="post">
		
		<label for="txtComprobantes">Comprobantes:</label>
		<textarea name="txtComprobantes" id="txtComprobantes" cols="90" rows="30"><?= json_encode(array(
			'comprobantes' => array(
				array(
					'tipo' => 'Factura A',
					'ptoventa' => 1,
					'numero' => 1236,
					'fecha' => '2014-01-01',
					'moneda' => 'AR',
					'importe' => 1234.6700,
					'archivo' => 'FA0001-0001236',
					'usuarios' => array(
						'daniel.spiridione@gmail.com',
						'pepeargento@gmail.com'
					)
				),
				array(
					'tipo' => 'Factura E',
					'ptoventa' => 1,
					'numero' => 1,
					'fecha' => '2014-03-13',
					'moneda' => 'DOL',
					'importe' => 345.0500,
					'archivo' => 'FE0001-0000001',
					'usuarios' => array(
						'jose.fernandez@yahoo.com.es'
					)
				)
			)
		), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)?></textarea><br />
		<input type="submit" name="btnRegistrar" value="Registrar Comprobantes" />
	</form>
	
	<a class="back" href="index.php"><i class="fa fa-backward"></i>Volver Atras</a>
	
</body>
</html>