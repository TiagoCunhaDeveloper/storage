<?php
	session_start();
	include_once "inc/conexao.php";
	$caminho=$_GET['caminho_link'];
	$pessoas=$_GET['nome_folder_link'];
	$hash=$_GET['hash'];
	$id_usuario=$_SESSION['id_usuario'];
	$sql ="SELECT * FROM tb_compartilhados WHERE caminho_compartilhado='$caminho' AND fk_usuario = '$id_usuario'";
	$jafoicompartilhado = $conex -> prepare($sql);	
	$jafoicompartilhado -> execute();
	$caminho_existe = $jafoicompartilhado->rowCount();
	if($caminho_existe==0){
		$sql = "INSERT INTO tb_compartilhados VALUES (?,?,?,?,?)";
		$comp = $conex -> prepare($sql);	
		$comp -> execute(array("",$hash,$caminho,$pessoas,$_SESSION['id_usuario']));
		$comp = null; //Encerra a conexão com o BD
	}
	else{
		$sql = "UPDATE `tb_compartilhados` SET `hash` = '$hash',`caminho_compartilhado`='$caminho',`pessoas`='$pessoas' WHERE `tb_compartilhados`.`caminho_compartilhado` = '$caminho' AND `tb_compartilhados`.`fk_usuario`='$id_usuario'";
		$comp = $conex -> prepare($sql);	
		$comp -> execute();
		$comp = null; //Encerra a conexão com o BD
	}
		
?>