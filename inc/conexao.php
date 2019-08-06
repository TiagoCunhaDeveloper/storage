<?php
	try{
		$conex=New PDO("mysql:host=localhost;dbname=bd_storage","root","");
	}
	catch(PDOExeption $e){
		echo $e->getMessage();
	}
?>
