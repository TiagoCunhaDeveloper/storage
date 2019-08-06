<?php
	session_start();
	include "inc/conexao.php";
	$id_usuario=$_SESSION["id_usuario"];
	$opcao=$_POST['opcao'];
	$caminho=$_POST['caminho'];
	
	$sql="UPDATE `tb_compartilhados_interno` SET `opcoes_compart` = '$opcao' WHERE `tb_compartilhados_interno`.`caminho_compartilhado_interno` = '$caminho' AND `tb_compartilhados_interno`.`fk_usuario`= $id_usuario";
	$upOpcoes = $conex -> prepare($sql);
	$upOpcoes -> execute();
?>