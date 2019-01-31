<?php
class api{
	private $base_url;
	private $repoList_url;
	private $download_url;
	private $id;
	
	function __construct($id, $token){
		$this->id		= $id;
		$this->token	= $token;
		$this->base_url	= 'https://gitlab.com/api/v4/';
	}
	
	function getRepoList(){
		$url = $this->base_url.'projects/'.$this->id.'/repository/tree?recursive=true';
		return $this->get($url);
	}
	
	function getDownload($item, $branch){
		$url = $this->base_url.'projects/'.$this->id.'/repository/files/'.$item.'/raw?ref='.$branch;
		return $this->get($url);
	}
		
	private function get($url){
		$data = null;
		$host = '';
		$request_headers = array(
			"PRIVATE-TOKEN:" . $this->token
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);

		$data = curl_exec($ch);
		
		if (curl_errno($ch)) {
			$data = null;
		}

		curl_close($ch);
		return $data;
	}

	private function pathEncode($path){
		$s = array('.','-','_');
		$r = array('%2E','%2D','%5F');
		$cname = urlencode($path);
		return str_replace($s, $r, $path);
	}
}
?>