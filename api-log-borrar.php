<?php
		
if (isset($_POST['btnBorrar'])) {
	
	header('Content-Type: text/html; charset=utf-8');
	
	// se obtiene un token
	require 'includes/get-token.inc.php';
	
	// se decodifica el token obtenido
	$token = json_decode($jsonToken);

	// se borra el log de errores
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $conf['urlAPI'] . 'api/logs/borrar');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS,'REST_METHOD=DELETE&token=' . $token->token . 
		'&user=' . $conf['apiUser'] . '&pass=' . $conf['apiPass']
	);
	$jsonErrores = curl_exec($curl);
	curl_close($curl);

	// se decodifica y vuelve a codificar con formato para su mejor 
	// visualización dentro del ejemplo
	echo '<pre>';
	echo json_encode(json_decode($jsonErrores), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	echo '</pre>';

	exit();
	
}

?>
<!DOCTYPE HTML>
<html lang="es-AR">
<head>
	<meta charset="UTF-8">
	<title>API: Borrar Log de Errores</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
</head>
<body class="bg">
	
	<h2 class="titulo">Ejemplo de como borrar el log de errores:</h2>
	
	<form action="api-log-borrar.php" method="post">
		<input type="submit" name="btnBorrar" value="Borrar Log" />
	</form>
	
	<a class="back" href="index.php"><i class="fa fa-backward"></i>Volver Atras</a>
	
</body>
</html>