<?php
	session_start();
	
	$conn = new mysqli('localhost', 'root', 'redhat','vehicle');

	class database{
		private	$host ;
		private	$user ;
		private	$password ;
		private	$database ;

		function connect(){
			$this->host = 'localhost';
			$this->user  = 'root';
			$this->password = 'redhat';
			$this->database = 'vehicle'; 

			$con = new mysqli($this->host, $this->user, $this->password, $this->database);
			return $con; 
		}
	}
?>