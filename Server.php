<?php
class Server{
	private $host;
	private $user;
	private $pass;
	private $base;
	
	function __construct($host, $user, $pass){
		$this->host	= $host;
		$this->user = $user;
		$this->pass = $pass;
	}
	
	function getHost(){
		return $this->host;
	}
	function getUser(){
		return $this->user;
	}
	function getPass(){
		return $this->pass;
	}
	function getBaseDir(){
		return $this->base;
	}
	function setBaseDir($base){
		$this->base = $base;
	}
}
?>