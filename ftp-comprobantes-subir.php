<?php

if (isset($_POST['btnSubir'])) {
	
	// se obtiene un token
	require 'includes/config.inc.php';

	// se establece conexión con el FTP
	$ftp_con = ftp_connect($conf['ftpHost'], $conf['ftpPort']);
	$ftp_log = ftp_login($ftp_con, $conf['ftpUser'], $conf['ftpPass']); 
	
	if (!$ftp_con || !$ftp_log) {
		echo '<pre>Error de acceso al FTP</pre>';
		exit();
	}
	
	// se recorren los archivos para su upload
	$archivos = json_decode($_POST['txtArchivos']);
	
	foreach ($archivos->archivos as $archivo) {
		
		if (!file_exists($archivo)) {
			echo '<pre>El archivo ' . $archivo . ' no existe</pre>';
			ftp_close($ftp_con);
			exit();
		}
		
		$destino = $conf['ftpFolder'] . substr($archivo, strrpos($archivo, "/") + 1);
		$upload = ftp_put($ftp_con, $destino, $archivo, FTP_BINARY);
		
		if (!$upload) {
			echo '<pre>Error subiendo el archivo ' . $archivo . '</pre>';
			ftp_close($ftp_con);
			exit();
		}
	
	}
	
	// se cierra la conexión del ftp
	ftp_close($ftp_con);
	
	echo '<pre>Proceso terminado</pre>';
	exit();
	
}

?>
<!DOCTYPE HTML>
<html lang="es-AR">
<head>
	<meta charset="UTF-8">
	<title>FTP: Subir Comprobantes</title>
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
</head>
<body class="bg">
	
	<h2 class="titulo">Ejemplo de como subir comprobantes (archivos) al FTP:</h2>
	
	<form action="ftp-comprobantes-subir.php" method="post">
		
		<label for="txtArchivos">Archivos</label>
		<textarea name="txtArchivos" id="txtArchivos" cols="90" rows="20"><?= json_encode(array(
			'archivos' => array(
				'C:/FA0001-0001236.pdf',
				'C:/FE0001-0000001.pdf'
			)
		), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)?></textarea><br />
		<input type="submit" name="btnSubir" value="Subir al FTP" />
	</form>
	
	<a class="back" href="index.php"><i class="fa fa-backward"></i>Volver Atras</a>
	
</body>
</html>