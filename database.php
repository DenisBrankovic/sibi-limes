<?php
class database{
	static function connect(){
		$conn = new PDO("mysql:host=localhost;dbname=limes;charset=utf8mb4", "root", "");
		
		if(!$conn){
			die("Connection to the server couldn't be established.");
		}else{
			return $conn; 
		}
	}
}
	