<?php
class Upload{
	private $ftp;
	private $repo;
	private $api;
	
	function __construct($server, $repo, $api){
		$this->api 	= $api;
		$this->repo = $repo;
		$this->ftp 	= new Ftp;
		
		$this->ftp->connect($server->getHost());
		$this->ftp->login($server->getUser(), $server->getPass());
		$this->ftp->chDir($server->getBaseDir());
	}
	
	function createDirs(){
		$_dirs = $this->repo->getFolders();
		
		$e = count($_dirs);
		for($a=0; $a<$e; $a++){
			if(!$this->ftp->isDir($_dirs[$a])){
				$this->ftp->mkdir($_dirs[$a]);
			}
		}
	}
	
	function transferFiles(){
		$_files = $this->repo->getFiles();
		
		$d = count($_files);
		for($a=0; $a<$d; $a++){
			$temp_file 	= tempnam(sys_get_temp_dir(), 'BV_WebHook');
			$raw 		= $this->api->getDownload($_files[$a], $this->repo->getBranch());
			
			file_put_contents($temp_file, $raw);
				
			$this->ftp->put($_files[$a], $temp_file, FTP_BINARY);
		}
	}
}
?>