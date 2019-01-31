<?php

/*
function pathEncode($path){
	$s = array('.','-','_');
	$r = array('%2E','%2D','%5F');
	$cname = urlencode($path);
	return str_replace($s, $r, $path);
}
//echo urldecode('FlexCustomer.desa.wsdl');exit;
ini_set('max_execution_time', 600);
require_once 'Ftp.php';

echo 'test';
// ez_beG7xyxVGCmZXdrVz
$token 	= 'ez_beG7xyxVGCmZXdrVz';
$branch = 'master';


/***  OBTENCION DE ARCHIVOS ***
$files_ftp = array();
$dirs_ftp  = array();

$items = get('https://gitlab.com/api/v4/projects/10427867/repository/tree?recursive=true', $token);
$json = json_decode($items);
print_r($json);
foreach ($json as $obj){
	$type 	= $obj->type;
	$path 	= $obj->path;
	$name 	= $obj->name;
	if($type=='tree'){
		$dirs_ftp[] = $path;
		// crear carpeta
	}else if($type=='blob'){
		$temp_file = tempnam(sys_get_temp_dir(), 'BV_WebHook');
		$file = '';
		// descargar archivo
		$raw = get('https://gitlab.com/api/v4/projects/10427867/repository/files/'.$path.'/raw?ref='.$branch, $token);
		
		file_put_contents($temp_file, $raw);
		$files_ftp[] = array(
			'org'	=> $temp_file,
			'dest'	=> $path
		);
		// mover archivo a ftp
	}
}
//print_r($files_ftp);

/*** ENVIO DE ARCHIVOS ***
$base = '/app/apiflex/';

$ftp = new Ftp;
$host = 'ftp.example.com';
$ftp->connect('10.29.18.4');
$ftp->login('chilinsp', 'pecc3245');
$ftp->chDir($base);
//$ftp->put($dest, $orig, FTP_BINARY);



// Carpetas
$e = count($dirs_ftp);
for($a=0; $a<$e; $a++){
	if(!$ftp->isDir($dirs_ftp[$a])){
		$ftp->mkdir($dirs_ftp[$a]);
	}
}


// Archivos
$d = count($files_ftp);
for($a=0; $a<$d; $a++){
	$ftp->put($files_ftp[$a]['dest'], $files_ftp[$a]['org'], FTP_BINARY);
}
$ftp->close();

print_r($files_ftp);
print_r($dirs_ftp);*/



$token 	= 'ez_beG7xyxVGCmZXdrVz';
$items = get('http://gitlab.com/api/v4/projects/10427867/repository/tree?recursive=true', $token);
print_r($items);
function get($url, $token){
	$data = null;
	$host = '';
    $request_headers = array(
		"PRIVATE-TOKEN:" . $token
	);
	echo time();
    $ch = curl_init($url);
	/*curl_setopt_array($ch, array(
	  CURLOPT_SSL_VERIFYHOST => 0,
	  CURLOPT_SSL_VERIFYPEER => 0,
	  CURLOPT_SSLVERSION => 3
	));
	/*curl_setopt($ch, CURLOPT_VERBOSE, true);
	curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_SSLv3);
/**/

	/*curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url);*/
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
	/*curl_setopt($ch, CURLOPT_SSLVERSION, 1);
	curl_setopt($ch, CURLOPT_CAPATH, '/app/webhook/cacert-2019-01-23.pem');
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	//curl_setopt( $ch, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_SSLv3' );*/

    $data = curl_exec($ch);
	
    if (curl_errno($ch)) {
		print_r(curl_error($ch));
        $data = null;
    }

    curl_close($ch);
	return $data;
}
?>