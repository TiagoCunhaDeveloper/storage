<?php
	$id_usu=$_GET['id_usu'];
	include "inc/conexao.php"; 
	$sql = "SELECT * FROM tb_usuario WHERE id_usuario='$id_usu'";
	$usu = $conex -> prepare($sql);
	$usu -> execute();
	foreach($usu as $u){
		$preview=$u['preview'];
	}
	if($preview==0){
		$sql = "UPDATE `tb_usuario` SET `preview` = '1' WHERE `tb_usuario`.`id_usuario` = '$id_usu'";
		$up_preview = $conex -> prepare($sql);
		$up_preview -> execute();
	}
	else{
		$sql = "UPDATE `tb_usuario` SET `preview` = '0' WHERE `tb_usuario`.`id_usuario` = '$id_usu'";
		$up_preview = $conex -> prepare($sql);
		$up_preview -> execute();
	}
?>