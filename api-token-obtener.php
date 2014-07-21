<?php

if (isset($_POST['btnObtener'])) {

	header('Content-Type: text/html; charset=utf-8');
	
	// se obtiene un token
	require 'includes/get-token.inc.php';

	// se decodifica y vuelve a codificar con formato para su mejor 
	// visualización dentro del ejemplo
	echo '<pre>';
	echo json_encode(json_decode($jsonToken), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	echo '</pre>';
	
	exit();
	
}

?>
<!DOCTYPE HTML>
<html lang="es-AR">
<head>
	<meta charset="UTF-8">
	<title>API: Obtener Token Acceso</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
</head>
<body class="bg">
	
	<h2 class="titulo">Ejemplo de como obtener un token de acceso:</h2>
	
	<form action="api-token-obtener.php" method="post">
		<input type="submit" name="btnObtener" value="Obtener Token" />
	</form>
	
	<a class="back" href="index.php"><i class="fa fa-backward"></i>Volver Atras</a>
	
</body>
</html>