<?php
	include "inc/conexao.php"; 
	$nome_usu=$_POST['nome_usu'];
	$sobrenome_usu=$_POST['sobrenome_usu'];
	$email_usu=$_POST['email_usu'];
	$id_usu=$_POST['id_usu'];
	
	$sql ="UPDATE `tb_usuario` SET `nome_usu` = '$nome_usu', `sobrenome_usu` = '$sobrenome_usu', `email_usu` = '$email_usu' WHERE `tb_usuario`.`id_usuario` =$id_usu";
	$up_usu = $conex -> prepare($sql);	
	$up_usu -> execute();
	header("Location:meu_perfil.php");
?>