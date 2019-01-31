<?php
ini_set('max_execution_time', 600);
require_once 'Ftp.php';
require_once 'api.php';
require_once 'Repository.php';
require_once 'Upload.php';
require_once 'Server.php';
require_once 'Config.php';

// Validacion de variables
if(empty($base) && empty($server) && empty($token)){
	header("HTTP/1.1 400 Bad Request");exit;
}

if($token != $req_token){
	header("HTTP/1.1 401 Unauthorized");exit;
}

// Seleccion de servidor FTP
$srv = null;
switch($server){
	case 'development': 
		$srv = $srv_desa;
		break;
	case 'production': 
		$srv = $srv_prod;
		break;
	case 'pre_production': 
		$srv = $srv_preprod;
		break;
}
$srv->setBaseDir($base);

// Inicializacion de objetos
$api 	= new api($id, $tokenApp);
$repo 	= new Repository($api, $branch);
$upl 	= new Upload($srv, $repo, $api);

// Inicio transferencia
$upl->createDirs();
$upl->transferFiles();


?>