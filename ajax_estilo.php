<?php
	$id_usu=$_GET['id_usu'];
	include "inc/conexao.php"; 
	$sql = "SELECT * FROM tb_usuario WHERE id_usuario='$id_usu'";
	$usu = $conex -> prepare($sql);
	$usu -> execute();
	foreach($usu as $u){
		$estilos=$u['estilo'];
	}
	if($estilos==0){
		$sql = "UPDATE `tb_usuario` SET `estilo` = '1' WHERE `tb_usuario`.`id_usuario` = '$id_usu'";
		$up_estilo = $conex -> prepare($sql);
		$up_estilo -> execute();
	}
	else{
		$sql = "UPDATE `tb_usuario` SET `estilo` = '0' WHERE `tb_usuario`.`id_usuario` = '$id_usu'";
		$up_estilo = $conex -> prepare($sql);
		$up_estilo -> execute();
	}
?>