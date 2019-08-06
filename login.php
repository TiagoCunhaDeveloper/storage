 <?php 
	if(isset($_POST['logar'])){
		$email = $_POST['email'];
		$senha = md5($_POST['senha']);
		$entrar = 0;
		include "inc/conexao.php"; 
		if (isset($entrar)) {
			$verifica ="SELECT * FROM tb_usuario WHERE email_usu = '$email' AND senha_usu = '$senha' AND status_email=1";
			$verifica = $conex -> prepare($verifica);	
			$verifica -> execute();	
			$cont = $verifica -> rowCount();
			
			if ($cont==0)
			{
				session_start();
				$_SESSION["Error"] =1;
				$_SESSION["Msg_error"] = "<a style='color:#d9534f;text-decoration:none;'>Email e/ou senha incorreto!</a>";
				$_SESSION["Email_digitado"] =$email;
				header("Location:index.php");
			}
			else{
				foreach($verifica as $v){
					$tipo=$v['tipo'];
					$id_usuario=$v['id_usuario'];
					$scan=$v['scan'];
				}
				if($scan==0){
					$conteudo = '<?php

$dir = "Meu armazenamento";

// Run the recursive function 

$response = scan($dir);


// This function scans the files folder recursively, and builds a large array

function scan($dir){

	$files = array();

	// Is there actually such a folder/file?

	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == \'.\') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . \'/\' . $f)) {

				// The path is a folder

				$files[] = array(
					"name" => $f,
					"type" => "folder",
					"path" => $dir . \'/\' . $f,
					"items" => scan($dir . \'/\' . $f) // Recursively get the contents of the folder
				);
			}
			
			else {

				// It is a file

				$files[] = array(
					"name" => $f,
					"type" => "file",
					"path" => $dir . \'/\' . $f,
					"size" => filesize($dir . \'/\' . $f) // Gets the size of this file
				);
			}
		}
	
	}

	return $files;
}



// Output the directory listing as JSON

header(\'Content-type: application/json\');

echo json_encode(array(
	"name" => "Meu armazenamento",
	"type" => "folder",
	"path" => $dir,
	"items" => $response
));
';	
$conteudo2 = '<?php
session_start();
$caminho_compartilhado=$_SESSION["caminho_compartilhado"];
$dir = "".$caminho_compartilhado."";

// Run the recursive function 

$response = scan($dir);


// This function scans the files folder recursively, and builds a large array

function scan($dir){

	$files = array();

	// Is there actually such a folder/file?

	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == \'.\') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . \'/\' . $f)) {

				// The path is a folder

				$files[] = array(
					"name" => $f,
					"type" => "folder",
					"path" => $dir . \'/\' . $f,
					"items" => scan($dir . \'/\' . $f) // Recursively get the contents of the folder
				);
			}
			
			else {

				// It is a file

				$files[] = array(
					"name" => $f,
					"type" => "file",
					"path" => $dir . \'/\' . $f,
					"size" => filesize($dir . \'/\' . $f) // Gets the size of this file
				);
			}
		}
	
	}

	return $files;
}



// Output the directory listing as JSON

header(\'Content-type: application/json\');

echo json_encode(array(
	"name" => "".$caminho_compartilhado."",
	"type" => "folder",
	"path" => $dir,
	"items" => $response
));
';	
file_put_contents('all_files/'.$id_usuario.'/scan.php', $conteudo);
file_put_contents('all_files/'.$id_usuario.'/scan_compartilhados.php', $conteudo2);
$sql ="UPDATE `tb_usuario` SET `scan` = '1' WHERE `tb_usuario`.`id_usuario` = $id_usuario";
			$up_scan = $conex -> prepare($sql);	
			$up_scan -> execute();	
				}
				session_start();
				$_SESSION["id_usuario"] =$id_usuario;
				$_SESSION["tipo"] =$tipo;
				$_SESSION["Login"] =1;
				header("Location:index_usuario.php");
				
				}
			}
		}
?>