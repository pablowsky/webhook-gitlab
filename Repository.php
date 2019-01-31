<?php
class Repository{
	private $files = array();
	private $dirs  = array();
	private $branch;
	private $api;
	
	function __construct($api, $branch){
		$this->api 		= $api;
		$this->branch 	= $branch;
		$this->repoList();		
	}
	
	function repoList(){
		$items 	= $this->api->getRepoList();
		$json 	= json_decode($items);
		
		foreach ($json as $obj){
			$type 	= $obj->type;
			$path 	= $obj->path;
			$name 	= $obj->name;
			
			if($type=='tree'){
				$this->dirs[] = $path;
			}else if($type=='blob'){
				$this->files[] = $path;
			}
		}
	}
	
	function getFiles(){
		return $this->files;
	}	
	function getFolders(){
		return $this->dirs;
	}
	function getBranch(){
		return $this->branch;
	}
	function getToken(){
		return $this->token;
	}
	
}
?>