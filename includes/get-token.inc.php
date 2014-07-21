<?php

	require __DIR__ . '/config.inc.php';
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $conf['urlAPI'] . 'api/token');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, 'user=' . $conf['tokenUser'] . '&pass=' . $conf['tokenPass']);
	$jsonToken = curl_exec($curl);
	curl_close($curl);
	
	$jsonToken;