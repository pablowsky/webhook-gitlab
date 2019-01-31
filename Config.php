<?php
// Configuracion de servidores
$srv_desa 		= new Server('', '', '');
$srv_prod 		= new Server('', '', ''); // hots, user, pass
$srv_preprod 	= new Server('', '', '');

// Obtencion de parametros de consulta
$_MIHEAD 		= apache_request_headers();
$id 			= $_GET['id'];
$branch 		= $_GET['branch'];
$req_token		= $_MIHEAD['X-Gitlab-Token']; // Deberia validar esto
$tokenApp 		= ''; // Token de acceso gitlab

// Obtengo el archivo de configuracion wh_config.ini
$apiF 	= new api($id, $tokenApp);
$temp_file 	= tempnam(sys_get_temp_dir(), 'BV_WebHook');
$raw 		= $apiF->getDownload('bv_webhook.ini', $branch);
file_put_contents($temp_file, $raw);

$_ini = parse_ini_file($temp_file);
try {
	if (($_ini = @parse_ini_file($temp_file, true)) == false)
		throw new Exception('Missing INI file: ' . $temp_file);
}catch (Exception $e) {
	die($e->getMessage());
}

// Obtengo los parametros faltantes desde wh_config.ini
$base 		= $_ini['base'];
$server		= $_ini['server'];
$token		= $_ini['token'];
?>