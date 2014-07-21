<?php
		
if (isset($_POST['btnConsultar'])) {
	
	header('Content-Type: text/html; charset=utf-8');
	
	// se obtiene un token
	require 'includes/get-token.inc.php';
	
	// se decodifica el token obtenido
	$token = json_decode($jsonToken);

	// se realiza la consulta de los usuarios registrados
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $conf['urlAPI'] . 'api/usuarios');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, 
		'token=' . $token->token . '&user=' . $conf['apiUser'] . '&pass=' . $conf['apiPass'] .
		'&usrNombre=' . $_POST['txtNombre'] . '&usrApellido=' . $_POST['txtApellido'] . 
		'&usrEmail=' . $_POST['txtEmail']
	);
	$jsonUsuarios = curl_exec($curl);
	curl_close($curl);

	// se decodifica y vuelve a codificar con formato para su mejor 
	// visualización dentro del ejemplo
	echo '<pre>';
	echo json_encode(json_decode($jsonUsuarios), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	echo '</pre>';

	exit();
	
}

?>
<!DOCTYPE HTML>
<html lang="es-AR">
<head>
	<meta charset="UTF-8">
	<title>API: Consultar Usuarios Registrados</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
</head>
<body class="bg">
	
	<h2 class="titulo">Ejemplo de como consultar los usuarios registrados:</h2>
	<h3 class="titulo">Utilice el símbolo % como comodin</h3>
	
	<form action="api-usuarios-consulta.php" method="post">
		<label for="txtNombre">Nombre: </label><input type="text" name="txtNombre" id="txtNombre" /><br />
		<label for="txtApellido">Apellido: </label><input type="text" name="txtApellido" id="txtApellido" /><br />
		<label for="txtEmail">Email: </label><input type="text" name="txtEmail" id="txtEmail" /><br />
		<input type="submit" name="btnConsultar" value="Consultar Usuarios" />
	</form>
	
	<a class="back" href="index.php"><i class="fa fa-backward"></i>Volver Atras</a>
	
</body>
</html>